<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Asciishop\Asciishop;
use Asciishop\Canvas;
use Symfony\Component\Console\Shell;

// Setup Canvas
$canvas = new Canvas();

// Setup console application
$app = new Asciishop($canvas);
$app->init();

// Create shell wrapper for console application
$shell = new Shell($app);
$shell->run();
