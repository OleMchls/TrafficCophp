<?php

namespace TrafficCophp\Network;

use TrafficCophp\Message\AbstractMessage;

abstract class AbstractTransport {
	abstract public function __construct($host, $port);
	abstract public function send(AbstractMessage $message);
	abstract public function receive($bytes);
}