<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Service\DatabaseService;
use PDO;

class VilleController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/ville')]
	#[Attributes\Post(path: '/api/ville')]
	#[Attributes\Response(response: '200', description: 'La liste des villes')]
	#[Attributes\Response(response: '201', description: 'La ville creee')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

		if ($request->getHttpMethod()==="POST") {
			$comBase = DatabaseService::getConnect("");
			$statementPDO = $comBase->prepare("
			 	INSERT INTO ville (nom, code_postal, nombre_habitant) VALUES (:nom, :code_postal, :nb_habitant) 
			");
			$statementPDO->execute([
				'nom' => $request->get('nom'),
				'code_postal' => $request->get('code_postal'),
				'nb_habitant' => (int) $request->get('nombre_habitant')
			]);

			http_response_code(201);
			return json_encode([
				"id" => (int) $comBase->lastInsertId(),
				"nom" => $request->get('nom'),
				"code_postal" => $request->get('code_postal'),
				"nombre_habitant" => (int) $request->get('nombre_habitant')
			]);
		}

		$comBase = DatabaseService::getConnect();
		$statementPDO = $comBase->query("SELECT * FROM ville");
		$villes = $statementPDO->fetchAll(PDO::FETCH_ASSOC);

		return json_encode($villes);
	}
}
