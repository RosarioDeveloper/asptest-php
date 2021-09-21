<?php

namespace ASPTest\Commands;

use ASPTest\Http\Controllers\UserController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
  protected static $defaultName = 'user:create';
  private $isTest;

  public function __construct()
  {
    //$this->isTest = $isTest;
    parent::__construct();
  }

  protected function configure(): void
  {
    $this
      ->addArgument('first_name', InputArgument::REQUIRED)
      ->addArgument('last_name', InputArgument::REQUIRED)
      ->addArgument('email', InputArgument::REQUIRED)
      ->addArgument('age', InputArgument::OPTIONAL);
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $args = $input->getArguments();
    $UserControl = new UserController();
    $register = (object) $UserControl->register($args);

    if ($register->status) {
      $output->writeln("Success:");
      $output->write(json_encode($register->user, JSON_PRETTY_PRINT));
    }

    if (!$register->status) {
      $output->writeln("Error:");
      foreach ($register->message as $i => $msg) {
        $output->writeln("  - {$msg}");
      }
    }

    return Command::SUCCESS;
  }
}
