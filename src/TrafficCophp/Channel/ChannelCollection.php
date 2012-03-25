<?php

namespace TrafficCophp\Channel;

class ChannelCollection extends AbstractChannelCollection {

	/**
	 * @var \SplObjectStorage
	 */
	protected $collection;
	protected $channelNames;

	public function __construct() {
		$this->collection = new \SplObjectStorage();
		$this->channelNames = array();
	}

	public function addChannel(Channel $channel) {
		if (isset($this->channelNames[$channel->getName()])) {
			return;
		}
		$this->channelNames[$channel->getName()] = true;
		$this->collection->attach($channel);
	}

	public function getChannels() {
		return $this->collection;
	}

}