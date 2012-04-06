<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\Channel;
use TrafficCophp\Channel\ChannelCollection;

use TrafficCophp\ByteBuffer\Buffer;

class ServerMessage extends AbstractServerMessage {

	protected $raw;
	protected $parsed = false;

	/**
	 * @var \TrafficCophp\Channel\ChannelCollection
	 */
	protected $channels;
	protected $message;

	public function __construct($rawBinaryMessage) {
		$this->raw = $rawBinaryMessage;
		$this->channels = new ChannelCollection();
	}

	/**
	 * @return @return \TrafficCophp\Channel\ChannelCollection
	 */
	public function getAddressedChannels() {
		$this->parseIfNeccessary();
		return $this->channels;
	}

	public function getLength() {
		return strlen($this->raw);
	}

	public function getMessage() {
		$this->parseIfNeccessary();
		return $this->message;
	}

	public function getProtokollString() {
		return $this->raw;
	}

	protected function parseIfNeccessary() {
		if (!$this->isParsed()) {
			$this->parse();
		}
	}

	protected function isParsed() {
		return $this->parsed;
	}

	protected function parse() {
		$buffer = new Buffer($this->raw);
		$channelLength = $buffer->readInt32BE(0);
		$channelList = $buffer->read(4, $channelLength);
		foreach (explode(',', $channelList) as $channelName) {
			$this->channels->addChannel(new Channel($channelName));
		}
		$this->message = $buffer->read(4 + $channelLength, $buffer->length() - (4 + $channelLength));
		$this->parsed = true;
	}

}