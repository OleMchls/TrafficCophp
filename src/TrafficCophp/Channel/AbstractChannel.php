<?php

namespace TrafficCophp\Channel;

abstract class AbstractChannel {
	abstract public function __construct($name);
	abstract public function getName();
}