<?php

require __DIR__ . '/vendor/.composer/autoload.php';

use TrafficCophp\ByteBuffer\ByteBuffer;

$channel = utf8_encode('channel_one');
$message = utf8_encode('php');

$buffer = new ByteBuffer(4 + 1 + 4 + strlen($channel) + strlen($message));
$buffer->writeInt32BE($buffer->length(), 0);
$buffer->writeInt8(0x1, 4);
$buffer->writeInt32BE(strlen($channel), 5);
$buffer->write($channel, 9);
$buffer->write($message, 9 + strlen($channel));

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$result = socket_connect($socket, '127.0.0.1', 3542);

file_put_contents('dumputf8.txt', (string) $buffer);
var_dump((string) $buffer);
//die();

$written = socket_write($socket, (string) $buffer, $buffer->length());
var_dump($written);
//while ($out = socket_read($socket, 1, PHP_BINARY_READ)) {
//    var_dump($out);
//}
//export XDEBUG_CONFIG="netbeans-xdebug"