<?php
    $message = '';
  // if the settings were changed save them
	if($_POST and isset($_POST['terms'])){
	    $tou_data = array('member_agreement' => $_POST['member_agreement'], 'terms' => $_POST['terms'], 'privacy_policy' => $_POST['privacy_policy'], 'welcome' => $_POST['welcome'], 'site_name' => $_POST['site_name'], 'agree' => $_POST['agree'], 'show_date' => $_POST['show_date'], 'initials' => $_POST['initials']);
		
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
	
	//Retrieve all the settings
	if(IS_WPMU)
	    $tou_settings = get_site_option('tou_options');
	else
	    $tou_settings = get_option('tou_options');
	
	$member_agreement = stripslashes((($_POST and $_POST['member_agreement'] != null)?$_POST['member_agreement']:$tou_settings['member_agreement']));
	$terms = stripslashes((($_POST and $_POST['terms'] != null)?$_POST['terms']:$tou_settings['terms']));
	$privacy_policy = stripslashes((($_POST and $_POST['privacy_policy'] != null)?$_POST['privacy_policy']:$tou_settings['privacy_policy']));
    $welcome = stripslashes((($_POST and $_POST['welcome'] != null)?$_POST['welcome']:$tou_settings['welcome']));
    $site_name = stripslashes((($_POST and $_POST['site_name'] != null)?$_POST['site_name']:$tou_settings['site_name']));
    $agree = stripslashes((($_POST and $_POST['agree'] != null)?$_POST['agree']:$tou_settings['agree']));
    $show_date = stripslashes((($_POST)?$_POST['show_date']:$tou_settings['show_date']));
    $initials = stripslashes((($_POST)?$_POST['initials']:$tou_settings['initials']));
	
	if(!$site_name)
	    $site_name = get_option('blogname');
    
    //the settings page
    require('views/form.php');
?>