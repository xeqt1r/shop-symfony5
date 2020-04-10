<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="homepage")
     */
    public function home(){
        $user = "Hristo";

        return $this->render("base.html.twig",[
            "name"=>$user
        ]);
    }

}