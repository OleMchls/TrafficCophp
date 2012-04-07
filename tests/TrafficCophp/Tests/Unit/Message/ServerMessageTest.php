<?php

namespace TrafficCophp\Tests\Unit\Message;

use TrafficCophp\Message\ServerMessage;
use TrafficCophp\Channel\ChannelCollection;

use TrafficCophp\ByteBuffer\Buffer;

class ServerMessageTest extends \PHPUnit_Framework_TestCase {

	protected function getRawData($channels, $message) {
		$buffer = new Buffer(4 + strlen($channels) + strlen($message));
		$buffer->writeInt32BE(strlen($channels), 0);
		$buffer->write($channels, 4);
		$buffer->write($message, 4+strlen($channels));
		return (string) $buffer;
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testAttributeWithoutParseingBefore() {
		$srvMsg = new ServerMessage(new ChannelCollection());
		$srvMsg->getMessage();
	}

	public function testGetMessage() {
		$channel = 'channel_one';
		$message = 'hello world';

		$srvMsg = new ServerMessage(new ChannelCollection());
		$srvMsg->parse($this->getRawData($channel, $message));

		$this->assertEquals($message, $srvMsg->getMessage());
	}

	public function testGetAddressedChannelsWithOneChannel() {
		$channel = 'channel_one';
		$message = 'hello world';

		$srvMsg = new ServerMessage(new ChannelCollection());
		$srvMsg->parse($this->getRawData($channel, $message));

		$channels = $srvMsg->getAddressedChannels();
		$channels->rewind();
		$this->assertEquals($channel, $channels->current()->getName());
	}

	public function testGetAddressedChannelsWithMultipleChannels() {
		$rawChannels = array();
		$rawChannels[] = 'channel_one';
		$rawChannels[] = 'channel_two';
		$message = 'hello world';

		$srvMsg = new ServerMessage(new ChannelCollection());
		$srvMsg->parse($this->getRawData(implode(',', $rawChannels), $message));

		foreach ($srvMsg->getAddressedChannels() as $channel) {
			/* @var $channel \TrafficCophp\Channel\Channel */
			$this->assertContains($channel->getName(), $rawChannels);
		}
	}

}