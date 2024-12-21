<?php
declare(strict_types=1);
require 'vendor/autoload.php';

use Yakoffka\DijkstrasAlgorithm\Stack\Stack;

$stack = new Stack();
$stack->show();

$stack->push('first_payload');
$stack->push('second_payload');
$stack->push('third_payload');
$stack->show();

$stack->peek();
$stack->peek();
$stack->show();

$stack->pop();
$stack->show();

$stack->pop();
$stack->show();

$stack->pop();
$stack->show();

$stack->pop();
$stack->show();
