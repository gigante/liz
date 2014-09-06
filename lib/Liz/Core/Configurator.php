<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace Liz\Core;

use Respect\Config\Container;

class Configurator
{	
    /**
     * This function create the Config object based in the $filename param
     * @param  string $filename located at ./src/App/Configs/
     * @return Respect\Config\Container
     */
    public static function getConfig($filename='Application')
    {
        $filename = ucfirst($filename);
        $path = "/../../../src/App/Configs/{$filename}.ini";
        return new Container(__DIR__ . $path);
    }
}