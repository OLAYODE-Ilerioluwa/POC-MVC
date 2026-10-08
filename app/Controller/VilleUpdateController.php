<?php

namespace Controller;

use Entity\Ville;
use Repository\VilleRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\Controller\Route;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class VilleUpdateController implements ControllerInterface
{
    public function execute(Request $request): string|null
    {
       $villeRepository = new VilleRepository();
       $id = (int) $request->get("id");

       if ($request->getHttpMethod() === "POST") {
           $ville = new Ville(
               $id,
               $request->get('nom'),
               $request->get('code_postal'),
               (int) $request->get('nombre_habitant')
           );

           $villeRepository->updateVille($ville);

           header('Location: ' . (new Route())->getNameToPath('ville'));
           return null;
       }

       $ville = $villeRepository->getVille($id);

       if ($ville === false) {
           header('Location: ' . (new Route())->getNameToPath('ville'));
           return null;
       }

        return TwigCore::getEnvironment()->render('villeupdate/villeupdate.html.twig',
            [
            	"titre"   => 'VilleUpdateController',
               	"request" => $request,
               	"ville"   => $ville
            ]
        );
    }
}