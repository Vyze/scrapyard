<?php
chdir('..');
require_once'../vendor/autoload.php';
require_once 'lib/ScrapYard.php';
$api=new ScrapYard('ScrapYard');
$api->main();
