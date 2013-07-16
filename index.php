<?php include_once('header.php'); ?>
<div id='content' class='row-fluid'>
    <div class='span9 main'>
        <h2>Change Log</h2>
    </div>
</div>
<?php
include_once('log4php/logger.php');

// Tell log4php to use our configuration file.
Logger::configure('configuration/log4php.xml');

// Fetch a logger, it will inherit settings from the root logger
$mylog = Logger::getLogger('myLogger');

$mylog->warn("User is on index Page");

?>
<?php include_once('footer.php'); ?>

