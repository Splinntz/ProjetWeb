<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Tchat;
use App\Entity\Advert;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TchatController extends AbstractController
{

    private $tchat;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/tchat/{id}");
     * 
     * @param $tchat
     * @return Response
     */
    public function create(Request $request,ObjectManager $objectManager, TokenStorageInterface $token, $id)
    {

        $advert = $this->getDoctrine()->getRepository(Advert::class)->findOneBy(['id'=> $id]);
        dump($advert->getIdUser(), $token->getToken()->getUser());
        $myTchat = $this->getDoctrine()->getRepository(Tchat::class)->findOneBy(['advert'=>$advert, 'user1'=>$advert->getIdUser(), 'userAux'=>$token->getToken()->getUser()]);

        if ($myTchat == null){
            $tchat = new Tchat();
            $tchat->setAdvert($advert);
            $tchat->setUser1($advert->getIdUser());
            $tchat->setUserAux($token->getToken()->getUser());
            $objectManager->persist($tchat);
            $objectManager->flush();
            $myTchat = $tchat;

        }

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;

            $message->setDate(new \DateTime('now'));
            $message->setUser($token->getToken()->getUser());
            $message->setTchat($myTchat);

            $objectManager->persist($message);
            $objectManager->flush();

        }


        return $this->render('tchat/tchatMessage.html.twig',[
            'listMessage' => $myTchat->getMessages(),
            'user1' => $myTchat->getUser1(),
            'user2' =>$myTchat->getUserAux(),
            'form' => $form->createView()
            ]);
    
    }


    /**
     * @Route("/tchatAux/{id}")
     */
    public function createAux($id, TokenStorageInterface $token,Request $request , ObjectManager $objectManager){


        $myTchat = $this->getDoctrine()->getRepository(Tchat::class)->findOneBy(['id'=> $id]);
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;

            $message->setDate(new \DateTime('now'));
            $message->setUser($token->getToken()->getUser());
            $message->setTchat($myTchat);

            $objectManager->persist($message);
            $objectManager->flush();

        }



        return $this->render('tchat/tchatMessage.html.twig',[
            'listMessage' => $myTchat->getMessages(),
            'user1' => $myTchat->getUser1(),
            'user2' =>$myTchat->getUserAux(),
            'form' => $form->createView()
        ]);
    }
    
    
}
    