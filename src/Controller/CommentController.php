<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("comment-add/{productId}", name="comment_add")
     * @param $productId
     * @param Request $request
     * @return RedirectResponse
     */
    public function addComment($productId, Request $request)
    {

        $comment = new Comment();
        /** @var Product $product */
        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $comment->setProduct($product)->setOwner($user);

        if ($form->isSubmitted()){
            if($comment->getContent() == ""){
                $this->addFlash("success","Field Comment is empty");
                return $this->redirectToRoute("view_product",[
                    'id' => $productId
                ]);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute("view_product",[
                'id' => $productId
            ]);
        }

    }

}