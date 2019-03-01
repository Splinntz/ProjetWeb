<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 01/03/2019
 * Time: 15:32
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserSpaceController extends AbstractController
{
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/userSpace", name="userSpace")
     */
    public function read()
    {
        //return new Response('OMG! My first Symfony page! :D');

        return $this->render('userSpace/userSpace.html.twig');
    }
}