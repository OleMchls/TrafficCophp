<?php

namespace TrafficCophp\Network;

use TrafficCophp\Network\AbstractTransport;
use TrafficCophp\Network\Exception as NetworkException;
use TrafficCophp\Message\AbstractPublishMessage;

/**
 * Description of SocketTransport
 *
 * @author ole
 */
class SocketTransport extends AbstractTransport {

	protected $host;
	protected $port;
	protected $resource;

	public function __construct($host, $port) {
		$this->host = $host;
		$this->port = $port;
	}

	public function receive($bytes) {

	}

	public function send(AbstractPublishMessage $message) {
		if (!$this->isConnected()) {
			$this->connect();
		}
		socket_write($this->resource, $message->getProtokollString(), $message->getLength());
	}

	protected function isConnected() {
		return is_resource($this->resource);
	}

	protected function connect() {
		$this->resource = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$connteced = socket_connect($this->resource, $this->host, $this->port);
		if (!$connteced) {
			throw new NetworkException('Cant establish connection to Traffic Cop server');
		}
	}

	public function __destruct() {
		if ($this->isConnected()) {
			socket_close($this->resource);
		}
	}

}