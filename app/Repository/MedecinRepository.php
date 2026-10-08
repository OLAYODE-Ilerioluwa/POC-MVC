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
}