<?php

namespace TrafficCophp\Subscriber;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractSubscribeMessage;
use TrafficCophp\Message\AbstractServerMessage;

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
	public function receive(AbstractServerMessage $message) {
		if (!$this->isRegistered()) {
			throw new NoSubscriptionException('Youre not subscribed on a channel!');
		}
		$buffer = new Buffer($this->transport->receive(4));
		$message->parse($this->transport->receive($buffer->readInt32BE(0)));
		return $message;
	}

	public function subscribe(AbstractSubscribeMessage $message) {
		$this->transport->send($message);
		$this->registered = true;
	}

	public function isRegistered() {
		return $this->registered;
	}

}