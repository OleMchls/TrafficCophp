<?php

namespace TrafficCophp\Publisher;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractPublishMessage;

abstract class AbstractPublisher {
	abstract public function __construct(AbstractTransport $transport);
	abstract public function publish(AbstractPublishMessage $message);
}