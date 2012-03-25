<?php

namespace TrafficCophp\Subscriber;

use TrafficCophp\Channel\Channel;

/**
 * Description of AbstractSubscriber
 *
 * @author ole
 */
abstract class AbstractSubscriber {

	abstract public function __construct($host, $port);
	abstract public function registerOnChannel(Channel $channel);
	abstract public function receive();

}