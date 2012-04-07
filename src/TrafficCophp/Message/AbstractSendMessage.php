<?php

namespace TrafficCophp\Message;

abstract class AbstractSendMessage extends AbstractMessage {

	abstract public function getProtokollString();
	abstract public function getLength();

}