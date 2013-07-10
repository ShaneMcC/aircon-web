<?php

class lirc {
	private $remote;

	public function __construct($remote) {
		$this->remote = $remote;
	}

	protected function sendKey($key, $times = 'SEND_ONCE') {
		$cmd = '/usr/bin/irsend ' . escapeshellarg($times) . ' ' . escapeshellarg($this->remote) . ' ' . escapeshellarg($key);
		exec($cmd);
	}
}

?>