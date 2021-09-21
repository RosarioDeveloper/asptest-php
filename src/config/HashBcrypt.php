<?php

namespace ASPTest\config;

use Bcrypt\Bcrypt;

class HashBcrypt
{
  static function bcrypt($plaintext)
  {
    $bcrypt = new Bcrypt();

    //Set the Bcrypt Version, default is '2y'
    $bcrypt_version = '2a';
    return $bcrypt->encrypt($plaintext, $bcrypt_version);
  }
}
