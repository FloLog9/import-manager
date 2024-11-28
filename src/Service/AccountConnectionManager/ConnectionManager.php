<?php

namespace App\Service\AccountConnectionManager;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class ConnectionManager
{

    public function __construct(
        private string $dbHost,
        private string $dbUser,
        private string $dbPassword
    ) {
    }

    public function getConnection(string $dbName): Connection
    {
        
        $connectionParams = [
            'dbname' => $dbName,
            'user' => $this->dbUser,
            'password' => $this->dbPassword,
            'host' => $this->dbHost,
            'driver' => 'pdo_mysql',
        ];

        return DriverManager::getConnection($connectionParams);
    }
}