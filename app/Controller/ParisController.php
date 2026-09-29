<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ParisController implements ControllerInterface
{
	
	public function execute(Request $request): string|null

	{
		var_dump($request->getVars());
		$ville = $request-> get("id");
		return TwigCore::getEnvironment()->render('paris/paris.html.twig',
		    [
		        "titre"   => 'ParisController',
		        "request" => $request,
				"ville"=> $request -> get("id")
		    ]
		);
	}
}
