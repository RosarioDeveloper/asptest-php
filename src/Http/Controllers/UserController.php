<?php

namespace ASPTest\Http\Controllers;

use ASPTest\Models\User;
use ASPTest\Http\Validations\Validation;

class UserController
{
  function __construct()
  {
  }

  static public function register(array $req)
  {
    try {
      $rules = [
        'primeiro_nome' => 'name',
        'ultimo_nome' => 'name',
        'email' => 'email',
        'idade' => 'age'
      ];

      $validation = new Validation();
      $validate = $validation->make($rules, $req);

      if ($validate->fails) return [
        'status' => false,
        'message' => $validate->message
      ];

      //$user = User::create((object) $req);
      $user = [];

      return [
        'status' => true,
        'user' => $user
      ];
    } catch (\PDOException $e) {
      return [
        'status' => false,
        'message' => [
          //$e->getMessage(),
          'Não foi possível processar o seu pedifo.'
        ]
      ];
    }
  }
}
