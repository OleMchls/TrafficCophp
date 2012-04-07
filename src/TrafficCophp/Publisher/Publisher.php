<?php

namespace TrafficCophp\Publisher;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractPublishMessage;

class Publisher extends AbstractPublisher {

	/**
	 * @var AbstractTransport
	 */
	protected $transport;

	public function __construct(AbstractTransport $transport) {
		$this->transport = $transport;
	}

	public function publish(AbstractPublishMessage $message) {
		$this->transport->send($message);
	}

}