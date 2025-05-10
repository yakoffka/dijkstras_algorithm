<?php
declare(strict_types=1);

use Yakoffka\DijkstrasAlgorithm\Queue\SinglyLinkedRealQueue\SQueue;

require 'vendor/autoload.php';

$queue = new SQueue();
$queue->show();

$queue->enqueue('first');
$queue->enqueue('second');
$queue->enqueue('third');
$queue->enqueue('fourth');
$queue->show();

$queue->dequeue();
$queue->show();

$queue->dequeue();
$queue->show();

$queue->dequeue();
$queue->show();

$queue->dequeue();
$queue->show();

$queue->dequeue();
$queue->show();

$queue->dequeue();
$queue->show();

$queue->enqueue('fifth');
$queue->show();

$queue->enqueue('sixth');
$queue->show();
