<?php

namespace TrafficCophp\Tests\Unit\Publisher;

use TrafficCophp\Publisher\Publisher;

/**
 * Description of PublisherTest
 *
 * @author ole
 */
class PublisherTest extends \PHPUnit_Framework_TestCase  {

	public function testSingleSend() {
		$transportMock = $this->getMockBuilder('TrafficCophp\\Network\\SocketTransport')->setConstructorArgs(array('127.0.0.1', 1337))->getMock();
		$transportMock->expects($this->once())->method('send');

		$messageMock = $this->getMockBuilder('TrafficCophp\\Message\\PublishMessage')->disableOriginalConstructor()->getMock();

		$publisher = new Publisher($transportMock);
		$publisher->publish($messageMock);
	}

	public function testMultipleSend() {
		$transportMock = $this->getMockBuilder('TrafficCophp\\Network\\SocketTransport')->setConstructorArgs(array('127.0.0.1', 1337))->getMock();
		$transportMock->expects($this->atLeastOnce())->method('send');

		$publisher = new Publisher($transportMock);

		for ($i = 0; $i < 3; $i++) {
			$messageMock = $this->getMockBuilder('TrafficCophp\Message\PublishMessage')->disableOriginalConstructor()->getMock();
			$publisher->publish($messageMock);
		}
	}

}