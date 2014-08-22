<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace App;

use Liz\Core\Bootstrapper;
use Liz\Core\View;

class Bootstrap{
	/**
	 * This function instantiates the controller, performs related action 
	 * and calls the view's render method
	 */
    public function run(){
		// Front Controller configuration
		$bootstrapper = new Bootstrapper();	
		$controllerName = $bootstrapper->getControllerName();		
		$actionName = $bootstrapper->getActionName();		
		$params = $bootstrapper->getParams();
		
		//View configuration
		$view = new View();
		$view->setView($controllerName, $actionName);		
		
		//Controller configuration
		$controllerClassName = 'App\\Controllers\\' . $controllerName;			
		$controller = new $controllerClassName;
		$controller->view = $view;
		$controller->params = $params;

		//Sequence of controller method calls
        $controller->$actionName();
        $controller->view->render();
    }
}
