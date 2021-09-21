<?php

use PHPUnit\Framework\TestCase;

use ASPTest\Commands\CreateUserPwdCommand;
use ASPTest\config\env;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class CreateUserPwdTest extends TestCase
{

  public function testCreateUserPwd()
  {
    try {
      env::load();
      $application = new Application();
      $application->add(new CreateUserPwdCommand());

      $command = $application->find('user:create-pwd');

      $commandTester = new CommandTester($command);
      $commandTester->execute(array(
        'id' => 12, //Put the id that is in users table
        'password' => 'AnaJose425#',
        'confirm_password' => 'AnaJose425#',
      ));

      $output = $commandTester->getDisplay();
      $this->assertNotTrue(str_contains($output, "Error:"));
    } catch (\Throwable $th) {
      $this->fail($output);
    }
  }
}
