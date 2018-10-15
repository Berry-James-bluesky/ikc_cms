#!/usr/bin/env php
<?php
chdir(__DIR__);
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */
require __DIR__ . '/lib/init.php';

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

$input = new ArgvInput();

$s = new \SidraBlue\Lote\State\Cli();
try {
    $s->getConsoleApplication()->run($input);
}
catch(\Exception $e) {
    $s->getConsoleApplication()->renderException($e, new ConsoleOutput());
}
