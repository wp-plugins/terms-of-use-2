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
				    <input name="site_name" id="site_name" type="text" value="<?php echo $tou_name; ?>" class="regular-text" />
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
					<span class="description">Leaving the Terms blank will remove the "Terms and Conditions" box on the agreement page. Use shortcode [terms-of-use] to place in a page or post.</span>
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
				<th scope="row"><label>Welcome Message</label></th>
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
				<th scope="row"><label>Other Options</label></th>
				<td>
				    <input type="checkbox" name="clear_all" id="clear_all" value="1">
                    <span class="description">Clear all previous user agreements so users can reaccept terms. Caution: there is no undo.</span><br/>
                    <input type="checkbox" name="show_date" id="show_date" value="checked='checked'" <?php echo $show_date ?>>
                    <span class="description">Show date accepted in user profile.</span><br/>
                    
                    <input type="checkbox" name="initials" id="initials" value="checked='checked'" <?php echo $initials ?>>
                    <span class="description">Show and require user initials on agreement.</span><br/>
                    
                    <input type="checkbox" name="signup_page" id="signup_page" value="checked='checked'" <?php echo $signup_page ?>>
                    <span class="description">Show and require term agreement on signup page. NOTE: Will not show unless the Terms page is specified below.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Terms Page Admin Menu</label></th>
				<td>
				    <select name="menu_page">
				        <?php foreach ($admin_menu_options as $page => $page_name){?>
				            <option value="<?php echo $page ?>"<?php echo ($menu_page == $page)?(' selected=selected'):(''); ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description">Full URL of front-end terms page including http://. Use shortcode [terms-of-use] in your page.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Terms Page URL</label></th>
				<td>
				    <input name="terms_url" id="terms_url" type="text" value="<?php echo $terms_url; ?>" class="regular-text" /><br/>
                    <span class="description">Full URL of front-end terms page including http://. Use shortcode [terms-of-use] in your page.</span>
				</td>
         	</tr>
         	
         	<tr>
         	    <th scope="row"><label>Require Term Agreement to Access:</label></th>
				<td>Admin Pages
				    <select name="admin_page">
				        <option value="">Don't require in admin</option>
				        <?php foreach ($admin_page_list as $page => $page_name){?>
				            <option value="<?php echo $page ?>"<?php echo ($admin_page == $page)?(' selected=selected'):(''); ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
				    Front-end Page
				    <select name="frontend_page">
				        <option value="">None</option>
				        <?php foreach ($pages as $page){ ?>
				            <option value="<?php echo $page->ID ?>"<?php echo ($frontend_page == $page->ID)?(' selected=selected'):(''); ?>><?php echo $page->post_title ?></option>
				        <?}?>
				    </select>    
				</td>
			</tr>	
       </table>
       
       <p class="submit">
           <input name="Submit" class="button-primary" value="Save Changes" type="submit">
       </p>
    </form>
    </div>
</div>