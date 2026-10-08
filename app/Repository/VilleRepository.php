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

    public function getVille(int $id): Ville|false
    {
        $comBase = DatabaseService::getConnect();
        $statementPDO = $comBase->prepare("SELECT * FROM ville WHERE id = :id");
        $statementPDO->execute(['id' => $id]);

        $row = $statementPDO->fetch();

        if ($row === false) {
            return false;
        }

        return new Ville($row['id'], $row['nom'], $row['code_postal'], $row['nombre_habitant']);
    }

    public function updateVille(Ville $ville): bool
    {
        $comBase = DatabaseService::getConnect();
        $statementPDO = $comBase->prepare(
            "UPDATE ville SET nom = :nom, code_postal = :code_postal, nombre_habitant = :nombre_habitant WHERE id = :id"
        );
        return $statementPDO->execute([
            'nom' => $ville->getNom(),
            'code_postal' => $ville->getCodePostal(),
            'nombre_habitant' => $ville->getNombreHabitant(),
            'id' => $ville->getId()
        ]);
    }



}