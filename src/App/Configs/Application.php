<?php

return array(
    'config' => array(
        'env' => "my-development",        //defines the section for environment parameters group
        'app.layout.default' => 'layout', //defines the name of active layout
        'app.layouts.active' => 'true'    //defines if layout is enabled in the whole project
    ),
    'my-development' => array(
        'db' => 'mysql',
        'db.host' => 'localhost',
        'db.username' => 'username',
        'db.password' => 'password',
        'db.dbname' => 'dbname',
        'db.port' => '3306'
    ),
    'pg-development' => array(
        'db' => 'pgsql',
        'db.host' => 'host2',
        'db.username' => 'username2',
        'db.password' => 'password2',
        'db.dbname' => 'dbname2',
        'db.port' => '5432'
    )
);