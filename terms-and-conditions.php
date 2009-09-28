<div class="wrap tou">
<?php
    
//get the settings
if(IS_WPMU)
    $tou_settings = get_site_option('tou_options');
else
    $tou_settings = get_option('tou_options');
    
$site_name = stripslashes($tou_settings['site_name']);

if(!$site_name)
    $site_name = get_option('blogname');

$terms = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['terms'])));
$privacy_policy = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['privacy_policy'])));
$member_agreement = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['member_agreement'])));
$agree = str_replace('[website-name]', $site_name, stripslashes($tou_settings['agree']));
$welcome = str_replace('[website-name]', $site_name, stripslashes($tou_settings['welcome'])); 
$error = '';  
//Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
if($_POST and $_POST['terms-and-conditions']){
    //update current users terms_and_conditions
    global $user_ID;
    if ($tou_settings['initials'] and !$_POST['initials']){ //the agreement page
        $error = "You must enter your initials";
    	require('views/agreement_form.php');
    }else{
        if ($tou_settings['initials'] and $_POST['initials'])
            update_usermeta($user_ID, "tou_initials", $_POST['initials']);
            
        update_usermeta($user_ID, "terms_and_conditions", date('Y-m-d H:i:s'));

        //display welcome message.
        echo $welcome;
    }
}else if ( isset($_GET['tou'])){ //display welcome message for preview    
    require('views/nav.php');
    echo $welcome;
}else{  //the agreement page
	require('views/agreement_form.php');
}	
?>