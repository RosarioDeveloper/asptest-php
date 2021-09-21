<?php

namespace ASPTest\Http\Controllers;

use ASPTest\config\HashBcrypt;
use ASPTest\Models\User;
use ASPTest\Http\Validations\Validation;


class UserController
{
  public static $rules;
  function __construct()
  {
  }

  public function register(array $req)
  {
    try {
      //Define the rules of validations
      $rules = [
        'first_name' => 'name',
        'last_name' => 'name',
        'email' => 'email',
        'age' => 'age'
      ];

      $validation = new Validation();
      $validate = $validation->make($rules, $req);

      if ($validate->fails) return [
        'status' => false,
        'message' => $validate->message
      ];

      //Check if user already exist
      $user = User::find(['email', $req['email']]);
      if ($user->rowCount()) {
        return [
          'status' => false,
          'message' => ["The email '{$req['email']}' already in use."]
        ];
      }

      //Create new user
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
        'message' => [$e->getMessage(), "Your order coudn't be processed"]
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
          'message' => ["User not found."]
        ];
      }

      //Define as regras de validação
      $rules = ['password' => 'pwd'];
      $validation = new Validation();
      $validate = $validation->make($rules, $req);

      if ($validate->fails) return [
        'status' => false, 'message' => $validate->message
      ];

      //Create new password
      $req['password'] = HashBcrypt::bcrypt($req['password']);
      $pwd = User::generatePwd((object) $req);

      if ($pwd) {
        return [
          'status' => true,
          'message' => "The password was successfuly created"
        ];
      }
    } catch (\Throwable $th) {
      return [
        'status' => false,
        'message' => ["The password couldn't be created."]
      ];
    }
  }
}
