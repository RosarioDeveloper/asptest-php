<?php

namespace ASPTest\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DBConnect as DB;

class MigrateDBCommand extends Command
{
  protected static $defaultName = 'db:migrate';
  public function __construct()
  {
    parent::__construct();
  }

  protected function configure(): void
  {
    /*$this
      ->setDescription('Creates a new user.')
      ->setHelp('This command allows you to create a user...');*/
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    try {
      $db = DB::conn();

      $sql = file_get_contents(APP_URL . '/src/database/db.sql');
      $query = $db->prepare($sql);
      $query->execute();

      $output->write("Migração efectuada com sucesso");
    } catch (\Throwable $th) {
      $output->write("ERROR: \n Erro ao gerar tabelas. Tente novamente");
    }
    return Command::SUCCESS;
  }
}
