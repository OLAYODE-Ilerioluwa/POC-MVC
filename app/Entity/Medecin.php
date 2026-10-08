<?php

namespace Entity;

class Medecin
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $titre;

    public function __construct($id, $nom, $prenom, $titre)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->titre = $titre;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function updateTitre($new_titre)
    {
        $this->titre = $new_titre;
        return $this->titre;
    }
}