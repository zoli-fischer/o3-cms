<?php

/**
* Hourly cronjob run by server
*/

/**
* Clear the temporary/expired transfers
*/

//Require transfers class
require_once(O3_CMS_THEME_DIR.'/classes/snapfer_transfers.php');

//unlink old transfers  
o3_with(new snapfer_transfers())->unlink_old_transfers();

/**
* Renew subscriptions
*/
//TODO

//stop the script
die();

?>