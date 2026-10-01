<?php

namespace Command;

use Studoo\EduFramework\Commands\Extends\CommandBanner;
use Studoo\EduFramework\Core\ConfigCore;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'generate', description: 'Renseigner la description de la commande generate')]
class GenerateCommand extends \Studoo\EduFramework\Commands\Extends\CommandManage
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		self::$stdOutput->writeln([
		        CommandBanner::getBanner(),
		        'Bienvenue dans la console ' . ConfigCore::getConfig('name'),
		        '',
		    ]);
		    // Ajouter votre code ici
		    return Command::SUCCESS;
	}
}
