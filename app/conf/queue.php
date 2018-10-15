<?php
/**
 * Configuration file
 */

define('QUEUE_MAX_RETRY_COUNT', 0);

define('LOTE_QUEUE_LOG_PATH', LOTE_ASSET_PATH . 'log/' . LOTE_ACCOUNT_REF . '/');

define("QUEUE_FAILED_LOG", realpath(LOTE_ASSET_PATH . '../../asset/log/_queue').'/failed/');

define('LOTE_DEBUG', false);
define('BOUNCE_HARD_MAX', 10);
define('BOUNCE_SOFT_MAX', 20);

$settings = [
    'REDIS_BACKEND'     => '127.0.0.1:6379',    // Set Redis Backend Info
    'REDIS_BACKEND_DB'  => '0',                 // Use Redis DB 0
    'COUNT'             => '1',                 // Run 1 worker
    'INTERVAL'          => '5',                 // Run every 5 seconds
    'QUEUE'             => REDIS_QUEUE_NAMES,                 // Look in all queues
    'PREFIX'            => 'resque',            // Prefix queues with resque
];

foreach ($settings as $key => $value) {
    putenv(sprintf('%s=%s', $key, $value));
}
