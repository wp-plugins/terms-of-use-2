<?php global $user_level;
    if ($user_level == 10){ ?>
<div id="button_bar">
<ul class="subsubsub">
    <li><a href="<?php echo TOU_ADMIN_EDIT_PAGE ?>?page=<?php echo TOU_PLUGIN_NAME; ?>/tou-settings.php">Edit Terms of Use</a> | </li>
    <li><a href="<?php echo TOU_ADMIN_PAGE ?>?page=<?php echo TOU_PLUGIN_NAME; ?>/terms-and-conditions.php">View Terms  of Use</a> | </li>
    <li><a href="<?php echo TOU_ADMIN_PAGE ?>?page=<?php echo TOU_PLUGIN_NAME; ?>/terms-and-conditions.php&tou=true">View Welcome Message</a></li>
</ul>
</div>
<div style="clear:both;"></div>
<?php } ?>