<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace Liz\Core;

class Configurator
{	
    /**
     * This function create the Config object based in the $filename param
     * @param  string $filename located at ./src/App/Configs/
     * @return array contain the src/App/Configs/$filename.php
     */
    public static function getConfig($filename='Application')
    {
        $filename = ucfirst($filename);
        $path = dirname(__FILE__) . "/../../../src/App/Configs/{$filename}.php";

        $config = array();
        if(file_exists($path)){
            $config = require($path);
        }
        
        return $config;        
    }
}