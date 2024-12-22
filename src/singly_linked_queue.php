<?php
declare(strict_types=1);

use Yakoffka\DijkstrasAlgorithm\SinglyLinkedRealQueue\Queue;

require 'vendor/autoload.php';

$queue = new Queue();
$queue->show();

$queue->push('first');
$queue->push('second');
$queue->push('third');
$queue->push('fourth');
$queue->show();

$queue->shift();
$queue->show();

$queue->shift();
$queue->show();

$queue->shift();
$queue->show();

$queue->shift();
$queue->show();

$queue->shift();
$queue->show();

$queue->shift();
$queue->show();

$queue->push('fifth');
$queue->show();

$queue->push('sixth');
$queue->show();
