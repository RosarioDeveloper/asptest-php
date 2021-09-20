<?php

use Bcrypt\Bcrypt;

function bcrypt($plaintext)
{
  $bcrypt = new Bcrypt();

  //Set the Bcrypt Version, default is '2y'
  $bcrypt_version = '2a';
  return $bcrypt->encrypt($plaintext, $bcrypt_version);
}
