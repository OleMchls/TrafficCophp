<?php

namespace TrafficCophp\Network;

use TrafficCophp\Message\AbstractPublishMessage;

/**
 * Description of AbstractTransport
 *
 * @author ole
 */
abstract class AbstractTransport {

	abstract public function __construct($host, $port);
	abstract public function send(AbstractPublishMessage $message);
	abstract public function receive($bytes);

}