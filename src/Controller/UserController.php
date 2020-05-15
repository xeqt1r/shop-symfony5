<?php


namespace App\Controller;


use App\Entity\Product;
use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder ){

        $user = new User();
        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()){

            $passwordHash = $encoder->encodePassword($user,$user->getPassword());

            $user->setPassword($passwordHash);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }


         return $this->render('User/register.html.twig');
    }

    /**
     *@Route("/dashboard", name="user_dashboard")
     *@Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function dashboard(){
        $productRepository = $this->getDoctrine()->getRepository(Product::class);

        /** @var User $user */
        $user = $this->getUser();

        $myProducts = $productRepository->findAll();

        return $this->render("User/dashboard.html.twig",[
            'user'=>$user,
            'myProducts' => $myProducts
        ]);

    }

}