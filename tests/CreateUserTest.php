<?php

use PHPUnit\Framework\TestCase;

use ASPTest\Commands\CreateUserCommand;
use ASPTest\config\env;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class CreateUserTest extends TestCase
{
  public function testCreateUser()
  {
    try {
      env::load();
      $application = new Application();
      $application->add(new CreateUserCommand());

      $command = $application->find('user:create');

      $commandTester = new CommandTester($command);
      $commandTester->execute([
        'first_name' => "Rosario",
        'last_name' => 'Jgrg',
        'email' => 'rosak@gmai2.com',
        'age' => 25
      ]);

      $output = $commandTester->getDisplay();
      $this->assertNotTrue(str_contains($output, "Error:"));
    } catch (\Throwable $th) {
      $this->fail($output);
    }
  }
}
