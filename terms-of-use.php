<?php
/*
Plugin Name: Terms of Use
Plugin URI: http://blog.strategy11.com/terms-of-use-2-wordpress-plugin
Description: Force users to agree to terms and conditions on first login.
Author: Stephanie Wells
Author URI: http://blog.strategy11.com
Version: 1.7
*/

require_once('tou-config.php');

function tou_menu(){
    global $user_ID, $user_level;
    
    add_submenu_page(TOU_ADMIN_EDIT_PAGE, 'Edit '. TOU_PLUGIN_TITLE, 'Edit '. TOU_PLUGIN_TITLE, 10, TOU_PATH.'/tou-settings.php'); 
    add_submenu_page(TOU_ADMIN_PAGE, TOU_PLUGIN_TITLE, TOU_PLUGIN_TITLE, 0, TOU_PATH.'/terms-and-conditions.php');

    add_action('admin_head-'.TOU_PLUGIN_NAME.'/tou-settings.php', 'tou_admin_header');
    
    if (!get_usermeta($user_ID, 'terms_and_conditions') and $user_level < 10 and !$_POST){
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
	wp_enqueue_script('post');
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
    global $user_ID, $user_level;
    if ($user_level == 10) return;

    if(!get_usermeta($user_ID, 'terms_and_conditions') and !$_GET['page'] == TOU_PLUGIN_NAME. '/terms-and-conditions.php'){
	    die("<script type='text/javascript'>window.location='". TOU_ADMIN_PAGE ."?page=". TOU_PLUGIN_NAME ."/terms-and-conditions.php' </script>");
    }
}
add_action('admin_head', 'tou_check');

function tou_date(){
    global $user_ID;
    
    if(IS_WPMU)
	    $tou_settings = get_site_option('tou_options');
	else
	    $tou_settings = get_option('tou_options');
	
	if ($tou_settings['show_date'] and get_usermeta($user_ID, 'terms_and_conditions')){  
        echo "<p class='description'>";
        if ($tou_settings['initials'] and get_usermeta($user_ID, 'tou_initials'))
            echo get_usermeta($user_ID, 'tou_initials') . " ";
        echo "Agreed to site <a href='". TOU_ADMIN_PAGE ."?page=". TOU_PLUGIN_NAME ."/terms-and-conditions.php'>Terms & Conditions</a> on ". strftime('%B %d, %G', strtotime(get_usermeta($user_ID, 'terms_and_conditions'))) .".</p>";
    }
    
}
add_action('show_user_profile', 'tou_date', 200);

/*****************************STYLING*******************************/
function tou_admin_header(){?>
<style>textarea{width:100%;}</style>
<?
}

/*****************************INSTALL*******************************/
function set_tou_defaults(){
    $terms = get_tou_include_contents('views/terms.php');
    $privacy_policy = get_tou_include_contents('views/privacy_policy.php');
    $welcome = get_tou_include_contents('views/welcome.php');
    $site_name = get_option('blogname');
    $member_agreement = "Welcome to [website-name], before you can start using this service, you must read and agree to the Terms of Use and Privacy Policy, including any future amendments.";
    $agree = "By clicking \"I agree\" you are indicating that you have read and agree to the above Terms of Use and Privacy Policy.";
    $show_date = "checked='checked'";
    
    $tou_data = array('member_agreement' => $member_agreement, 'terms' => $terms, 'privacy_policy' => $privacy_policy, 'welcome' => $welcome, 'site_name' => $site_name, 'agree' => $agree, 'show_date' => $show_date, 'initials' => false);
    
    
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