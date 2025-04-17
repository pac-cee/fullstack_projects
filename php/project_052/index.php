<?php
// Requires: composer require symfony/console
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command {
    protected static $defaultName = 'greet';
    protected function execute(InputInterface $input, OutputInterface $output): int {
        $output->writeln('Hello from Symfony Console!');
        return Command::SUCCESS;
    }
}
$app = new Application();
$app->add(new GreetCommand());
$app->run();
