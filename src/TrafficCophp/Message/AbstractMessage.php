<?php

namespace TrafficCophp\Message;

/**
 * Description of AbstractMessage
 *
 * @author ole
 */
abstract class AbstractMessage {

	abstract public function getProtokollString();
	abstract public function getLength();

}