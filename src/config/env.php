<?php

namespace ASPTest\config;

use Symfony\Component\Dotenv\Dotenv;

class env
{
  static function load()
  {
    $path = dirname(__DIR__, 2);
    $dotenv = new Dotenv();
    $dotenv->load($path . '/.env');
  }
}
