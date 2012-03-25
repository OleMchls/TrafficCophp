<?php

namespace TrafficCophp\Network;

use TrafficCophp\Message\AbstractPublisherMessage;

/**
 * Description of AbstractTransport
 *
 * @author ole
 */
abstract class AbstractTransport {

	abstract public function __construct($host, $port);
	abstract public function send(AbstractPublisherMessage $message);
	abstract public function receive($bytes);

}