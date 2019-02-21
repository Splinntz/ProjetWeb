<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 21/02/2019
 * Time: 21:31
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscriptionPage")
     */
    public function read()
    {
        //return new Response('OMG! My first Symfony page! :D');

        return $this->render('inscription/subscribe.html.twig');
    }
}