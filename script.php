<?php
require 'vendor/autoload.php';

use Src\ScratchPointCalculator;

$calculator = new ScratchPointCalculator($argv[1], $argv[2], ',');
$calculator->calculate();
