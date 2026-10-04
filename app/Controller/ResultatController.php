<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ResultatController implements ControllerInterface
{
	
	public function execute(Request $request): string|null
	{
		
		return TwigCore::getEnvironment()->render('resultat/resultat.html.twig',
		    [
		        "titre"   => 'ResultatController',
		        "request" => $request,
				"prenom_info" => $request->get('prenom'),
				"nom_info"=> $request->get('nom'),
				"ville_info"=> $request->get('nom_ville'),
		    ]
		);
	}
}
