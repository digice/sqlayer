<?php

$deps = json_decode(file_get_contents(dirname(__DIR__).DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'require.json'));

foreach ($deps as $dep) {
  $name = $dep->package;
  echo $name;
  if (!file_exists(dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.$dep->package.DIRECTORY_SEPARATOR.'autoload.php')) {
    $cmd = 'git clone '.$dep->link.' '.dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.$dep->package;
    exec($cmd);
  }
}
