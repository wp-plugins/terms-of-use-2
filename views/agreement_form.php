<?php if ($error){ ?>
<div class="error">
    <span><strong>ERROR</strong>: <?php echo $error ?></span>
</div>
<?php } ?> 
<div id="post-body-content">

<?php if (is_admin()){ ?>
<div id="icon-edit-pages" class="icon32"><br></div>        
<?php }?>

<h2>Member Agreement </h2>
<?php require('nav.php'); ?>
<div id="postdiv" class="postarea"><?php echo $member_agreement; ?></div>

<?php if ($terms and $terms != ''){ ?>  
  <h2>Terms of Use</h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; padding:5px; overflow:auto;"><?php echo $terms; ?></div><br/>
<?php } ?>  

<?php if ($privacy_policy and $privacy_policy != ''){ ?>  
  <h2>Privacy Policy</h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; padding:5px; overflow:auto;"><?php echo $privacy_policy ?></div>
<?php } ?>

<?php
	if ($show_buttons){ ?>
	    <h2>The Agreement</h2>
        <p><?php echo $agree; ?></p>
	    <form id="post" method="post" action="" name="post">
        	<input type="hidden" name="terms-and-conditions" value="true">
        	<?php if ($tou_settings['initials']){?>
        	    Initials <input type="text" name="initials" size="4">
        	<?php } ?>
        	<p class="submit">
        	    <input id="agree" type="submit" value="I Agree" name="agree"/> 
        	    <input type="button" value="I Disagree" onClick="window.location='<?php echo $disagree_url ?>'">
        	</p>
        </form>	    
<?php  }  ?>
</div>