<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);// ^ E_WARNING
	require_once "lib/lib.php";

	require_once "model/Model.php";
	require_once "model/User.php";
	require_once "model/Stat.php";
	
	
	require_once "game/Guess.php";
	require_once "game/Fifteen.php";
	require_once "game/Frog.php";
	require_once "game/CatchTime.php";


	require_once "controller/Controller.php";

	require_once "controller/MainController.php";
	require_once "controller/UserController.php";
	require_once "controller/GameController.php";

	session_save_path("sess");
	session_start(); 

	// Make database avaliable for all server files
	$GLOBALS['dbconn'] = db_connect();

	$controller = '';
	$action = '';
	// query url to get action need
	$q = @$_GET['q'];
	// case for nothing
	// control flow by directing controller > action
	if (empty($q)) $q = '/';
	$args = explode('/', $q);
	$controller = @$args[1];
	if ($controller == '') $controller = 'main';
	if (count($args) <= 2) $action = 'index';
	else $action = $args[2];

	// move to second level controller
	switch(strtolower($controller)) {
		case 'main':
			$c = new MainController();
			break;
		case 'user':
			$c = new UserController();
			break;
		case 'game':
			$c = new GameController();
			break;
		default: 
			$c = new Controller();
			$c->err404();
			break;
	}
	// third level controller
	if (is_subclass_of($c, 'Controller')) $c->callAction($action);
?>
