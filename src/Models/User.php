<?php

namespace ASPTest\Models;

use ASPTest\Database\Connect as DB;
use PDO;

class User
{
  public static function find($data)
  {
    $db = DB::conn();

    $sql = "SELECT * FROM users WHERE $data[0] = ? ";
    $stm = $db->prepare($sql);
    $stm->bindValue(1, $data[1], PDO::PARAM_STR);
    $stm->execute();

    return $stm;
  }

  public static function findLast()
  {
    $db = DB::conn();
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1 ";
    $stm = $db->prepare($sql);
    $stm->execute();

    return $stm->fetchObject();
  }

  public static function create(object $req)
  {
    $db = DB::conn();
    $age = isset($req->idade) ? $req->idade : null;

    $sql = "INSERT
      INTO `users` (first_name, last_name, email, age)
      VALUES(?,?,?,?)";

    $stm = $db->prepare($sql);
    $stm->bindValue(1, $req->primeiro_nome, PDO::PARAM_STR);
    $stm->bindValue(2, $req->ultimo_nome, PDO::PARAM_STR);
    $stm->bindValue(3, $req->email, PDO::PARAM_STR);
    $stm->bindValue(4, $age, PDO::PARAM_STR);

    return $stm->execute();
  }

  public static function generatePwd(object $req)
  {
    $db = DB::conn();

    $sql = "UPDATE users SET password = ?  WHERE id = ?";
    $stm = $db->prepare($sql);
    $stm->bindValue(1, $req->password, PDO::PARAM_STR);
    $stm->bindValue(2, $req->id, PDO::PARAM_STR);

    return $stm->execute();
  }
}
