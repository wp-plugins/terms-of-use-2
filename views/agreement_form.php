<?php if ($error){
    echo '<div class="error">';
        echo '<span><strong>ERROR</strong>: ' . $error . '</span>';
    echo '</div>';
}
?>
<div id="icon-edit-pages" class="icon32"><br></div>
    <h2>Member Agreement </h2>
    <?php require('nav.php'); ?>
	<p><?php echo $member_agreement; ?></p>

<?php if ($terms and $terms != ''){ ?>  
  <h2>Terms of Use</h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $terms; ?></div><br/>
<?php } ?>  

<?php if ($privacy_policy and $privacy_policy != ''){ ?>  
  <h2>Privacy Policy </h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $privacy_policy; ?></div>
<?php } ?>
  
    <h2>The Agreement</h2>
    <p><?php echo $agree; ?></p>
	

<?php 	global $user_ID;
	if (!get_usermeta($user_ID, 'terms_and_conditions')){ ?>
	    <form id="post" method="post" action="" name="post">
        	<input type="hidden" name="terms-and-conditions" value="true">
        	<?php if ($tou_settings['initials']){?>
        	    Initials <input type="text" name="initials" size="4">
        	<?php } ?>
        	<p class="submit">
        	    <input id="agree" type="submit" value="I Agree" name="agree"/> 
        	    <input type="button" value="I Disagree" onClick="window.location='<?php echo site_url('wp-login.php?action=logout', 'login') ?>'">
        	</p>
        </form>	    
<?  } ?>
</div>