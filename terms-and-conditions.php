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

$welcome = str_replace('[website-name]', $site_name, stripslashes($tou_settings['welcome']));   
//Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
if($_POST and $_POST['terms-and-conditions']){
    //update current users terms_and_conditions
    global $user_ID;
    update_usermeta($user_ID, "terms_and_conditions", date('Y-m-d H:i:s'));
    //display welcome message.
?>    
    <h2>Welcome</h2>
<?php echo $welcome; 

}else if ( isset($_GET['tou'])){
    //display welcome message for preview    
    echo "<h2>Welcome</h2>";
    require('views/nav.php');
    echo $welcome;
}else{    
  	$terms = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['terms'])));
	$privacy_policy = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['privacy_policy'])));
	$member_agreement = wpautop(str_replace('[website-name]', $site_name, stripslashes($tou_settings['member_agreement'])));
	$agree = str_replace('[website-name]', $site_name, stripslashes($tou_settings['agree']));
	//the agreement page
?>

<div id="icon-edit-pages" class="icon32"><br></div>
    <h2>Member Agreement </h2>
    <?php require('views/nav.php'); ?>
	<p><?php echo $member_agreement; ?></p>

<?php if ($terms and $terms != ''){ ?>  
  <h2>Terms of Use</h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $terms; ?></div><br/>
<?php } ?>  

<?php if ($privacy_policy and $privacy_policy != ''){ ?>  
  <h2>Privacy Policy </h2>
  <div style="width:100%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $privacy_policy; ?></div>
<?php } ?>
  
    <h2>The Agreement</h2>
    <p><?php echo $agree; ?></p>
	

<?php 	global $user_ID;
	if (!get_usermeta($user_ID, 'terms_and_conditions')){ ?>
	    <form id="post" method="post" action="" name="post">
        	<input type="hidden" name="terms-and-conditions" value="true">
        	<p class="submit">
        	    <input id="agree" type="submit" value="I Agree" name="agree"/> 
        	    <input type="button" value="I Disagree" onClick="window.location='<?php echo site_url('wp-login.php?action=logout', 'login') ?>'">
        	</p>
        </form>	    
<?  }
}
?>
</div>