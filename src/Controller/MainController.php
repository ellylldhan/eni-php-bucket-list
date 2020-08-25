<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//use App\Utils\Utils;

class MainController extends AbstractController {

    private $ver;

    /**
     * IdeaController constructor.
     */
    public function __construct() {
//        $this->ver = Utils::getVer();
        $module = 4;
        $tp     = 1;
        $branch = "mod4-tp1-route-controleur";
        $descr  = "Route & Contrôleur";

        $this->ver = [
            "version"     => $module . '.' . $tp,
            "branch"      => $branch,
            "description" => "Module " . $module . " TP " . $tp . " - " . $descr
        ];
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {

        return $this->render('main/home.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact() {

        return $this->render('main/contact.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }
}