<?php

namespace Repository;

use Entity\Medecin;
use Studoo\EduFramework\Core\Service\DatabaseService;

class MedecinRepository
{
    public function getMedecin(): array
    {
        $medecin = [];

        $DataService = DatabaseService::getConnect();
        $stmt = $DataService->query('SELECT * FROM medecin');

        while ($row = $stmt->fetch()) {
            $medecin[] = new Medecin($row['id'], $row['nom'], $row['prenom'], $row['titre']);
        }

        return $medecin;
    }

    public function createMedecin(Medecin $medecin): int
    {
        $combase = DatabaseService::getConnect();
        $statementPDO = $combase->prepare(
            "INSERT INTO medecin (id, nom, prenom, titre) VALUES (:id, :nom, :prenom, :titre)"
        );
        $statementPDO->execute([
            'id' => $medecin->getId(),
            'nom' => $medecin->getNom(),
            'prenom'=> $medecin->getPrenom(),
            'titre'=> $medecin->getTitre(),
        ]);

        return (int) $combase->lastInsertId();
    }
}