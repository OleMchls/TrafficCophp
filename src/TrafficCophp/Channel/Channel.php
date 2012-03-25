<?php

namespace TrafficCophp\Channel;

class Channel extends AbstractChannel {

	protected $name;

	public function __construct($name) {
		$this->validateName($name);
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	protected function validateName($name) {
		if (strpos($name, ',') !== false) {
			throw new InvalidChannelNameException(sprintf('%s is not a valid channel name', $name));
		}
	}

}