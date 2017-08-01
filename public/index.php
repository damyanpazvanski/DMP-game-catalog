<?php

session_start();

require_once __DIR__ . '/../DMP/DMP.php';
use \DMP\DMP;

$app = new DMP();

$app->run();