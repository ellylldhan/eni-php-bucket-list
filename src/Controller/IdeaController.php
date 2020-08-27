<?php

namespace App\Controller;

use App\Entity\Idea;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//use App\Utils\Utils;

class IdeaController extends AbstractController {

    private $ver;

    public function __construct() {
        $module = 5;
        $tp     = 1;
        $branch = "mod5-tp1-doctrine";
        $descr  = "Données et Doctrine";

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
        // Affiche les choses à faire (SELECT_ALL)
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas    = $ideaRepo->findBy([], ["dateCreated" => "DESC"], 30, 0);

        return $this->render('idea/list.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
            "ideas"       => $ideas,
        ]);
    }

    /**
     * @Route("/idea/{id}", name="idea_detail", requirements={"id": "\d+"})
     * @param $id
     * @return Response
     */
    public function detail($id) {
        // Affiche les détails d'une chose à faire (SELECT_BY_ID)
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $idea     = $ideaRepo->find($id);

        return $this->render('idea/detail.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
            "idea"        => $idea,
        ]);
    }

}
