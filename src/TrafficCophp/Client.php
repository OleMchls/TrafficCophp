<?php

namespace TrafficCophp;

use TrafficCophp\Network\SocketTransport;
use TrafficCophp\Publisher\Publisher;
use TrafficCophp\Subscriber\Subscriber;
use TrafficCophp\Message\PublishMessage;
use TrafficCophp\Message\SubscribeMessage;
use TrafficCophp\Message\ServerMessage;
use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;

class Client {

	/**
	 * @var \TrafficCophp\Publisher\Publisher
	 */
	protected $publisher;

	/**
	 * @var \TrafficCophp\Subscriber\Subscriber
	 */
	protected $subscriber;

	public function __construct($host, $port) {
		$transport = new SocketTransport($host, $port);
		$this->publisher = new Publisher($transport);
		$this->subscriber = new Subscriber($transport);
	}

	public function publish($channel, $message) {
		$this->publisher->publish(new PublishMessage(new Channel($channel), $message));
	}

	public function subscribe(/* generic */) {
		$channels = new ChannelCollection();
		foreach (func_get_args() as $channel) {
			$channels->addChannel(new Channel($channel));
		}
		$message = new SubscribeMessage($channels);
		$this->subscriber->subscribe($message);
	}

	public function receive($func = null) {
		$this->subscriber->receive($message = new ServerMessage(new ChannelCollection()));
		if (is_callable($func)) {
			$channels = $message->getAddressedChannels();
			$channels->rewind();
			$func($channels->current()->getName(), $message->getMessage());
		}
		return $message->getMessage();
	}

}