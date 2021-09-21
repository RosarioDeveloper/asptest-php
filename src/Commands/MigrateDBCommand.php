<?php

namespace ASPTest\Commands;

use ASPTest\Database\Connect as DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateDBCommand extends Command
{
  protected static $defaultName = 'db:migrate';
  public function __construct()
  {
    parent::__construct();
  }

  protected function configure(): void
  {
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    try {
      $db = DB::conn();

      $sql = file_get_contents(APP_URL . '/src/Database/db.sql');
      $query = $db->prepare($sql);
      $query->execute();

      $output->write("Migration successfuly");
    } catch (\Throwable $th) {
      $output->writeln("Error:");
      $output->writeln("Please, check the database connection.");
    }
    return Command::SUCCESS;
  }
}
