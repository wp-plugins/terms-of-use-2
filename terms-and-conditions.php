<?php
if (is_admin())
   echo '<div class="wrap tou">'; 
//get the settings
global $tou_settings;
    
$tou_name = stripslashes($tou_settings['site_name']);

if(!$tou_name)
    $tou_name = get_option('blogname');

$terms = '';
if ($tou_settings['terms'] != '')
    $terms = wpautop(str_replace('[website-name]', $tou_name, stripslashes($tou_settings['terms'])));

$privacy_policy = '';
if ($tou_settings['privacy_policy'] != '')
    $privacy_policy = wpautop(str_replace('[website-name]', $tou_name, stripslashes($tou_settings['privacy_policy'])));

$member_agreement = wpautop(str_replace('[website-name]', $tou_name, stripslashes($tou_settings['member_agreement'])));
$agree = str_replace('[website-name]', $tou_name, stripslashes($tou_settings['agree']));
$welcome = str_replace('[website-name]', $tou_name, stripslashes($tou_settings['welcome'])); 
$error = '';

if (!is_admin()){  
    echo $terms;
//Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
}else if($_POST and $_POST['terms-and-conditions']){
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
if (is_admin())
   echo '</div>';	
?>