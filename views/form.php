<div class="wrap">
    <div id="icon-edit-pages" class="icon32"><br></div>
	<h2><?php echo TOU_PLUGIN_TITLE ?> Settings</h2>
	<?php if ($message){?><div id="message" class="updated fade" style="padding:5px;"><?php echo $message; ?></div><?php } ?>
    <?php require('nav.php');?>
    <form name="form1" action="?page=<?php echo TOU_PLUGIN_NAME ?>/tou-settings.php" method="post">
        <?php wp_nonce_field('update-options'); ?>
        <div id="post-body-content">
        
    	<table class="form-table" id="poststuff">
        	<tr>
				<th scope="row"><label>Website Name</label></th>
				<td>
				    <input name="site_name" id="site_name" type="text" value="<?php echo $site_name; ?>" class="regular-text" />
                    <span class="description">Website Name will replace <b>[website-name]</b> in messages when displayed.</span>
				</td>
         	</tr>
            
            <tr>
				<th scope="row"><label>Form Instructions</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="member_agreement" class="code" name="member_agreement"><?php echo $member_agreement ; ?></textarea>
            		</div>
                    <span class="description">Instructions displayed above terms.</span>
				</td>
         	</tr>
         	
            <tr>
				<th scope="row"><label>Terms and Conditions</label></th>
				<td>
				    <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea">
            			<?php the_editor($terms, 'terms', 'title', false); ?>
            		</div>
					<span class="description">Leaving the Terms blank will remove the "Terms and Conditions" box on the agreement page</span>
				</td>
         	</tr>

            <tr>
				<th scope="row"><label>Privacy Policy</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="privacy_policy" class="code" name="privacy_policy" rows="10"><?php echo $privacy_policy ; ?></textarea>
            		</div>
					<span class="description">Leaving Privacy Policy blank will remove the "Privacy Policy" box on the agreement page</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label for="blogdescription">Welcome Message</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="welcome" class="code" name="welcome" rows="10"><?php echo $welcome; ?></textarea>
            		</div>
                    <span class="description">This message is displayed after the user agrees to the terms and conditions.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Click "I Agree"</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="agree" class="code" name="agree"><?php echo $agree ; ?></textarea>
            		</div>
                    <span class="description">Instructions displayed directly above the "I Agree" button.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label for="blogdescription">Other Options</label></th>
				<td>
				    <input type="checkbox" name="clear_all" id="clear_all" value="1">
                    <span class="description">Clear all previous user agreements so users can reaccept terms. Caution: there is no undo.</span><br/>
                    <input type="checkbox" name="show_date" id="show_date" value="checked='checked'" <?php echo $show_date ?>>
                    <span class="description">Show date accepted in user profile.</span><br/>
                    
                    <input type="checkbox" name="initials" id="initials" value="checked='checked'" <?php echo $initials ?>>
                    <span class="description">Show and require user initials on agreement.</span>
				</td>
         	</tr>
         	
       </table>

       <p class="submit">
           <input name="Submit" class="button-primary" value="Save Changes" type="submit">
       </p>
    </form>
    </div>
</div>