<?php

namespace TrafficCophp\Message;

use TrafficCophp\Channel\ChannelCollection;
use TrafficCophp\Channel\Channel;

abstract class AbstractSubscribeMessage extends AbstractSendMessage {
	abstract public function __construct(ChannelCollection $channels);
}