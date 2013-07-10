<?php
	require_once(dirname(__FILE__) . '/aircon.php');
	$aircon = new aircon();

	// String Switch Hack.
	$actions = array('fail' => 0,
	                 'power' => 1,
	                 'mode' => 2,
	                 'timer' => 3,
	                 'speed' => 4,
	                 'tempUp' => 5,
	                 'tempDown' => 7);

	$act = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'fail';
	$action = isset($actions[$act]) ? $actions[$act] : $actions['fail'];

	switch ($action) {
		case $actions['power']:
			$aircon->power();
			break;
		case $actions['mode']:
			$aircon->mode();
			break;
		case $actions['timer']:
			$aircon->timer();
			break;
		case $actions['speed']:
			$aircon->speed();
			break;
		case $actions['tempUp']:
			$aircon->tempUp();
			break;
		case $actions['tempDown']:
			$aircon->tempDown();
			break;
		default:
			echo json_encode(array('error' => 'Unknown Action'));
			die();
	}

	echo json_encode(array('success' => 'Action "' . $act . '" has been sent.'));
?>