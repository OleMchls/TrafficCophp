<?php

namespace TrafficCophp\Publisher;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractPublisherMessage;

/**
 * Description of Publisher
 *
 * @author ole
 */
class Publisher extends AbstractPublisher {

	/**
	 * @var AbstractTransport
	 */
	protected $transport;

	public function __construct(AbstractTransport $transport) {
		$this->transport = $transport;
	}

	public function publish(AbstractPublisherMessage $message) {
		$this->transport->send($message);
	}

}