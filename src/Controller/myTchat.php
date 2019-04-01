<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 31/03/19
 * Time: 23:54
 */

namespace App\Controller;


use App\Entity\Tchat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class myTchat extends AbstractController
{

    /**
     * @Route("/myTchats")
     */
    public function create(TokenStorageInterface $token){


        $listTchatsAux = $token->getToken()->getUser()->getTchats();

        return $this->render('myTchats/myTchat.html.twig', [
            'listTchats' => $listTchatsAux,
            'listTchatsAux' => $token->getToken()->getUser()->getTchatsAux()
        ]);

    }

}