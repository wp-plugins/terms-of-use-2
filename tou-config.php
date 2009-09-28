<?php
global $wpmu_version;

// Check for WPMU installation
if($wpmu_version)
    define('IS_WPMU', 1);
else
    define('IS_WPMU', 0);
    
define('TOU_PLUGIN_TITLE','Terms of Use');
define('TOU_PLUGIN_NAME','terms-of-use-2');
define('TOU_PATH',WP_PLUGIN_DIR.'/'.TOU_PLUGIN_NAME);
define('TOU_URL',WP_PLUGIN_URL.'/'.TOU_PLUGIN_NAME);
define('TOU_ADMIN_PAGE', 'index.php');
define('TOU_ADMIN_EDIT_PAGE', (IS_WPMU)?('wpmu-admin.php'):('options-general.php'));
?>