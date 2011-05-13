<div class="wrap">
    <div id="icon-edit-pages" class="icon32"><br></div>
	<h2><?php _e('Terms of Use Settings', 'terms_of_use') ?></h2>
	
	<?php require(TOU_VIEWS_PATH.'/shared/errors.php'); ?>
    <?php require(TOU_VIEWS_PATH.'/shared/nav.php'); ?>
    
    <form name="tou_settings_form" action="" method="post">
        <p class="submit">
            <input name="Submit" class="button-primary" value="Save Changes" type="submit">
        </p>
        
        <input type="hidden" name="action" value="process-form" />
        <?php wp_nonce_field('update-options'); ?>
        <div id="post-body-content">
        
    	<table class="form-table categorydiv" id="poststuff">
        	<tr>
				<th scope="row"><?php _e('Website Name', 'terms_of_use') ?></th>
				<td>
				    <input name="site_name" id="site_name" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->site_name)); ?>" class="regular-text" />
                    <span class="description"><?php _e('Website Name will replace <b>[website-name]</b> in messages when displayed.', 'terms_of_use') ?></span>
				</td>
         	</tr>
            
            <tr class="form-field">
				<th scope="row"><?php _e('Form Instructions', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="member_agreement" name="member_agreement"><?php echo stripslashes($tou_settings->member_agreement) ?></textarea>
            		</div>
                    <span class="description"><?php _e('Instructions displayed above terms.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
            <tr>
				<th scope="row"><?php _e('Terms and Conditions', 'terms_of_use') ?></th>
				<td>
				    <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea">
            			<?php the_editor(stripslashes($tou_settings->terms), 'terms', 'title', false); ?>
            		</div>
					<span class="description"><?php _e('Leaving the Terms blank will remove the "Terms and Conditions" box on the agreement page. Use shortcode [terms-of-use] to place in a page or post.', 'terms_of_use') ?></span>
				</td>
         	</tr>

            <tr class="form-field">
				<th scope="row"><?php _e('Privacy Policy', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="privacy_policy" name="privacy_policy" rows="10"><?php echo stripslashes($tou_settings->privacy_policy) ?></textarea>
            		</div>
					<span class="description"><?php _e('Leaving Privacy Policy blank will remove the "Privacy Policy" box on the agreement page', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Welcome Message', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="welcome" name="welcome" rows="10"><?php echo stripslashes($tou_settings->welcome) ?></textarea>
            		</div>
                    <span class="description"><?php _e('This message is displayed after the user agrees to the terms and conditions.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Agreement Instructions', 'terms_of_use') ?></th>
				<td>
				    <input name="agreement_text" id="agreement_text" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->agreement_text)); ?>" class="regular-text" />
                    <span class="description"><?php _e('Instructions displayed next to check box for user agreement. Link to the terms page will replace <b>[terms-url]</b> when displayed.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Click "I Agree"', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="agree" name="agree"><?php echo stripslashes($tou_settings->agree) ?></textarea>
            		</div>
                    <span class="description"><?php _e('Instructions displayed directly above the "I Agree" button.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><?php _e('Other Options', 'terms_of_use') ?></th>
				<td>
				    <input type="checkbox" name="clear_all" id="clear_all" value="1" />
                    <span class="description"><?php _e('Clear all previous user agreements so users can reaccept terms. Caution: There is no undo.', 'terms_of_use') ?></span><br/>
                    <input type="checkbox" name="show_date" id="show_date" value="1" <?php checked($tou_settings->show_date, '1') ?> />
                    <span class="description"><?php _e('Show date accepted in user profile.', 'terms_of_use') ?></span><br/>
                    
                    <input type="checkbox" name="initials" id="initials" value="1" <?php checked($tou_settings->initials, '1') ?> />
                    <span class="description"><?php _e('Show and require user initials on agreement.', 'terms_of_use') ?></span><br/>
                    
                    <input type="checkbox" name="signup_page" id="signup_page" value="1" <?php checked($tou_settings->signup_page, '1') ?> />
                    <span class="description"><?php _e('Show and require term agreement on signup page. NOTE: Will not show unless the Terms page is specified below.', 'terms_of_use') ?></span>
                    
                    <?php if (function_exists('add_comment_meta')){ ?>
                    <br/>
                    <input type="checkbox" name="comment_form" id="comment_form" value="1" <?php checked($tou_settings->comment_form, '1') ?> />
                    <span class="description"><?php _e('Show and require term agreement on comment form. NOTE: Will not show unless the Terms page is specified below.', 'terms_of_use') ?></span>
                    <?php } ?>
				</td>
         	</tr>
         	
         	<tr>
				<th scope="row"><?php _e('Terms Page Admin Menu', 'terms_of_use') ?></th>
				<td>
				    <select name="menu_page">
				        <?php foreach ($admin_menu_options as $page => $page_name){ ?>
				            <option value="<?php echo $page ?>" <?php selected($tou_settings->menu_page, $page) ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description"><?php _e('The admin menu item to place the terms under. This is what users will see. IMPORTANT: Make sure to select a menu item your users have access to. Otherwise, they will be blocked by permissions errors.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr>
         	    <th scope="row"><?php _e('Require Term Agreement to Access', 'terms_of_use') ?>:</th>
				<td><?php _e('Admin Page(s)', 'terms_of_use') ?>
				    <div class="tabs-panel" style="height:auto">
				        <div style="width:50%" class="alignleft">
				        <?php 
				        $i = 0;
				        foreach ($admin_page_list as $page => $page_name){
				            if($i == 3){ ?>
				        </div>
				        <div style="width:50%" class="alignright">
				        <?php    
				            }
				            $i++;
				        ?>
				        <input type="checkbox" name="admin_page[]" value="<?php echo $page ?>" <?php TouAppHelper::checked( (array)$tou_settings->admin_page, $page) ?> /> <?php echo $page_name ?><br/>
				        <?php } ?>
				        </div>
				        <div class="clear"></div>
				    </div>
				    <?php _e('Front-end Page(s)', 'terms_of_use') ?>
				    <div class="tabs-panel" style="height:140px">
				        <div style="width:50%" class="alignleft">
				    <?php
				        $i = 0;
				        foreach ($pages as $page){ 
				            if($i == $half_pages){ ?>
				        </div>
				        <div style="width:50%" class="alignright">
				        <?php    
				            }
				            $i++;
				        ?>
				            <input type="checkbox" name="frontend_page[]" value="<?php echo $page->ID ?>" <?php TouAppHelper::checked((array)$tou_settings->frontend_page, $page->ID) ?> /> <?php echo substr($page->post_title, 0, 50) ?><br/>
				    <?php } ?>  
				        </div>
				        <div class="clear"></div>
				    </div>
				    
				    <?php if(class_exists('FrmForm')){ ?>
				    <?php _e('Formidable Forms', 'terms_of_use') ?>
                    <div style="margin-top:20px;">
                    <p><?php _e('Show and require terms in the following forms', 'terms_of_use') ?>:<br/>
                        <div class="tabs-panel" style="height:140px">
                            <div style="width:50%" class="alignleft">
                            <?php TouAppHelper::forms_checkboxes( 'frm_forms', $tou_settings->frm_forms, 2 ) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </p>
                    </div>
                    <?php } ?>
				</td>
			</tr>
			
         	<tr>
				<th scope="row"><?php _e('Terms Page', 'terms_of_use') ?></th>
				<td>
				    <select name="terms_url">
				        <option value=""></option>
				        <?php foreach ($pages as $page){ ?>
				            <option value="<?php echo $page->ID ?>"<?php echo ($tou_settings->terms_url == $page->ID or (!is_numeric($tou_settings->terms_url) and $tou_settings->terms_url == get_permalink($page->ID)))?(' selected=selected'):(''); ?>><?php echo $page->post_title ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description"><?php _e('Select front-end terms page if requiring terms agreement for front-end page. Use shortcode [terms-of-use] in your page.', 'terms_of_use') ?></span>
				</td>
         	</tr>	
       </table>
       
       <p class="submit">
           <input name="Submit" class="button-primary" value="<?php _e('Save Changes', 'terms_of_use') ?>" type="submit">
       </p>
    </form>
    </div>
</div>
<style type="text/css">
#editorcontainer #terms{width:100%;margin:0;}
</style>