<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 28/02/19
 * Time: 19:58
 */

namespace App\Controller;

use App\Entity\Advert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class MyAdvertController extends AbstractController
{


    private $user;

    /**
     * MyAdvertController constructor.
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {

        $this->user = $tokenStorage->getToken()->getUser();
    }


    /**
     * @Route("/myAdvert")
     */
    public function renderPage()
    {
        return $this->render('MyAdvert/myAdvert.html.twig', [
            'listAdvert' => $this->getDoctrine()->getRepository(Advert::class)->findBy(['idUser' => $this->user->getId()])
        ]);
    }


}