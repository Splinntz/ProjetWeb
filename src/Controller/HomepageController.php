<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 21/02/2019
 * Time: 22:35
 */

namespace App\Controller;


use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HomepageController extends AbstractController
{
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }
    /**
     * @Route("/", name="homepage")
     */
    public function read()
    {
        //return new Response('OMG! My first Symfony page! :D');

        return $this->render('homePage.html.twig', ['adverts' => $this->getDoctrine()->getRepository(Advert::class)->findAll()]);
    }
}