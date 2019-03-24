<?php

namespace App\Controller;

use App\Entity\Tchat;
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
     * @Route("/tchat/{tchat}");
     * 
     * @param $tchat
     * @return Response
     */
    /*
    public function create(Request $request, ObjectManager $objectManager, TokenStorageInterface $token)
    {

        return $this->render('tchat/tchat.html.twig', ['tchats' => $this->getDoctrine()->getRepository(Tchat::class)->findAll()]);
    }
    */
    
}
    