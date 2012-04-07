<?php

namespace TrafficCophp\Channel;

use TrafficCophp\Channel\Channel;

abstract class AbstractChannelCollection {
	abstract public function addChannel(Channel $channel);
	abstract public function getChannels();
}