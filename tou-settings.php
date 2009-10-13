<?php
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
	        'show_date' => $_POST['show_date'], 
	        'initials' => $_POST['initials'], 
	        'signup_page' => $_POST['signup_page'], 
	        'admin_page' => $_POST['admin_page'], 
	        'frontend_page' => $_POST['frontend_page'], 
	        'terms_url' => $_POST['terms_url'], 
	        'menu_page' => $_POST['menu_page']
	    );
		
        if(IS_WPMU)
            update_site_option('tou_options', $tou_data);
        else
            update_option('tou_options', $tou_data);
            
        if ($_POST['clear_all'] == 1){
            global $wpdb;
            $wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE meta_key = 'terms_and_conditions'") );
        }
        $message = "Your settings have been saved.";
	}
	
	$pages = get_posts( array('post_type' => 'page', 'post_status' => 'published', 'numberposts' => 99, 'order_by' => 'post_title', 'order' => 'ASC'));
	$admin_page_list = array('index.php' => 'All Admin pages', 'themes.php' => 'Themes', 'post-new.php' => 'New Post', 'page-new.php' => 'New Page', 'media-new.php' => 'New Media', 'profile.php' => 'Profile');
	
	$admin_menu_options = array('index.php' => 'Dashboard', 'tools.php' => 'Tools', 'options-general.php' => 'Settings');
	//Retrieve all the settings
	global $tou_settings; 
	
	if (!isset($tou_settings['admin_page']))
	    $tou_settings['admin_page'] = 'index.php';
	
	$member_agreement = stripslashes((($_POST and $_POST['member_agreement'] != null)?$_POST['member_agreement']:$tou_settings['member_agreement']));
	$terms = stripslashes((($_POST and $_POST['terms'] != null)?$_POST['terms']:$tou_settings['terms']));
	$privacy_policy = stripslashes((($_POST and $_POST['privacy_policy'] != null)?$_POST['privacy_policy']:$tou_settings['privacy_policy']));
    $welcome = stripslashes((($_POST and $_POST['welcome'] != null)?$_POST['welcome']:$tou_settings['welcome']));
    $tou_name = stripslashes((($_POST and $_POST['site_name'] != null)?$_POST['site_name']:$tou_settings['site_name']));
    $agree = stripslashes((($_POST and $_POST['agree'] != null)?$_POST['agree']:$tou_settings['agree']));
    $show_date = stripslashes((($_POST)?$_POST['show_date']:$tou_settings['show_date']));
    $initials = stripslashes((($_POST)?$_POST['initials']:$tou_settings['initials']));
    $signup_page = stripslashes((($_POST)?$_POST['signup_page']:$tou_settings['signup_page']));
    $admin_page = stripslashes((($_POST and isset($_POST['admin_page']))?$_POST['admin_page']:$tou_settings['admin_page']));
    $frontend_page = stripslashes((($_POST and isset($_POST['frontend_page']))?$_POST['frontend_page']:$tou_settings['frontend_page']));
    $terms_url = stripslashes((($_POST and isset($_POST['terms_url']))?$_POST['terms_url']:$tou_settings['terms_url']));
    $menu_page = stripslashes((($_POST and isset($_POST['menu_page']))?$_POST['menu_page']:$tou_settings['menu_page']));
	
	if(!$tou_name)
	    $tou_name = get_option('blogname');
    
    //the settings page
    require('views/form.php');
?>