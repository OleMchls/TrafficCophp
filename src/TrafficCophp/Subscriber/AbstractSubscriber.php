<?php

namespace TrafficCophp\Subscriber;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Message\AbstractSubscribeMessage;
use TrafficCophp\Message\AbstractServerMessage;

abstract class AbstractSubscriber {
	abstract public function __construct(AbstractTransport $transport);
	abstract public function subscribe(AbstractSubscribeMessage $channels);
	abstract public function receive(AbstractServerMessage $message);
}