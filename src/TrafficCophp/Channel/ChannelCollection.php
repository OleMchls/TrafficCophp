<?php

namespace TrafficCophp\Channel;

class ChannelCollection extends \SplObjectStorage {

	public function attach(Channel $object, $data = null) {
		parent::attach($object, $data);
	}

	public function detach(Channel $object) {
		parent::detach($object);
	}

	public function contains(Channel $object) {
		parent::contains($object);
	}

}