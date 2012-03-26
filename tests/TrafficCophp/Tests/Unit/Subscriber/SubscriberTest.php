<?php

namespace TrafficCophp\Tests\Unit\Subscriber;

use TrafficCophp\Subscriber\Subscriber;

class SubscriberTest extends \PHPUnit_Framework_TestCase {

	protected function getTransportMock() {
		return $this->getMockBuilder('TrafficCophp\\Network\\SocketTransport')->setConstructorArgs(array('127.0.0.1', 1337))->getMock();
	}

	public function testRegisterOnSingleChannel() {
		$transportMock = $this->getTransportMock();
		$transportMock->expects($this->once())->method('send');

		$messageMock = $this->getMockBuilder('TrafficCophp\\Message\\SubscribeMessage')->disableOriginalConstructor()->getMock();

		$subscriber = new Subscriber($transportMock);
		$subscriber->subscribe($messageMock);
	}

	public function testRegisterOnMultipleChannels() {
		$transportMock = $this->getTransportMock();
		$transportMock->expects($this->exactly(2))->method('send');

		$subscriber = new Subscriber($transportMock);

		$messageMock = $this->getMockBuilder('TrafficCophp\\Message\\SubscribeMessage')->disableOriginalConstructor()->getMock();
		$subscriber->subscribe($messageMock);

		$messageMock = $this->getMockBuilder('TrafficCophp\\Message\\SubscribeMessage')->disableOriginalConstructor()->getMock();
		$subscriber->subscribe($messageMock);
	}

}