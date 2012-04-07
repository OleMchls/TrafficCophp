<?php

namespace TrafficCophp\Tests\Unit\Channel;

use TrafficCophp\Channel\Channel;

class ChannelTest extends \PHPUnit_Framework_TestCase {

	public function testGetName() {
		$channel = new Channel('channel_one');
		$this->assertEquals('channel_one', $channel->getName());
	}

	/**
	 * @expectedException TrafficCophp\Channel\InvalidChannelNameException
	 */
	public function testInvalidName() {
		$channel = new Channel('channel,one');
	}

}