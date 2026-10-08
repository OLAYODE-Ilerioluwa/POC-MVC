<?php



namespace Controller;

use Entity\Ville;
use Repository\VilleRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Controller\Route;
use Studoo\EduFramework\Core\View\TwigCore;
use Studoo\EduFramework\Core\Service\DatabaseService;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class VilleController implements ControllerInterface
{
	public function execute(Request $request): string|null
	{
		if ($request->getHttpMethod() === "POST") {
			$ville = new Ville(
				0,
				$request->get('nom'),
				$request->get('code_postal'),
				(int) $request->get('nombre_habitant')
			);

			(new VilleRepository())->createVille($ville);

			header('Location: ' . (new Route())->getNameToPath('ville'));
			return null;
		}
			
		
		// Recupere l'object PHP PDO
		$comBase = DatabaseService::getConnect();
		// Requete SQL
		$statementPDO = $comBase->query("SELECT * FROM ville");
		// Recuperation des résultats de la requete
		$villes = $statementPDO->fetchAll();
		return TwigCore::getEnvironment()->render('ville/ville.html.twig',
		    [
		        "titre"   => 'VilleController',
				"request" => $request,
				"prenom_info" => $request->get('prenom'),
				"nom_info" => $request->get("nom"),
				"villes" => (new VilleRepository())->getVilles()
		    ]
		);
	}
}
