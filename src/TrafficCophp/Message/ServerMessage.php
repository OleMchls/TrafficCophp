<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\Channel;
use TrafficCophp\Channel\ChannelCollection;

use TrafficCophp\ByteBuffer\Buffer;

class ServerMessage extends AbstractServerMessage {

	protected $parsed = false;

	/**
	 * @var \TrafficCophp\Channel\ChannelCollection
	 */
	protected $channels;
	protected $message;

	public function __construct(ChannelCollection $channels) {
		$this->channels = $channels;
	}

	/**
	 * @return \SplObjectStorage
	 */
	public function getAddressedChannels() {
		$this->checkParsed();
		return $this->channels->getChannels();
	}

	public function getMessage() {
		$this->checkParsed();
		return $this->message;
	}

	protected function checkParsed() {
		if (!$this->isParsed()) {
			throw new \RuntimeException('You have to call parse() before accessing the attributes');
		}
	}

	protected function isParsed() {
		return $this->parsed;
	}

	public function parse($raw) {
		$buffer = new Buffer($raw);
		$channelLength = $buffer->readInt32BE(0);
		$channelList = $buffer->read(4, $channelLength);
		foreach (explode(',', $channelList) as $channelName) {
			$this->channels->addChannel(new Channel($channelName));
		}
		$this->message = $buffer->read(4 + $channelLength, $buffer->length() - (4 + $channelLength));
		$this->parsed = true;
	}

}