<?php

namespace Controller;

use Repository\MedecinRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Studoo\EduFramework\Core\Service\DatabaseService;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MedecinController implements ControllerInterface
{
	public function execute(Request $request): string|null
	{
		$comBase = DatabaseService::getConnect();
		$statementPDO = $comBase->query("SELECT * FROM medecin");
		$medecin = $statementPDO->fetchAll();

		var_dump($medecin);
		return TwigCore::getEnvironment()->render('medecin/medecin.html.twig',
		    [
		        "titre"   => 'MedecinController',
		        "request" => $request,
				"medecin" => (new MedecinRepository()) -> getMedecin()
		    ]
		);
	}
}
