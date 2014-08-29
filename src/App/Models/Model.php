<?php

namespace App\Models;

use Liz\Core\Model;

class ModelTest extends Model
{
	/**
	 * Instantiates a new PDO connection
	 */
	public function __construct()
	{
		$pdoConnection = newConnection();
	}	
}