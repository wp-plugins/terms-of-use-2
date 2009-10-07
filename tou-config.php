<?php
// Check for WPMU installation
if (!defined ('IS_WPMU')){
global $wpmu_version;
if($wpmu_version)
    define('IS_WPMU', 1);
else
    define('IS_WPMU', 0);
}
    
global $tou_settings; 
if(IS_WPMU)
    $tou_settings = get_site_option('tou_options');
else
    $tou_settings = get_option('tou_options');

$tou_admin_menu = (isset($tou_settings['menu_page']))?($tou_settings['menu_page']):('index.php');
   
define('TOU_PLUGIN_TITLE','Terms of Use');
define('TOU_PLUGIN_NAME','terms-of-use-2');
define('TOU_PATH',WP_PLUGIN_DIR.'/'.TOU_PLUGIN_NAME);
define('TOU_URL',WP_PLUGIN_URL.'/'.TOU_PLUGIN_NAME);
define('TOU_ADMIN_PAGE', $tou_admin_menu);
define('TOU_ADMIN_EDIT_PAGE', (IS_WPMU)?('wpmu-admin.php'):('options-general.php'));
?>