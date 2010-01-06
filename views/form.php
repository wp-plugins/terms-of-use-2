<div class="wrap">
    <div id="icon-edit-pages" class="icon32"><br></div>
	<h2><?php echo TOU_PLUGIN_TITLE ?> Settings</h2>
	<?php if ($message){ ?><div id="message" class="updated fade" style="padding:5px;"><?php echo $message; ?></div><?php } ?>
    <?php require('nav.php');?>
    <form name="form1" action="?page=<?php echo TOU_PLUGIN_NAME ?>/tou-settings.php" method="post">
        <?php wp_nonce_field('update-options'); ?>
        <div id="post-body-content">
        
    	<table class="form-table" id="poststuff">
        	<tr>
				<th scope="row"><label>Website Name</label></th>
				<td>
				    <input name="site_name" id="site_name" type="text" value="<?php echo stripslashes($tou_data['site_name']); ?>" class="regular-text" />
                    <span class="description">Website Name will replace <b>[website-name]</b> in messages when displayed.</span>
				</td>
         	</tr>
            
            <tr>
				<th scope="row"><label>Form Instructions</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="member_agreement" class="code" name="member_agreement"><?php echo stripslashes($tou_data['member_agreement']); ?></textarea>
            		</div>
                    <span class="description">Instructions displayed above terms.</span>
				</td>
         	</tr>
         	
            <tr>
				<th scope="row"><label>Terms and Conditions</label></th>
				<td>
				    <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea">
            			<?php the_editor(stripslashes($tou_data['terms']), 'terms', 'title', false); ?>
            		</div>
					<span class="description">Leaving the Terms blank will remove the "Terms and Conditions" box on the agreement page. Use shortcode [terms-of-use] to place in a page or post.</span>
				</td>
         	</tr>

            <tr>
				<th scope="row"><label>Privacy Policy</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="privacy_policy" class="code" name="privacy_policy" rows="10"><?php echo stripslashes($tou_data['privacy_policy']); ?></textarea>
            		</div>
					<span class="description">Leaving Privacy Policy blank will remove the "Privacy Policy" box on the agreement page</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Welcome Message</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="welcome" class="code" name="welcome" rows="10"><?php echo stripslashes($tou_data['welcome']); ?></textarea>
            		</div>
                    <span class="description">This message is displayed after the user agrees to the terms and conditions.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Click "I Agree"</label></th>
				<td>
				    <div id="postdiv">
				        <textarea id="agree" class="code" name="agree"><?php echo stripslashes($tou_data['agree']); ?></textarea>
            		</div>
                    <span class="description">Instructions displayed directly above the "I Agree" button.</span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Other Options</label></th>
				<td>
				    <input type="checkbox" name="clear_all" id="clear_all" value="1">
                    <span class="description">Clear all previous user agreements so users can reaccept terms. Caution: There is no undo.</span><br/>
                    <input type="checkbox" name="show_date" id="show_date" value="1" <?php checked($tou_data['show_date'], '1') ?>>
                    <span class="description">Show date accepted in user profile.</span><br/>
                    
                    <input type="checkbox" name="initials" id="initials" value="1" <?php checked($tou_data['initials'], '1') ?>>
                    <span class="description">Show and require user initials on agreement.</span><br/>
                    
                    <input type="checkbox" name="signup_page" id="signup_page" value="1" <?php checked($tou_data['signup_page'], '1') ?>>
                    <span class="description">Show and require term agreement on signup page. NOTE: Will not show unless the Terms page is specified below.</span>
                    
                    <?php if (function_exists('add_comment_meta')){ ?>
                    <br/>
                    <input type="checkbox" name="comment_form" id="comment_form" value="1" <?php checked($tou_data['comment_form'], '1') ?>>
                    <span class="description">Show and require term agreement on comment form. NOTE: Will not show unless the Terms page is specified below.</span>
                    <?php } ?>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><label>Terms Page Admin Menu</label></th>
				<td>
				    <select name="menu_page">
				        <?php foreach ($admin_menu_options as $page => $page_name){ ?>
				            <option value="<?php echo $page ?>" <?php selected($tou_data['menu_page'], $page) ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description">The admin menu item to place the terms under. This is what users will see. IMPORTANT: Make sure to select a menu item your users have access to. Otherwise, they will be blocked by permissions errors.</span>
				</td>
         	</tr>
         	
         	<tr>
         	    <th scope="row"><label>Require Term Agreement to Access:</label></th>
				<td>Admin Page(s)
				    <select name="admin_page">
				        <option value="">Don't require in admin</option>
				        <?php foreach ($admin_page_list as $page => $page_name){?>
				            <option value="<?php echo $page ?>" <?php selected($tou_data['admin_page'], $page) ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
				    Front-end Page
				    <select name="frontend_page">
				        <option value="">None</option>
				        <?php foreach ($pages as $page){ ?>
				            <option value="<?php echo $page->ID ?>" <?php selected($tou_data['frontend_page'], $page->ID) ?>><?php echo $page->post_title ?></option>
				        <?php } ?>
				    </select>    
				</td>
			</tr>
			
         	<tr>
				<th scope="row"><label>Terms Page</label></th>
				<td>
				    <select name="terms_url">
				        <option value=""></option>
				        <?php foreach ($pages as $page){ ?>
				            <option value="<?php echo $page->ID ?>"<?php echo ($tou_data['terms_url'] == $page->ID or (!is_numeric($tou_data['terms_url']) && $tou_data['terms_url'] == get_permalink($page->ID)))?(' selected=selected'):(''); ?>><?php echo $page->post_title ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description">Select front-end terms page if requiring terms agreement for front-end page. Use shortcode [terms-of-use] in your page.</span>
				</td>
         	</tr>	
       </table>
       
       <p class="submit">
           <input name="Submit" class="button-primary" value="Save Changes" type="submit">
       </p>
    </form>
    </div>
</div>