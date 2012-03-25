<?php

namespace TrafficCophp\Tests\Unit\Message;

use TrafficCophp\Message\PublisherMessage;
use TrafficCophp\ByteBuffer\ByteBuffer;

/**
 * Description of runTest
 *
 * @author ole
 */
class PublisherMessageTest extends \PHPUnit_Framework_TestCase {

	public function testGetChannel() {
		$publisherMsg = new PublisherMessage('channel', 'message');
		$this->assertEquals('channel', $publisherMsg->getChannel());
	}

	public function testGetMessage() {
		$publisherMsg = new PublisherMessage('channel', 'message');
		$this->assertEquals('message', $publisherMsg->getMessage());
	}

	public function testGetProtokollString() {
		$channel = 'channel_one';
		$message = 'php';

		$buffer = new ByteBuffer(4 + 1 + 4 + strlen($channel) + strlen($message));
		$buffer->writeInt32BE($buffer->length() - 4, 0);
		$buffer->writeInt8(0x1, 4);
		$buffer->writeInt32BE(strlen($channel), 5);
		$buffer->write($channel, 9);
		$buffer->write($message, 9 + strlen($channel));

		$publisherMsg = new PublisherMessage($channel, $message);
		$this->assertEquals((string) $buffer, $publisherMsg->getProtokollString());
	}

	public function testGetLength() {
		$publisherMsg = new PublisherMessage('channel', 'message');
		$this->assertEquals(23, $publisherMsg->getLength());
	}

}