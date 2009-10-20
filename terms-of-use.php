<?php
/*
Plugin Name: Terms of Use
Plugin URI: http://blog.strategy11.com/terms-of-use-2-wordpress-plugin
Description: Force users to agree to terms and conditions on first login.
Author: Stephanie Wells
Author URI: http://blog.strategy11.com
Version: 1.10.2
*/

require_once('tou-config.php');

function tou_menu(){
    global $user_ID, $user_level, $tou_settings;
    
    add_submenu_page(TOU_ADMIN_EDIT_PAGE, 'Edit '. TOU_PLUGIN_TITLE, 'Edit '. TOU_PLUGIN_TITLE, 10, TOU_PATH.'/tou-settings.php'); 
    add_submenu_page(TOU_ADMIN_PAGE, TOU_PLUGIN_TITLE, TOU_PLUGIN_TITLE, 0, TOU_PATH.'/terms-and-conditions.php');

    add_action('admin_head-'.TOU_PLUGIN_NAME.'/tou-settings.php', 'tou_admin_header');
    add_action('admin_head-'.TOU_PLUGIN_NAME.'/terms-and-conditions.php', 'tou_admin_header');
    
    if ($user_level < 10 and !get_usermeta($user_ID, 'terms_and_conditions') and !$_POST and $tou_settings['admin_page'] == 'index.php'){
        global $menu;
        foreach ( $menu as $id => $data )
            unset($menu[$id]);
    }    
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tou_settings_link' );   
}
add_action('admin_menu', 'tou_menu');

// Adds a settings link to the plugins page
function tou_settings_link($links){
    $settings_link = '<a href="'.TOU_ADMIN_EDIT_PAGE.'?page='.TOU_PLUGIN_NAME.'/tou-settings.php">' . __('Settings') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

function tou_tinymce(){
    add_action( 'admin_print_footer_scripts', 'wp_tiny_mce', 25 );
	if ( user_can_richedit() )
		wp_enqueue_script('editor');
	add_thickbox();
	wp_enqueue_script('media-upload');
	wp_enqueue_script('word-count');
	wp_enqueue_script('quicktags');	
}
add_action ( 'admin_init', 'tou_tinymce' );

//check is the user has agreed to the terms and conditions
function tou_check(){
    global $user_ID, $user_level, $tou_settings;
    if ($user_level == 10) return;
   
    if ($_SERVER["REQUEST_URI"] and $tou_settings['admin_page'])
        $current_page = strpos($_SERVER["REQUEST_URI"], $tou_settings['admin_page']);
    if(!get_usermeta($user_ID, 'terms_and_conditions') and !$_GET['page'] == TOU_PLUGIN_NAME. '/terms-and-conditions.php' and (!isset($tou_settings['admin_page']) || $tou_settings['admin_page'] == 'index.php' || $current_page)){
        die("<script type='text/javascript'>window.location='". TOU_ADMIN_PAGE ."?page=". TOU_PLUGIN_NAME ."/terms-and-conditions.php' </script>");
    }
}
add_action('admin_head', 'tou_check');

function require_tou_front_end($post){
    global $user_ID, $user_level, $tou_settings;
    $this_page_id = get_the_ID();
    if ( ($user_ID and get_usermeta($user_ID, 'terms_and_conditions')) ||  !isset($tou_settings['frontend_page']) || $tou_settings['frontend_page'] == '' || $tou_settings['frontend_page'] != $this_page_id || !empty($_COOKIE['terms_user_' . COOKIEHASH])) return; //$user_level == 10 ||
    die("<script type='text/javascript'>window.location='". $tou_settings['terms_url'] ."?redirected=true' </script>");
}
add_action('loop_start', 'require_tou_front_end');

function set_tou_cookie(){
    global $user_ID, $tou_settings;
    if ($_POST and isset($_POST['terms-and-conditions']) and !$user_ID and empty($_COOKIE['terms_user_' . COOKIEHASH])){
        $terms_cookie_lifetime = apply_filters('terms_cookie_lifetime', 30000000);
        $cookie_value = ($tou_settings['initials'] and $_POST['initials'])?($_POST['initials']):('agree');
        setcookie('terms_user_' . COOKIEHASH, $cookie_value, time() + $terms_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
    }   
}
add_action('init', 'set_tou_cookie');

function tou_date(){
    global $user_ID, $tou_settings;
	
	if ($tou_settings['show_date'] and get_usermeta($user_ID, 'terms_and_conditions')){  
        echo "<p class='description'>";
        if ($tou_settings['initials'] and get_usermeta($user_ID, 'tou_initials'))
            echo get_usermeta($user_ID, 'tou_initials') . " ";
        echo "Agreed to site <a href='". TOU_ADMIN_PAGE ."?page=". TOU_PLUGIN_NAME ."/terms-and-conditions.php'>Terms & Conditions</a> on ". date(get_option('date_format'), strtotime(get_usermeta($user_ID, 'terms_and_conditions'))) .".</p>";
    }
    
}
add_action('show_user_profile', 'tou_date', 200);

/*****************************STYLING*******************************/
function tou_admin_header(){?>
<style>textarea, input[type="text"]{width:100%;}</style>
<?
}

/*****************************SHORTCODE*****************************/
function get_tou_terms($atts) {
    $display = true;
    return get_tou_include_contents('terms-and-conditions.php'); 
}
add_shortcode('terms-of-use', 'get_tou_terms');

/*****************************REGISTER/SIGNUP***********************/
function tou_checkbox($errors=''){
    global $tou_settings;
    if ($tou_settings['signup_page'] and isset($tou_settings['terms_url']) and $tou_settings['terms_url'] != ''){
?>
<?php if ( $errmsg = $errors->get_error_message('terms') ) { ?>
	<p class="error"><?php echo $errmsg ?></p>
<?php } ?>
    <p>
        <input type="checkbox" id="terms" name="terms" value="1"> 
        <label class="checkbox">I have read and agree to the <a href="<?php echo $tou_settings['terms_url'] ?>">Terms & Conditions</a></label>
    </p>    
    <?php if ($tou_settings['initials']){ 
        if ( $errmsg = $errors->get_error_message('tou_initials') ) { ?>
        	<p class="error"><?php echo $errmsg ?></p>
        <?php } ?>
        <p>
            <label class="checkbox">Initials:</label> <input type="text" name="tou_initials" id="tou_initials" size="4" value="">
        </p>    
    <?php } ?> 
<?  }
}
add_action('register_form', 'tou_checkbox');
add_action('signup_extra_fields', 'tou_checkbox', 900); //WPMU

function tou_checked($result){
    global $user_ID, $tou_settings;

    if ($tou_settings['signup_page']){
        if ($tou_settings['initials'] and !$_POST['tou_initials']){
            if (IS_WPMU)
                $result['errors']->add('tou_initials', __( 'Please enter your initials.' ));
            else
                $result->add('tou_initials', __( '<strong>ERROR</strong>: Please enter your initials.' ));
        }
    
        if (!$_POST['terms']){
            if (IS_WPMU)
                $result['errors']->add('terms', __( 'Please accept Terms.' ));
            else
                $result->add('terms', __( '<strong>ERROR</strong>: Please accept Terms.' ));   
        }  
    }        
    return $result;
}
add_filter('registration_errors', 'tou_checked');
add_filter('wpmu_validate_user_signup', 'tou_checked'); //WPMU

function tou_register($user_id){
    global $tou_settings;
    if ($tou_settings['initials'] and $_POST['tou_initials'])
        update_usermeta($user_id, "tou_initials", $_POST['tou_initials']);
    if ($_POST['terms'])
        update_usermeta($user_id, "terms_and_conditions", current_time('mysql', 1));
}
add_action('user_register', 'tou_register');

function add_tou_meta($meta){
    if ($_POST['tou_initials'])
        $meta['tou_initials'] = $_POST['tou_initials'];
    
    if ($_POST['terms'])
        $meta['terms_and_conditions'] = date('Y-m-d H:i:s');
    return $meta;
}
add_filter('add_signup_meta','add_tou_meta');

function tou_hidden_fields(){
    global $user_ID;
    if ($value = get_usermeta( $user_id, 'tou_initials' ))
        echo '<input type="hidden" name="tou_initials" id="tou_initials" value="'.$value.'">';
    else if ($_POST['tou_initials'])
        echo '<input type="hidden" name="tou_initials" id="tou_initials" value="'.$_POST['tou_initials'].'">';
    
    if (get_usermeta( $user_id, 'tou_initials' ) or $_POST['terms'])
        echo '<input type="hidden" name="terms" id="terms" value="1">';    
}
add_action('signup_hidden_fields', 'tou_hidden_fields');

function save_tou_agreement($user_id, $password='', $meta=array()){
    global $wpdb;
    
    $user_email = $wpdb->get_var( $wpdb->prepare("SELECT user_email FROM $wpdb->users where ID = $user_id") );
    $signup_data = $wpdb->get_var( $wpdb->prepare("SELECT meta from $wpdb->signups where user_email = '$user_email'") );
    $meta = unserialize($signup_data);
	if( $meta[ 'tou_initials' ] )
		update_usermeta( $user_id, 'tou_initials', $meta[ 'tou_initials' ] );

	if( $meta[ 'terms_and_conditions' ] )
		update_usermeta( $user_id, 'terms_and_conditions', $meta[ 'terms_and_conditions' ] );
}
add_action('wpmu_activate_user', 'save_tou_agreement', 10, 3);

/*****************************INSTALL*******************************/
function set_tou_defaults(){
    $terms = get_tou_include_contents('views/terms.php');
    $privacy_policy = get_tou_include_contents('views/privacy_policy.php');
    $welcome = get_tou_include_contents('views/welcome.php');
    $tou_name = get_option('blogname');
    $member_agreement = "Welcome to [website-name], before you can start using this service, you must read and agree to the Terms of Use and Privacy Policy, including any future amendments.";
    $agree = "By clicking \"I agree\" you are indicating that you have read and agree to the above Terms of Use and Privacy Policy.";
    $show_date = "checked='checked'";
    
    $tou_data = array('member_agreement' => $member_agreement, 'terms' => $terms, 'privacy_policy' => $privacy_policy, 'welcome' => $welcome, 'site_name' => $tou_name, 'agree' => $agree, 'show_date' => $show_date, 'initials' => false, 'signup_page' => false, 'admin_page' => 'index.php', 'frontend_page' => '', 'terms_page' => '', 'menu_page' => 'index.php');
    
    
    if(IS_WPMU){
        if (!get_site_option('tou_options'))
            add_site_option('tou_options', $tou_data);
    }else{
        if (!get_option('tou_options'))
            add_option('tou_options', $tou_data);
    }
}
register_activation_hook(__FILE__,'set_tou_defaults');

function get_tou_include_contents($filename) {
    if (is_file(TOU_PATH.'/'.$filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}

?>