<?php

/**
 * @package SQLayer
 * @version 0.0.4
 * @date    2016-11-08
 * @author  Roderic Linguri <linguri@digices.com>
 * @license MIT
 */

/** Autoloader **/

// import configuration
require_once(__DIR__.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'config.php');

// path to lib directory
$lib = __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;

// create iterator
$di = new DirectoryIterator($lib);

// require each file in lib directory
foreach ($di as $item) {
  $file = $item->getFilename();
  if (substr($file,0,1) != '.') {
    require_once($lib.$file);
  }
}
