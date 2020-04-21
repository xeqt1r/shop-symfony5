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
        $user = $this->getUser();


        return $this->render("base.html.twig",[
                'user'=>$user
        ]);
    }

}