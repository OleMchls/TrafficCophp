<?php

namespace TrafficCophp\Tests\Unit\Network;

use TrafficCophp\Network\SocketTransport;

/**
 * Description of SocketTransportTest
 *
 * @author ole
 */
class SocketTransportTest extends \PHPUnit_Framework_TestCase {

	public function testSend() {
		$this->markTestSkipped('Cant test socket_write()');
	}

	public function testReceive() {
		$this->markTestSkipped('Cant test socket_read()');
	}

}