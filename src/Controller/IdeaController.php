<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController {

    private $ver;

    public function __construct() {
        $module = 6;
        $tp     = 1;
        $branch = "mod6-tp-formulaire";
        $descr  = "Formulaire";

        $this->ver = [
            "version"     => $module . '.' . $tp,
            "branch"      => $branch,
            "description" => "Module " . $module . " TP - " . $descr
        ];
    }

    /**
     * @Route("/list", name="idea_list")
     */
    public function list() {
        // Affiche les choses à faire (SELECT_ALL)
        $ideaRepo = $this->getDoctrine()->getRepository(Idea::class);
        $ideas    = $ideaRepo->findBy(["isPublished" => true], ["dateCreated" => "DESC"], 30, 0);

        return $this->render('idea/list.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
            "ideas"       => $ideas,
        ]);
    }

    /**
     * @Route("/idea/{id}", name="idea_detail",
     *     requirements={"id": "\d+"})
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

    /**
     * @Route("/idea/add", name="idea_add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function add(EntityManagerInterface $em, Request $request) {
        $idea = new Idea();
        $idea->setDateCreated(new \DateTime());
        $idea->setIsPublished(false);

        // Instanciation du formulaire lié à l'entité
        $ideaForm = $this->createForm(IdeaType::class, $idea);

        // Récupérer la request entiere
        $ideaForm->handleRequest($request);
        if ($ideaForm->isSubmitted() && $ideaForm->isValid()) {
            // Passer isPublished à true
            $idea->setIsPublished(true);

            // Ajout de l'entité dans la bdd via EntityManager
            $em->persist($idea);
            $em->flush();

            // Affichage Message Flash pour confirmer succès
            $this->addFlash("success", "Idée enregistrée.");
//            dump($idea->getId());

            // Redirige vers page détail
            return $this->redirectToRoute("idea_detail", [
                "id" => $idea->getId()
            ]);
        }

        return $this->render("idea/add.html.twig", [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
            "ideaForm"    => $ideaForm->createView(),
        ]);
    }

}
