<?php
//Retrieve all the settings
global $tou_settings;

$message = '';

// if the settings were changed save them
if($_POST and isset($_POST['terms'])){
    $tou_data = array(
	    'member_agreement' => $_POST['member_agreement'], 
	    'terms' => $_POST['terms'], 
	    'privacy_policy' => $_POST['privacy_policy'], 
	    'welcome' => $_POST['welcome'], 
	    'site_name' => $_POST['site_name'], 
	    'agree' => $_POST['agree'], 
	    'cleared_on' => $tou_settings['cleared_on'],
	    'show_date' => isset($_POST['show_date']) ? 1 : 0, 
	    'initials' => isset($_POST['initials']) ? 1 : 0, 
	    'signup_page' => isset($_POST['signup_page']) ? 1 : 0, 
	    'comment_form' => isset($_POST['comment_form']) ? 1 : 0, 
	    'admin_page' => $_POST['admin_page'], 
	    'frontend_page' => $_POST['frontend_page'], 
	    'terms_url' => $_POST['terms_url'], 
	    'menu_page' => $_POST['menu_page']
	);
	    
	if (isset($_POST['clear_all']) && $_POST['clear_all'] == 1){
        global $wpdb;
        $wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE meta_key = 'terms_and_conditions'") );
        $tou_data['cleared_on'] = current_time('mysql', 1);
    }
		
    if(IS_WPMU)
        update_site_option('tou_options', $tou_data);
    else
        update_option('tou_options', $tou_data);
        
    $message = "Your settings have been saved.";
}else
    $tou_data = $tou_settings;
    
	
$pages = get_posts( array('post_type' => 'page', 'post_status' => 'published', 'numberposts' => 99, 'order_by' => 'post_title', 'order' => 'ASC'));
$admin_page_list = array('index.php' => 'All Admin pages', 'themes.php' => 'Themes', 'post-new.php' => 'New Post', 'page-new.php' => 'New Page', 'media-new.php' => 'New Media', 'profile.php' => 'Profile');
	
$admin_menu_options = array('index.php' => 'Dashboard', 'tools.php' => 'Tools', 'options-general.php' => 'Settings', 'profile.php' => 'Profile');
	
if (!isset($tou_settings['admin_page']))
    $tou_settings['admin_page'] = 'index.php';
	
if (!is_numeric($tou_data['terms_url']))
    $tou_data['terms_url'] = (substr($tou_data['terms_url'], -1) != '/') ? ($tou_data['terms_url'] .'/') : ($tou_data['terms_url']);
	
if(!$tou_data['site_name'])
    $tou_data['site_name'] = get_option('blogname');

//the settings page
require('views/form.php');
?>