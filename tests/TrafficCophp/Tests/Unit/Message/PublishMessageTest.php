<?php

namespace TrafficCophp\Tests\Unit\Message;

use TrafficCophp\Message\PublishMessage;
use TrafficCophp\Channel\Channel;
use TrafficCophp\ByteBuffer\ByteBuffer;

/**
 * Description of runTest
 *
 * @author ole
 */
class PublishMessageTest extends \PHPUnit_Framework_TestCase {

	public function testGetChannel() {
		$channel = new Channel('channel');
		$msg = new PublishMessage($channel, 'message');
		$this->assertEquals($channel, $msg->getChannel());
	}

	public function testGetMessage() {
		$channel = new Channel('channel');
		$msg = new PublishMessage($channel, 'message');
		$this->assertEquals('message', $msg->getMessage());
	}

	public function testGetProtokollString() {
		$channel = new Channel('channel');
		$message = 'php';

		$buffer = new ByteBuffer(4 + 1 + 4 + strlen($channel->getName()) + strlen($message));
		$buffer->writeInt32BE($buffer->length() - 4, 0);
		$buffer->writeInt8(0x1, 4);
		$buffer->writeInt32BE(strlen($channel->getName()), 5);
		$buffer->write($channel->getName(), 9);
		$buffer->write($message, 9 + strlen($channel->getName()));

		$msg = new PublishMessage($channel, $message);
		$this->assertEquals((string) $buffer, $msg->getProtokollString());
	}

	public function testGetLength() {
		$channel = new Channel('channel');
		$msg = new PublishMessage($channel, 'message');
		$this->assertEquals(23, $msg->getLength());
	}

}