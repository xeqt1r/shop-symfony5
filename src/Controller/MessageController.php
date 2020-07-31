<?php


namespace App\Controller;


use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/sendMessage/{recipientId}", name="send_message")
     * @param $recipientId
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendMessage($recipientId, Request $request){
        $message = new Message();

        /** @var User $user */
        $user = $this->getUser();

        $recipient = $this->getDoctrine()->getRepository(User::class)->find($recipientId);

        $form = $this->createForm(MessageType::class,$message);
        $form->handleRequest($request);

        $message->setMessageRecipient($recipient)->setMessageSender($user);



        if ($form->isSubmitted()){

            $this->addFlash("success","Message sent successful");

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute("user_profile",[
                'userId'=> $recipientId
            ]);

        }

    }

}