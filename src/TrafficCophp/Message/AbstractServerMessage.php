<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;

abstract class AbstractServerMessage extends AbstractReceiveMessage {
	abstract public function __construct(ChannelCollection $channels);
	abstract public function getAddressedChannels();
	abstract public function getMessage();
}