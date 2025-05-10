<?php
declare(strict_types=1);

use Yakoffka\DijkstrasAlgorithm\Queue\DoublyLinkedRealQueue\DQueue;

require 'vendor/autoload.php';

$queue = new DQueue();
$queue->show();

$queue->enqueue('first');
$queue->enqueue('second');
$queue->enqueue('third');
$queue->enqueue('fourth');
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

//$queue->show();

$queue->dequeue();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->dequeue();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->dequeue();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->dequeue();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->dequeue();
$queue->show();
// print_r(json_decode(json_encode($queue, JSON_THROW_ON_ERROR), true));

$queue->dequeue();
$queue->show();

$queue->enqueue('fifth');
$queue->show();

$queue->enqueue('sixth');
$queue->show();
