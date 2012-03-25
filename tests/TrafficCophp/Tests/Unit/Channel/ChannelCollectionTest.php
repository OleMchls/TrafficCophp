<?php

namespace TrafficCophp\Tests\Unit\Channel;

use TrafficCophp\Channel\ChannelCollection;

class ChannelCollectionTest extends \PHPUnit_Framework_TestCase {

	protected function getChannelMock($name) {
		$mock = $this->getMockBuilder('TrafficCophp\\Channel\\Channel')->setConstructorArgs(array($name))->getMock();
		$mock->expects($this->any())->method('getName')->will($this->returnValue($name));
		return $mock;
	}

	public function testInitializeEmptyCollection() {
		$collection = new ChannelCollection();
		$this->assertCount(0, $collection->getChannels());
	}

	public function testAddChannel() {
		$collection = new ChannelCollection();
		$channel = $this->getChannelMock('channel_one');
		$collection->addChannel($channel);
		$this->assertContains($channel, $collection->getChannels());
	}

	public function testAddMultipleChannels() {
		$collection = new ChannelCollection();
		$channel1 = $this->getChannelMock('channel_one');
		$collection->addChannel($channel1);
		$channel2 = $this->getChannelMock('channel_two');
		$collection->addChannel($channel2);
		$channel3 = $this->getChannelMock('channel_three');
		$collection->addChannel($channel3);
		$this->assertContains($channel1, $collection->getChannels());
		$this->assertContains($channel2, $collection->getChannels());
		$this->assertContains($channel3, $collection->getChannels());
	}

	public function testAddSameChannelTwice() {
		$collection = new ChannelCollection();
		$channel = $this->getChannelMock('channel_one');
		$collection->addChannel($channel);
		$channel_duplicate = $this->getChannelMock('channel_one');
		$collection->addChannel($channel_duplicate);
		$this->assertCount(1, $collection->getChannels());
	}

}