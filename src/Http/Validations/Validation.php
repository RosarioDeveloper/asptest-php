<?php

namespace ASPTest\Http\Validations;

class Validation
{
  public $data;
  function __construct()
  {
    $this->data = ['message' => [], 'fails' => false];
  }

  public function make(array $rules, array $req)
  {
    //Faz a verificação dos tipos de validações
    foreach ($rules as $index => $rule) {

      if (isset($req[$index])) {
        $value = $req[$index];

        if ($rule == "name") $this->validateName($index, $value);
        if ($rule == "email") $this->validateEmail($value);
        if ($rule == "age") $this->validateAge($value);
        if ($rule == "pwd") $this->validatePwd($value, $req);
      }
    }

    $records = (array) $this->data['message'];
    if (count($records) > 0) $this->data['fails'] = true;

    return (object) $this->data;
  }




  function validateName($attribute, $value)
  {
    if (strlen($value) < 2 || strlen($value) > 35) {
      $this->data['message'][] =
        utf8_encode("O {$attribute} deve ter 2 a 35 caracteres no maximo.");
    }
  }

  function validateEmail($value)
  {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->data['message'][] = "Email invalido.";
    }
  }

  function validateAge($value)
  {
    if (!filter_var($value, FILTER_SANITIZE_NUMBER_INT)) {
      $this->data['message'][] = "A idade deve conter apenas valores inteiros";
    }

    if (strlen($value) > 4) {
      $this->data['message'][] = "A idade deve conter apenas 4 digitos.";
    }

    if ((int) $value > 150) {
      $this->data['message'][] = "A idade não pode ser superior a 150.";
    }
  }

  function validatePwd($value, $req)
  {
    $uppercase = preg_match('@[A-Z]@', $req['password']);
    $lowercase = preg_match('@[a-z]@', $req['password']);
    $number    = preg_match('@[0-9]@', $req['password']);

    if ($req['password'] != $req['confirmar_password']) {
      $this->data['message'][] = " - Confirmação de password inválida.";
    }

    if (!$uppercase || !$lowercase || !$number || strlen($req['password']) < 6) {
      $this->data['message'][] = "A password deve possuir:";
      $this->data['message'][] = " - No mínimo 6 caracteres";
      $this->data['message'][] = " - 1 caracter especial";
      $this->data['message'][] = " - 1 letra maiúscula";
      $this->data['message'][] = " - 1 número";
    }
  }
}
