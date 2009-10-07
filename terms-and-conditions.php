<?php
if (is_admin())
   echo '<div class="wrap tou">'; 
//get the settings
global $user_ID, $tou_settings;
    
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

$show_buttons = true;
if (get_usermeta($user_ID, 'terms_and_conditions'))
    $show_buttons = false;

$disagree_url = wp_logout_url();   
if (!is_admin()){
    $disagree_url = get_option('siteurl');
    if (isset($_GET['redirected']))
        $show_buttons = true;
    else
        $show_buttons = false;
        
    if ($_POST and isset($_POST['terms-and-conditions'])){
        if ($tou_settings['initials'] and !$_POST['initials']){ //the agreement page
            $error = "You must enter your initials";
        	require('views/agreement_form.php');
        	return;
        }	
        if ($user_ID){
            if ($tou_settings['initials'] and $_POST['initials'])
                update_usermeta($user_ID, "tou_initials", $_POST['initials']);
            update_usermeta($user_ID, "terms_and_conditions", date('Y-m-d H:i:s'));
        }else{
            $terms_cookie_lifetime = apply_filters('terms_cookie_lifetime', 30000000);
            $cookie_value = ($tou_settings['initials'] and $_POST['initials'])?($_POST['initials']):('agree');
            setcookie('terms_user_' . COOKIEHASH, $cookie_value, time() + $terms_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN);
        }
        $protected_page_url = get_permalink($tou_settings['frontend_page']);
        wp_redirect($protected_page_url);
    }else
        if ($show_buttons)
            require('views/agreement_form.php');
        else    
            echo $terms;    
        
//Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
}else if($_POST and $_POST['terms-and-conditions']){
    //update current users terms_and_conditions
      
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