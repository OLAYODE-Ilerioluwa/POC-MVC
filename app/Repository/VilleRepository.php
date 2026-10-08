<?php

namespace Repository;

use Entity\Ville;
use Studoo\EduFramework\Core\Service\DatabaseService;

class VilleRepository
{
    public function getVilles(): array
    {
        $villes = [];

        $DataService = DatabaseService::getConnect();
        $stmt = $DataService->query('SELECT * FROM ville');

        while ($row = $stmt->fetch()) {
            $villes[] = new Ville($row['id'], $row['nom'], $row['code_postal'], $row['nombre_habitant']);
        }

        return $villes;
    }

    public function createVille(Ville $ville): int
    {
        $comBase = DatabaseService::getConnect();
        $statementPDO = $comBase->prepare(
            "INSERT INTO ville (nom, code_postal, nombre_habitant) VALUES (:nom, :code_postal, :nombre_habitant)"
        );
        $statementPDO->execute([
            'nom' => $ville->getNom(),
            'code_postal' => $ville->getCodePostal(),
            'nombre_habitant' => $ville->getNombreHabitant()
        ]);

        return (int) $comBase->lastInsertId();
    }


}