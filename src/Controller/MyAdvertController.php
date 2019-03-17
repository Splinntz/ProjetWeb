<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 28/02/19
 * Time: 19:58
 */

namespace App\Controller;

use App\Entity\Advert;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Form\AdvertType;


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
     * @Route("/myAdvert",name="advertRead")
     */
    public function renderPage()
    {
        return $this->render('MyAdvert/myAdvert.html.twig', [
            'listAdvert' => $this->user->getAdverts()
        ]);
    }

    /**
     * @Route("/myAdvert/remove/{id}")
     * @ParamConverter("Advert", class="App\Entity\Advert")
     */
    public function removeAdvert(Advert $advert, ObjectManager $objectManager)
    {
        $objectManager->remove($advert);
        $objectManager->flush();
        return $this->redirectToRoute('advertRead');
    }

    /**
     * @Route("/myAdvert/update/{id}")
     * @ParamConverter("Advert", class="App\Entity\Advert")
     */
   /* public function updateAdvert(Request $request,Advert $advert, ObjectManager $objectManager)
    {
        $form = $this->createForm(AdvertType::class, $advert);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $objectManager->flush();

            return $this->redirectToRoute('advertRead');
        }
        return $this->render('add/addad.html.twig',[
            'form' => $form->createView()
        ]);
    }*/

}