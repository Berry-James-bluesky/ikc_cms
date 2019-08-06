<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */
date_default_timezone_set('UTC');

$baseDir = dirname(str_replace('\\', '/',__DIR__)).'/';

define('LOTE_BASE_PATH', $baseDir);
define('LOTE_APP_PATH', LOTE_BASE_PATH . 'app/');
define('LOTE_ASSET_PATH', LOTE_BASE_PATH . 'asset/');
define('LOTE_LIB_PATH', LOTE_BASE_PATH . 'lib/');
define('LOTE_CONF_PATH', LOTE_BASE_PATH . 'app/conf/');
define('LOTE_LIB_APP_PATH', LOTE_LIB_PATH . 'app/');
define('LOTE_FRAMEWORK_PATH', LOTE_LIB_PATH . 'vendor/bluesky/framework/src/');
define('LOTE_WEB_PATH', $baseDir . '/web/');

$config = json_decode(file_get_contents(LOTE_BASE_PATH.'lote.json'), true);
if($config['namespace']) {
    define('APP_NAMESPACE', $config['namespace'].'\\');
}

require LOTE_LIB_PATH . 'autoload.php';

define('LOTE_ACCOUNT_REF', getLoteAccountRef('dev'));
define('LOTE_TEMP_PATH', LOTE_ASSET_PATH . 'temp/' . LOTE_ACCOUNT_REF . '/');
define('LOTE_CACHE_PATH', LOTE_ASSET_PATH . 'cache/' . LOTE_ACCOUNT_REF . '/');
define('LOTE_LOG_PATH', LOTE_ASSET_PATH . 'log/' . LOTE_ACCOUNT_REF . '/');
