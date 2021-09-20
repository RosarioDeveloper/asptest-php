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

  public function __construct()
  {
    parent::__construct();
  }

  protected function configure(): void
  {
    $this
      ->addArgument('primeiro_nome', InputArgument::REQUIRED)
      ->addArgument('ultimo_nome', InputArgument::REQUIRED)
      ->addArgument('email', InputArgument::REQUIRED)
      ->addArgument('idade', InputArgument::OPTIONAL);
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $args = $input->getArguments();
    $register = (object) UserController::register($args);

    if ($register->status) {
      $output->writeln(json_encode(
        $register->user,
        JSON_PRETTY_PRINT
      ));
      die();
    }

    $output->writeln("ERRO:");
    foreach ($register->message as $i => $msg) {
      $output->writeln("  - {$msg}");
    }
    return Command::SUCCESS;
  }
}
