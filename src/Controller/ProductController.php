<?php


namespace App\Controller;


use App\Entity\Product;
use App\Entity\User;
use App\Form\ProductType;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/add-product",name="add_product")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addProduct(Request $request)
    {

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
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

    /**
     * @Route("/view-product/{id}",name="view_product")
     * @param $id
     * @return Response
     */
    public function viewProduct($id)
    {

        $product = $this->getDoctrine()->getRepository(Product::class)
            ->find($id);


        return $this->render('product/view_product.html.twig',
            [
                'product' => $product
            ]);

    }

    /**
     * @Route("/edit-product/{id}", name="edit_product")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editProduct($id, Request $request)
    {

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute("user_dashboard");

        }

        return $this->render("product/edit_product.html.twig", [
            'product' => $product
        ]);

    }

    /**
     * @Route("/delete-product/{id}", name="delete_product")
     * @param $id
     * @param Request $request
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function deleteProduct($id, Request $request)
    {

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);


        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute("user_dashboard");


    }

}