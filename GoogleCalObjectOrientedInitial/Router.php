<?php

class Router {

	function doUserAction() {
		(new Presenter())->putMenu();
		if (!isset($_GET['action']))
			return;
		(new Logic(new Presenter))->$_GET['action']();
	}

}