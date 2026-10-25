<?php // index.php
require_once __DIR__ . '/vendor/autoload.php';

$ds = DIRECTORY_SEPARATOR;
$log = new \Monolog\Logger("my_log");
$log->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . $ds . 'monolog.log', \Monolog\Level::Debug));
$log->error("error");
$log->warning("warning");

$duck = new \Hzielniski\LabComposer\Duck($log);
$duck->quack();
$duck->quack();
$duck->quack();
