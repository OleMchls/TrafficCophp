<?php

namespace TrafficCophp\Subscriber;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractSubscribeMessage;
use TrafficCophp\Message\ServerMessage;

use TrafficCophp\ByteBuffer\Buffer;

class Subscriber extends AbstractSubscriber {

	protected $registered = false;

	/**
	 * @var AbstractTransport
	 */
	protected $transport;

	public function __construct(AbstractTransport $transport) {
		$this->transport = $transport;
	}

	/**
	 * @throws NoSubscriptionException
	 *
	 * @return \TrafficCophp\Message\ServerMessage
	 */
	public function receive() {
		if (!$this->isRegistered()) {
			throw new NoSubscriptionException('Youre not subscribed on a channel!');
		}
		$messagelength = $this->transport->receive(4);
		return new ServerMessage($this->transport->receive($messagelength - 4));
	}

	public function subscribe(AbstractSubscribeMessage $message) {
		$this->transport->send($message);
		$this->registered = true;
	}

	public function isRegistered() {
		return $this->registered;
	}

}