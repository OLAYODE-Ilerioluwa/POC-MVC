<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Service\DatabaseService;
use PDO;

class VilleDetailController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/ville/{id}')]
	#[Attributes\Parameter(name: 'id', in: 'path', required: true, schema: new Attributes\Schema(type: 'integer'))]
	#[Attributes\Response(response: '200', description: 'La ville demandee')]
	#[Attributes\Response(response: '404', description: 'Ville introuvable')]
	public function execute(Request $request): string|null
	{
		$id = $request->get("id");

		if ($id === null) {
			http_response_code(404);
			return json_encode(["erreur" => "Ville introuvable"]);
		}

		$comBase = DatabaseService::getConnect();
		$statementPDO = $comBase->prepare("SELECT * FROM ville WHERE id = :id");
		$statementPDO->execute(["id" => (int) $id]);
		$ville = $statementPDO->fetch(PDO::FETCH_ASSOC);

		if ($ville === false) {
			http_response_code(404);
			return json_encode(["erreur" => "Ville introuvable"]);
		}

		return json_encode($ville);
	}
}
