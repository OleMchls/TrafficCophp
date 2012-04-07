<?php

namespace TrafficCophp\Tests\Unit\Subscriber;

use TrafficCophp\Subscriber\Subscriber;
use TrafficCophp\ByteBuffer\Buffer;

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

	/**
	 * @expectedException \TrafficCophp\Subscriber\NoSubscriptionException
	 */
	public function testReceiveWithoutRegister() {
		$subscriber = new Subscriber($this->getTransportMock());

		$srvMessageMock = $this->getMockBuilder('TrafficCophp\\Message\\ServerMessage')->disableOriginalConstructor()->getMock();
		$srvMessageMock->expects($this->never())->method('parse');

		$subscriber->receive($srvMessageMock);
	}

	public function testReceive() {
		$transportMock = $this->getTransportMock();
		$transportMock->expects($this->exactly(1))->method('send');

		$channel = 'channel_one';
		$message = 'message';

		$buffer = new Buffer(4 + 11 + 7);
		$buffer->writeInt32BE(strlen($channel), 0);
		$buffer->write($channel, 4);
		$buffer->write($message, 4+strlen($channel));

		// Create a map of arguments to return values.
		$map = array(
			array(4, 26),
			array(22, (string) $buffer)
		);
		$transportMock->expects($this->exactly(2))->method('receive')->will($this->returnValueMap($map));

		$subscriber = new Subscriber($transportMock);

		$messageMock = $this->getMockBuilder('TrafficCophp\\Message\\SubscribeMessage')->disableOriginalConstructor()->getMock();
		$subscriber->subscribe($messageMock);

		$srvMessageMock = $this->getMockBuilder('TrafficCophp\\Message\\ServerMessage')->disableOriginalConstructor()->getMock();
		$srvMessageMock->expects($this->exactly(1))->method('parse');

		$subscriber->receive($srvMessageMock);
	}

}