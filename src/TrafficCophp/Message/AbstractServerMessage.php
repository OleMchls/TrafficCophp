<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;

abstract class AbstractServerMessage extends AbstractMessage {
	abstract public function __construct($rawBinaryMessage);
	abstract public function getAddressedChannels();
	abstract public function getMessage();
}