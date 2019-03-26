<?php

namespace App\Controller;


use App\Entity\TchatMessage;
use App\Form\TchatMessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NewMessageController extends AbstractController
{
    /*private $user;


    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }
    */

    /**
     * @Route("/answer", name="answer")
     */
    public function create(Request $request, ObjectManager $objectManager, TokenStorageInterface $token)
    {
        $tchatMessage = new TchatMessage();

        $form = $this->createForm(TchatMessageType::class, $tchatMessage);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tchatMessage->setNameUserName($token->getToken()->getUser()->getLogin());
            $date = new \DateTime();
            $date->setTimestamp(123456);
            $tchatMessage->setDate($date);
            $tchatMessage->setIdTchatId(1);
            $objectManager->persist($tchatMessage);
            $objectManager->flush();

            return $this->redirectToRoute('tchat');
        }

        return $this->render('/tchat/answer.html.twig', [
            'form' => $form->createView()/*, 'user'=>$this->getUser()*/]);
    }
}