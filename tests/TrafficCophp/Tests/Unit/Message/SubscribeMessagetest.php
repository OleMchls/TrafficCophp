<?php

namespace TrafficCophp\Tests\Unit\Message;

use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Message\SubscribeMessage;

use TrafficCophp\ByteBuffer\Buffer;

class SubscribeMessageTest extends \PHPUnit_Framework_TestCase {

	protected function getChannelMock($name) {
		$mock = $this->getMockBuilder('TrafficCophp\\Channel\\Channel')->setConstructorArgs(array($name))->getMock();
		$mock->expects($this->any())->method('getName')->will($this->returnValue($name));
		return $mock;
	}

	public function testGetProtokollString() {
		$objectStoreage = new \SplObjectStorage();
		$objectStoreage->attach($this->getChannelMock('channel_one'));
		$objectStoreage->attach($this->getChannelMock('channel_two'));
		$channels = $this->getMock('TrafficCophp\\Channel\\ChannelCollection');
		$channels->expects($this->any())->method('getChannels')->will($this->returnValue($objectStoreage));
		$msg = new SubscribeMessage($channels);

		$raw_channel_string = 'channel_one,channel_two';
		$buf = new Buffer(4 + 1 + 4 + strlen($raw_channel_string));
		$buf->writeInt32BE($buf->length() - 4, 0);
		$buf->writeInt8(0x2, 4);
		$buf->writeInt32BE(strlen($raw_channel_string), 5);
		$buf->write($raw_channel_string, 9);

		$this->assertSame((string) $buf, $msg->getProtokollString());
	}

	public function testGetLenght() {
		$objectStoreage = new \SplObjectStorage();
		$objectStoreage->attach($this->getChannelMock('channel_one'));
		$objectStoreage->attach($this->getChannelMock('channel_two'));
		$channels = $this->getMock('TrafficCophp\\Channel\\ChannelCollection');
		$channels->expects($this->any())->method('getChannels')->will($this->returnValue($objectStoreage));
		$msg = new SubscribeMessage($channels);
		$this->assertEquals(32, $msg->getLength());
	}

}