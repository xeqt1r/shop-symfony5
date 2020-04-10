<?php


namespace App\Controller;


use App\Entity\User;
use Cassandra\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login(){

    }

    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request){


        $user = new User();
        $form = $this->createFormBuilder($user);

        if(){

        }

        return $this->render('User/register.html.twig');
    }

    /**
     * @Route("/logout", name="user_logiut")
     */
    public function logout(){

    }

}