<?php

require __DIR__ . '/vendor/.composer/autoload.php';

use TrafficCophp\ByteBuffer\ByteBuffer;

$channel = 'channel_one';
$message = 'php';

$publish = new ByteBuffer(4 + 1 + 4 + strlen($channel) + strlen($message));
$publish->writeInt32BE($publish->length() - 4, 0);
$publish->writeInt8(0x1, 4);
$publish->writeInt32BE(strlen($channel), 5);
$publish->write($channel, 9);
$publish->write($message, 9 + strlen($channel));

$subscribe = new ByteBuffer(4 + 1 + 4 + strlen($channel));
$subscribe->writeInt32BE($subscribe->length() - 4, 0);
$subscribe->writeInt8(0x2, 4);
$subscribe->writeInt32BE(strlen($channel), 5);
$subscribe->write($channel, 9);

$socket_write = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket_write, '127.0.0.1', 3542);

file_put_contents('dump.txt', (string) $publish);
var_dump((string) $publish);
//die();

$written = socket_write($socket_write, (string) $publish, $publish->length());
var_dump($written);
$written = socket_write($socket_write, (string) $subscribe, $subscribe->length());
var_dump($written);
while ($out = socket_read($socket_write, 1, PHP_BINARY_READ)) {
    var_dump($out);
}