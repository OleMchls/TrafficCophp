<?php

namespace TrafficCophp\Subscriber;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractSubscribeMessage;

class Subscriber extends AbstractSubscriber {

	/**
	 * @var AbstractTransport
	 */
	protected $transport;

	public function __construct(AbstractTransport $transport) {
		$this->transport = $transport;
	}

	public function receive() {

	}

	public function subscribe(AbstractSubscribeMessage $message) {
		$this->transport->send($message);
	}

}