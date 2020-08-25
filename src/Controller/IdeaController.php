<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

include_once '../utils/version.php';

class IdeaController extends AbstractController {
    /**
     * @Route("/list", name="idea_list")
     */
    public function list() {
        //@todo: affiche les choses à faire (SELECT_ALL)
        $ver = getVer();

        return $this->render('idea/list.html.twig', [
            "version"     => $ver['version'],
            "branch"      => $ver['branch'],
            "description" => $ver['description'],
        ]);
    }

    /**
     * @Route("/idea/{id}", name="idea_detail", requirements={"id": "\d+"})
     */
    public function detail($id) {
        //@todo: affiche les détails d'une chose à faire (SELECT_BY_ID)
        $ver = getVer();

        return $this->render('idea/detail.html.twig', [
            "version"     => $ver['version'],
            "branch"      => $ver['branch'],
            "description" => $ver['description'],
        ]);
    }

}
