<?php

namespace ASPTest\Database;

use PDO;
use PDOException;

class Connect
{
  static public function conn()
  {
    $host = $_ENV["DB_HOST"];
    $port = $_ENV["DB_PORT"];
    $db   = $_ENV["DB_DATABASE"];
    $user = $_ENV["DB_USERNAME"];
    $pwd  = $_ENV["DB_PASSWORD"];

    try {
      $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db",
        $user,
        $pwd
        //array(PDO::ATTR_PERSISTENT => true)
      );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      die("Error: \n {$_ENV["DB_PASSWORD"]}");
    }
  }
}
