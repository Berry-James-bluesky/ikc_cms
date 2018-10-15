<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

$autoLoadFile = LOTE_LIB_PATH.'vendor/autoload.php';

if(!file_exists($autoLoadFile)) {
    die('Unable to load autoloader file');
}

$loader = require_once($autoLoadFile);

if(defined('APP_NAMESPACE')) {
    $loader->addPsr4(APP_NAMESPACE, LOTE_APP_PATH.'src/');
}
