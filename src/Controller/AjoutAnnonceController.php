<?php
/**
 * Created by PhpStorm.
 * User: Guillaumé
 * Date: 24/02/2019
 * Time: 13:40
 */

namespace App\Controller;


use App\Entity\Advert;
use App\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjoutAnnonceController extends AbstractController
{
    /**
     * @Route("/ajoutannonce", name="addad")
     */
    public function create(Request $request, ObjectManager $objectManager)
    {
        $advert = new Advert();

        $form = $this->createForm(AdvertType::class, $advert);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $objectManager->persist($advert);
            $objectManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('/add/addad.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}