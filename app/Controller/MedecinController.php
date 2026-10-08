<?php

namespace Controller;

use Entity\Medecin;
use Repository\MedecinRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Controller\Route;
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

		if ($request->getHttpMethod() === "POST") {
			$medecin = new Medecin(
			   0,
			   $request->get('nom'),
			   $request->get('prenom'),
			   $request->get('titre')
		);
	
		(new MedecinRepository())->createMedecin($medecin);

		header('Location: ' . (new Route())->getNameToPath('medecin'));
		return null;
	}

		return TwigCore::getEnvironment()->render('medecin/medecin.html.twig',
		    [
		        "titre"   => 'MedecinController',
		        "request" => $request,
				"medecin" => (new MedecinRepository()) -> getMedecin()
		    ]
		);
	}
}
