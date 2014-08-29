<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace Liz\Core;

use Liz\Core\Controller;

class Bootstrapper
{    
    private $request;
    private $segments;

    protected $controllerName;    
    protected $actionName;    
    protected $params;

    /**
     * The constructor initializes the following methods
     */
    public function __construct()
    {        
        $this->initRequest();
        $this->initSegments();
        $this->initAttributes();
        $this->initParams();
    }

    /**
     * Evaluates the request's URL     
     */
    private function initRequest() 
    {        
        $self = (dirname($_SERVER['PHP_SELF'])=='/') ? '' : dirname($_SERVER['PHP_SELF']);        
        $this->request = str_replace($self, '', $_SERVER['REQUEST_URI']);        
    }

    /**
     * Checks and stores all the segments of the URL 
     */
    private function initSegments() 
    {
        $segments = explode('/', $this->request);
        $countSegments = 0;
        for ($i=0; $i < count($segments); $i++) {
            if (!empty($segments[$i]) ) {
                $this->segments[$countSegments] = $segments[$i];
                $countSegments++;
            }
        }
        if ( (empty($this->segments[0])) ) {
            $this->segments[0] = 'index';
        }
        if ( (empty($this->segments[1]))) {
            $this->segments[1] = 'index';
        }        
    }

    /**
     * Initializes the controller and action parameters
     * e.g. http://example.com/ControllerExample/ActionExample
     * the param $controllerName is ControllerExample
     * the para $actionName is ActionExample
     */
    private function initAttributes() 
    {
        $this->controllerName = $this->segments[0];
        $this->actionName = $this->segments[1];
    }

    /**
     * Initialize remaining parameters
     * e.g. http://example.com/c/a/Param1/Param2/Param3
     * the param $params[] = ['Param1', 'Param2', Param3]
     */
    private function initParams() 
    {
        $this->_params = array();
        $tam = count($this->segments);
        for ($idx = 2; $idx < $tam; $idx++) {
            $this->params[] = urldecode($this->segments[$idx]);
        }        
    }

    /**     
     * @return string Controllers name
     */
    public function getControllerName()
    {
        return ucfirst($this->controllerName);
    }

    /**     
     * @return string Actions name
     */
    public function getActionName()
    {
        return strtolower($this->actionName);
    }    

    /**     
     * @return string The array of params
     */
    public function getParams()
    {
        return $this->params;
    }
}