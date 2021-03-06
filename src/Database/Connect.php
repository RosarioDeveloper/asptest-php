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

    try {
      $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$db}",
        $_ENV["DB_USERNAME"],
        $_ENV["DB_PASSWORD"],
        array(PDO::ATTR_PERSISTENT => true)
      );
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      printf("Error:\n");
      printf("{$e->getMessage()}\n");
      printf("Please, check the database connection and try again.");
    }
  }
}
