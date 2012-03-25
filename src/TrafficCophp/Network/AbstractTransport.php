<?php

namespace TrafficCophp\Network;

use TrafficCophp\Message\AbstractMessage;

/**
 * Description of AbstractTransport
 *
 * @author ole
 */
abstract class AbstractTransport {

	abstract public function __construct($host, $port);
	abstract public function send(AbstractMessage $message);
	abstract public function receive($bytes);

}