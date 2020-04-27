<?php


namespace App\Controller;


use App\Entity\Product;
use App\Entity\User;
use App\Form\ProductType;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/add-product",name="add_product")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function addProduct(Request $request){

        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            /** @var User $user */
            $user = $this->getUser();
            $product->setOwner($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute("user_dashboard");
        }




        return $this->render("product/add_product.html.twig");


    }

}