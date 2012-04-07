<?php

namespace TrafficCophp\Message;

abstract class AbstractReceiveMessage extends AbstractMessage {
	abstract public function parse($raw);
}