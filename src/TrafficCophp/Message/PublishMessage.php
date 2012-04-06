<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\Channel;
use TrafficCophp\ByteBuffer\Buffer;

/**
 * Description of PublisherMessage
 *
 * @author ole
 */
class PublishMessage extends AbstractPublishMessage {

	const TYPE = 0x1;

	/**
	 * @var Channel
	 */
	protected $channel;
	protected $message;

	/**
	 * @var Buffer
	 */
	protected $buffer;

	public function __construct(Channel $channel, $message) {
		$this->channel = $channel;
		$this->message = $message;
		$this->buffer = new Buffer(4 + 1 + 4 + strlen($channel->getName()) + strlen($message));
	}

	/**
	 * @return Channel
	 */
	public function getChannel() {
		return $this->channel;
	}

	public function getMessage() {
		return $this->message;
	}

	public function getProtokollString() {
		$this->buffer->writeInt32BE($this->buffer->length() - 4, 0);
		$this->buffer->writeInt8(self::TYPE, 4);
		$this->buffer->writeInt32BE(strlen($this->channel->getName()), 5);
		$this->buffer->write($this->channel->getName(), 9);
		$this->buffer->write($this->message, 9 + strlen($this->channel->getName()));
		return (string) $this->buffer;
	}

	public function getLength() {
		return $this->buffer->length();
	}

}