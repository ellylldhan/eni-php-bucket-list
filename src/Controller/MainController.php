<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function home() {
        $module = 3;
        $tp = 1;
        $branch      = "Mod3-Twig";
        $description = "Setup de Twig";

        return $this->render('main/home.html.twig', [
            "version"     => $module . '.' . $tp,
            "branch"      => $branch,
            "description" => "Module " . $module . " TP ". $tp . " - " . $description]);
    }
}