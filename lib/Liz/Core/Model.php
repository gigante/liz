<?php

/**
 * LIZ
 * @author Hiarison Gigante <gigantedesousa@gmail.com>
 * @link http://github.com/gigante/liz
 * @license http://opensource.org/licenses/MIT
 */

namespace Liz\Core;

use PDO;
use Liz\Core\Configurator as Config;

class Model
{
    protected $dsn;
    private $config;

    /**
     * Loads the default configuration: development or production
     */
    public function __construct()
    {        
        $this->config = Config::getConfig();
        $this->dsn = $this->config['config']['env'];        
    }    

    /**
     * Instantiates the defined database parameters on env configuration 
     * or based on passed parameter
     * @param  string $dsn name of database parameters group
     * @return PDO returns a PDO instance
     */
    public function newConnection($dsn = null)
    {
        if($dsn == null) {
            $db     = $this->config[$this->dsn]['db'];
            $user   = $this->config[$this->dsn]['db.username'];
            $pass   = $this->config[$this->dsn]['db.password'];
            $host   = $this->config[$this->dsn]['db.host'];
            $dbname = $this->config[$this->dsn]['db.dbname'];
            $port   = $this->config[$this->dsn]['db.port'];    
        } else {
            $db     = $this->config[$dsn]['db'];
            $user   = $this->config[$dsn]['db.username'];
            $pass   = $this->config[$dsn]['db.password'];
            $host   = $this->config[$dsn]['db.host'];
            $dbname = $this->config[$dsn]['db.dbname'];
            $port   = $this->config[$dsn]['db.port'];
        }        

        if($db == 'mysql') {
            return new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $pass);    
        } else if($db == 'pgsql') {
            return new PDO("pgsql:host={$host};port={$port};dbname={$dbname};user={$user};password={$pass}");
        }
    }
}