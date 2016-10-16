<?php

/** Import Configuration **/
require_once(__DIR__.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'config.php');

/** Load Vendor libraries **/
require_once(__DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');

/** Load Abstract Base Classes **/
require_once(__DIR__.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'.abc.php');

/** Load Library Classes **/
$di = new DirectoryIterator(__DIR__.DIRECTORY_SEPARATOR.'lib');
foreach ($di as $item) {
  $file = $item->getFilename();
  if (substr($file, 0, 1) != '.') {
    require_once(__DIR__.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$file);
  }
}
