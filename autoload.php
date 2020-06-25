<?php

function autoloadClassesDir($class) {
  $baseDir = __DIR__.'/classes/';

  $file = $baseDir.str_replace('\\', '/', $class).'.php';

  if (file_exists($file)) {
    require $file;
  }
}

spl_autoload_register("autoloadClassesDir");