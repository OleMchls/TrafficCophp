<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;
use TrafficCophp\ByteBuffer\Buffer;

class SubscribeMessage extends AbstractSubscribeMessage {

	const TYPE = 0x2;

	/**
	 * @var ChannelCollection
	 */
	protected $channels;

	/**
	 * @var ByteBuffer
	 */
	protected $buffer;

	public function __construct(ChannelCollection $channels) {
		$this->channels = $channels;
		$this->buffer = new Buffer(4 + 1 + 4 + strlen($this->getChannelListString()));
	}

	public function getLength() {
		return $this->buffer->length();
	}

	public function getProtokollString() {
		$this->buffer->writeInt32BE($this->buffer->length() - 4, 0);
		$this->buffer->writeInt8(self::TYPE, 4);
		$this->buffer->writeInt32BE(strlen($this->getChannelListString()), 5);
		$this->buffer->write($this->getChannelListString(), 9);
		return (string) $this->buffer;
	}

	protected function getChannelListString() {
		$channels = array();
		foreach ($this->channels->getChannels() as $channel) {
			/* @var $channel Channel */
			$channels[] = $channel->getName();
		}
		return implode(',', $channels);
	}

}