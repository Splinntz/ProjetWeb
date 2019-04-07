<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 06/04/19
 * Time: 16:31
 */

namespace App\Controller;


use App\Entity\Tchat;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTchats extends AbstractController
{

    /**
     * @Route("/admin/gestionTchats")
     */
    public function create(){
        return $this->render('admin/gestionTchats.html.twig', ['listTchats' => $this->getDoctrine()->getRepository(Tchat::class)->findAll()]);
    }

    /**
     * @Route("/admin/deleteTchat/{id}")
     * @ParamConverter("Tchat", class="App\Entity\Tchat")
     */
    public function deleteTchat(Tchat $tchat, ObjectManager $objectManager){

        $objectManager->remove($tchat);
        $objectManager->flush();
        return $this->create();
    }

}