<?php

namespace TrafficCophp\Message;

use TrafficCophp\Message\AbstractMessage;

/**
 * Description of AbstractMessage
 *
 * @author ole
 */
abstract class AbstractPublisherMessage extends AbstractMessage {

	abstract public function __construct($channel, $message);
	abstract public function getProtokollString();
	abstract public function getLength();

}