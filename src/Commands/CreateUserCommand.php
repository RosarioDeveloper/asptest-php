<?php

namespace ASPTest\Commands;

use ASPTest\Http\Controllers\UserController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
  protected static $defaultName = 'user:create-user';

  public function __construct()
  {
    parent::__construct();
  }

  protected function configure(): void
  {
    $this
      ->addArgument('primeiro_nome', InputArgument::REQUIRED, 'Primeiro Nome')
      ->addArgument('ultimo_nome', InputArgument::REQUIRED, 'Último Nome')
      ->addArgument('email', InputArgument::REQUIRED, 'Email')
      ->addArgument('idade', InputArgument::OPTIONAL, 'Idade');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $fields = $input->getArguments();
    $register = (object) UserController::register($fields);

    if ($register->status) {
      $output->writeln(json_encode($register->user, JSON_PRETTY_PRINT));
      die();
    }


    $output->writeln("ERROS:");
    foreach ($register->message as $i => $msg) {
      $output->writeln("- {$msg}");
    }
    return Command::SUCCESS;
  }
}
