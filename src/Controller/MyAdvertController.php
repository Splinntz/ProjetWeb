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

class MyAdvertController extends AbstractController
{

    private $listAdverts;

    /**
     * MyAdvertController constructor.
     */
    public function __construct()
    {


    }


    /**
     * @Route("/myAdvert")
     */
    public function renderPage()
    {
        dump($this->getDoctrine()->getRepository(Advert::class)->findAll());die;
        return $this->render('MyAdvert/myAdvert.html.twig', [
            'listAdvert' => null
        ]);
    }


}