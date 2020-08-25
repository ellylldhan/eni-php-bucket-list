<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//use App\Utils\Utils;

class IdeaController extends AbstractController {

    private $ver;

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
     * @Route("/list", name="idea_list")
     */
    public function list() {
        //@todo: affiche les choses à faire (SELECT_ALL)

        return $this->render('idea/list.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }

    /**
     * @Route("/idea", name="idea_detail")
     */
    public function detail() {
        //@todo: affiche les détails d'une chose à faire (SELECT_BY_ID)
//        $this->ver = Utils::getVer();

        return $this->render('idea/detail.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }

}
