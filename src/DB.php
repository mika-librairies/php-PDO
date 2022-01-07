<?php

namespace Mika\PhpPdo;

use PDO;
use PDOException;

class DB
{
    private static ?PDO $pdo;

    // Database related.
    private string $dbPassword;
    private string $dbHost;
    private string $dbName;
    private string $dbUser;

    /**
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $db, string $user, string $password)
    {
        $this->dbHost = $host;
        $this->dbName = $db;
        $this->dbUser = $user;
        $this->dbPassword = $password;
    }

    /**
     * Connect and return the database.
     * @return PDO
     */
    public function getPDO(): ?PDO
    {
        if (null === self::$pdo) {
            try {
                self::$pdo = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8", $this->dbUser, $this->dbPassword);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                return null;
            }
        }
        return self::$pdo;
    }
}