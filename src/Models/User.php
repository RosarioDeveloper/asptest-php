<?php

namespace ASPTest\Models;

use DBConnect as DB;

class User
{

  public static function find(int $id)
  {
    $db = DB::conn();
    $sql = "SELECT * FROM users WHERE id = ? ";
    $stm = $db->prepare($sql);
    $stm->bindValue(0, $id, PDO::PARAM_STR);

    return $stm->execute();
  }

  public static function create(object $req)
  {
    $db = DB::conn();
    $age = isset($req->age) ? $req->age : null;

    $sql = "INSERT
      INTO `users` (first_name, last_name, email, age)
      VALUES(?,?,?,?)";

    $stm = $db->prepare($sql);
    $stm->bindValue(0, $req->primeiro_nome, PDO::PARAM_STR);
    $stm->bindValue(1, $req->ultimo_nome, PDO::PARAM_STR);
    $stm->bindValue(2, $req->email, PDO::PARAM_STR);
    $stm->bindValue(3, $age, PDO::PARAM_STR);

    return $stm->execute();
  }

  public static function createPwd()
  {
    $db = DB::conn();
  }
}
