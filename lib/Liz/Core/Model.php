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

class Model{
	protected $dsn;
	private $config;

	/**
	 * Loads the default configuration: development or production
	 */
	public function __construct(){		
		$this->config = Config::getConfig();
		$this->dsn = $this->config->getItem('config')['env'];		
	}	

	/**
	 * Instantiates the defined database parameters on env configuration 
	 * or based on passed parameter
	 * @param  string $dsn name of database parameters group
	 * @return PDO returns a PDO instance
	 */
	public function newConnection($dsn = null){
		if($dsn == null){
			$user   = $this->config->getItem($this->dsn)['db.username'];
			$pass   = $this->config->getItem($this->dsn)['db.password'];
			$host   = $this->config->getItem($this->dsn)['db.host'];
			$dbname = $this->config->getItem($this->dsn)['db.dbname'];
			$port   = $this->config->getItem($this->dsn)['db.port'];	
		} else {
			$user   = $this->config->getItem($dsn)['db.username'];
			$pass   = $this->config->getItem($dsn)['db.password'];
			$host   = $this->config->getItem($dsn)['db.host'];
			$dbname = $this->config->getItem($dsn)['db.dbname'];
			$port   = $this->config->getItem($dsn)['db.port'];
		}		
		return new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $pass);
	}
}