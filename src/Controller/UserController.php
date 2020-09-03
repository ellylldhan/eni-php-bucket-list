<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController {
    private $ver;

    public function __construct() {
        $module = 8;
        $tp     = 1;
        $branch = "mod8-tp-utilisateur";
        $descr  = "Utilisateur : Login, Logout, Register,\nRoles & Restrictions";

        $this->ver = [
            "version"     => $module . '.' . $tp,
            "branch"      => $branch,
            "description" => "Module " . $module . " TP - " . $descr
        ];
    }

    /**
     * @Route("/login", name="login")
     */
    public function login() {
        return $this->render('user/login.html.twig', [
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        $this->addFlash("success", "User logged out");
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $registerForm = $this->createForm(RegisterType::class, $user);

        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            // Hacher mot de passe
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashed);

            // Sauver en bdd
            $em->persist($user);
            $em->flush();

            // Message Flash
            $this->addFlash("success", "Utilisateur a été créé");

            return $this->redirectToRoute("home");
        }

        return $this->render("user/register.html.twig", [
            'registerForm' => $registerForm->createView(),
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }

    /**
     * @Route("/user/list", name="user_list")
     * @return Response
     */
    public function list() {
        $userRepo = $this->getDoctrine()->getRepository(User::class);

        $listUsers = $userRepo->findBy([], ["username" => "ASC"], 30, 0);

        return $this->render('user/list.html.twig', [
            'listUsers'   => $listUsers,
            "version"     => $this->ver['version'],
            "branch"      => $this->ver['branch'],
            "description" => $this->ver['description'],
        ]);
    }
}
