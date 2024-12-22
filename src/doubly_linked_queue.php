<?php
declare(strict_types=1);

use Yakoffka\DijkstrasAlgorithm\DoublyLinkedRealQueue\Queue;

require 'vendor/autoload.php';

$queue = new Queue();
$queue->show();

$queue->push('first');
$queue->push('second');
$queue->push('third');
$queue->push('fourth');
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

//$queue->show();

$queue->shift();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->shift();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->shift();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->shift();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->shift();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->shift();
$queue->show();

$queue->push('fifth');
$queue->show();

$queue->push('sixth');
$queue->show();
