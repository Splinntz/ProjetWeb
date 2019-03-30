<?php

namespace App\Controller;

use App\Entity\Tchat;
use App\Entity\Advert;
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
     * @Route("/tchat");
     * 
     * @param $tchat
     * @return Response
     */
    
    public function create(Request $request, ObjectManager $objectManager, TokenStorageInterface $token)
    {
        $tchat = new Tchat();
        $tchat->setIdUserId1(2);
        $tchat->setIdUserId2($token->getToken()->getUser()->getId());
        $objectManager->persist($tchat);
        $objectManager->flush();

        return $this->render('tchat/tchat.html.twig',[
            'adverts' => $this->getDoctrine()->getRepository(Advert::class)->findByUserId($tchat->getIdUserId1()),
            ]);
    
    }
    
    
}
    