<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace Liz\Core;

use Liz\Core\Configurator as Config;

class View
{
    private $config;
    private $viewPath;
    private $layoutPath;
    private $layoutName;
    private $disableLayout = false;    
    private $data; //array of fields passed to view
    const PATH_LAYOUT = '/../../../src/App/Layouts';
    const PATH_VIEW = '/../../../src/App/Views';

    /**
     * Gets the config located at ./src/App/Configs/Application.ini
     */
    public function __construct()
    {
        $this->config = Config::getConfig();
    }

    /**
     * Show the base url
     * e.g. http://localhost/example returns /example
     * @return string
     */
    public function baseUrl()
    {
        return (dirname($_SERVER['PHP_SELF'])=='/') ? '' : dirname($_SERVER['PHP_SELF']);
    }

    /**
     * Set the controller and action name to find the corresponding view
     * @param string $controller Controller Name
     * @param string $action Action Name
     */
    public function setView($controller, $action)
    {
        $controllerAction = strtolower($controller) . '/'. ucfirst($action);             
        $this->viewPath = __DIR__ . self::PATH_VIEW . '/' . $controllerAction . '.phtml';        
    }

    /**
     * Set the layout to render before the view
     * @param string $layout to render
     */
    public function setLayout($layout='')
    { 
        $this->layoutName = $layout; 
    }

    /**
     * Disable the layout render     
     */
    public function disableLayout()
    { 
        $this->disableLayout = true; 
    }

    /**
     * Set the indicated layout or loads the default (configured at Application.ini)     
     */
    private function loadLayout()
    {
        //Verify if layout was disabled
        if($this->disableLayout==false) { 
            //checks if it is set a layout different of default 
            if((!isset($this->layoutName)) || (empty($this->layoutName))) {
                $config_active = $this->config->getItem('config')['app.layouts.active'];
                //if layout is active (configured at Application.ini)
                if($config_active=='true') { 
                    $defaultLayout = ucfirst($this->config->getItem('config')['app.layout.default']);
                    $this->layoutPath = __DIR__ . self::PATH_LAYOUT . '/' . $defaultLayout . '.phtml';
                }
            } else {                
                $this->layoutPath = __DIR__ . self::PATH_LAYOUT . '/' . ucfirst($this->layoutName) . '.phtml';
            }
        } else { 
            $this->layoutPath = '';
        }
    }

    /**
     * Render the layout (if set)
     * or render only the view content
     */
    public function render()
    { 
        $this->loadLayout();        
        if(!empty($this->layoutPath)) {
            if(is_readable($this->layoutPath)) {
                include_once $this->layoutPath;                
            } else {
                throw new Exception("Error to process layout");                
            }
        } else { 
            $this->showViewContent(); 
        }
    }
    
    /**
     * Render the view without layout     
     */
    private function showViewContent()
    {
        if(is_readable($this->viewPath)) {
            include_once $this->viewPath;
        }
    }

    /**
     * Set a variable which have to pass for view
     * @param string varible name
     * @param string variable value
     */
    public function __set($field, $value)
    { 
        $this->data[$field] = $value; 
    }
    
    /**
     * Get a variable defined in the controller
     * @param  string $field variable name
     * @return mixed varible value
     */
    public function __get($field)
    {        
        if (array_key_exists($field, $this->data)) {
            return $this->data[$field];
        }        
        return null;
    } 
}