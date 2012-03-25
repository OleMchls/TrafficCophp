<?php

namespace TrafficCophp\Message;

use TrafficCophp\Message\AbstractPublisherMessage;
use TrafficCophp\ByteBuffer\ByteBuffer;

/**
 * Description of PublisherMessage
 *
 * @author ole
 */
class PublisherMessage extends AbstractPublisherMessage {

	const TYPE = 0x1;

	protected $channel;
	protected $message;

	/**
	 * @var ByteBuffer
	 */
	protected $buffer;

	public function __construct($channel, $message) {
		$this->channel = $channel;
		$this->message = $message;
		$this->buffer = new ByteBuffer(4 + 1 + 4 + strlen($channel) + strlen($message));
	}

	public function getChannel() {
		return $this->channel;
	}

	public function getMessage() {
		return $this->message;
	}

	public function getProtokollString() {
		$this->buffer->writeInt32BE($this->buffer->length() - 4, 0);
		$this->buffer->writeInt8(self::TYPE, 4);
		$this->buffer->writeInt32BE(strlen($this->channel), 5);
		$this->buffer->write($this->channel, 9);
		$this->buffer->write($this->message, 9 + strlen($this->channel));
		return (string) $this->buffer;
	}

	public function getLength() {
		return $this->buffer->length();
	}

}