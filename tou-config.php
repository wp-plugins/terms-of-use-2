<?php
define('TOU_PLUGIN_TITLE','Terms of Use');
define('TOU_PLUGIN_NAME','terms-of-use');
define('TOU_PATH',WP_PLUGIN_DIR.'/'.TOU_PLUGIN_NAME);
define('TOU_URL',WP_PLUGIN_URL.'/'.TOU_PLUGIN_NAME);

global $wpmu_version;

// Check for WPMU installation
if($wpmu_version)
    define('IS_WPMU', 1);
else
    define('IS_WPMU', 0);

?>