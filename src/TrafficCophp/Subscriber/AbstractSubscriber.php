<?php

namespace TrafficCophp\Subscriber;

/**
 * Description of AbstractSubscriber
 *
 * @author ole
 */
abstract class AbstractSubscriber {

	abstract public function __construct($host, $port);
	abstract public function registerOnChannel($channel);
	abstract public function receive();

}