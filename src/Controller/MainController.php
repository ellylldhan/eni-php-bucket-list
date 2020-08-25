<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

include_once '../utils/version.php';

class MainController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function home() {
        $ver = getVer();

        return $this->render('main/home.html.twig', [
            "version"     => $ver['version'],
            "branch"      => $ver['branch'],
            "description" => $ver['description'],
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact() {
        $ver = getVer();

        return $this->render('main/contact.html.twig', [
            "version"     => $ver['version'],
            "branch"      => $ver['branch'],
            "description" => $ver['description'],
        ]);
    }
}