<?php

namespace ASPTest\Http\Controllers;

use ASPTest\Models\User;
use ASPTest\Http\Validations\Validation;

class UserController
{
  public static $rules;
  function __construct()
  {
  }

  static public function register(array $req)
  {
    try {
      //Define as regras de validação
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

      //Verifica se o utilizador já existe
      $user = User::find(['email', $req['email']]);
      if ($user->rowCount()) {
        return [
          'status' => false,
          'message' => ["O email '{$req['email']}' já está a ser utiizado"]
        ];
      }

      $register = User::create((object) $req);
      if ($register) {
        $user = User::findLast();
        unset($user->password);

        return [
          'status' => true,
          'user' => $user
        ];
      }
    } catch (\PDOException $e) {
      return [
        'status' => false,
        'message' => ['Não foi possível processar o seu pedido.']
      ];
    }
  }

  static function setPassword(array $req)
  {
    try {
      //Verifica o utilizador
      $user = User::find(['id', $req['id']]);
      if (!$user->rowCount()) {
        return [
          'status' => false,
          'message' => ["Utilizador não encontrado."]
        ];
      }

      //Define as regras de validação
      $rules = ['password' => 'pwd'];
      $validation = new Validation();
      $validate = $validation->make($rules, $req);

      if ($validate->fails) return [
        'status' => false, 'message' => $validate->message
      ];

      $req['password'] = bcrypt($req['password']);
      $pwd = User::generatePwd((object) $req);
      if ($pwd) {
        return [
          'status' => true,
          'message' => "A Password foi criada com sucesso"
        ];
      }
    } catch (\Throwable $th) {
      return [
        'status' => false,
        'message' => ['Não foi possível processar o seu pedido.']
      ];
    }
  }
}
