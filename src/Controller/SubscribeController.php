<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 21/02/2019
 * Time: 21:31
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubscribeController extends AbstractController
{
    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function create(Request $request, ObjectManager $objectManager)
    {
        $user = new User();

//        $form = $this->createFormBuilder($article)
//            ->add('title', TextType::class)
//            ->add('content', TextareaType::class)
//            ->add('author', TextType::class, [
//                'required' => true,
//            ])
//            ->add('submit', SubmitType::class)
//            ->getForm();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;

            $objectManager->persist($user);
            $objectManager->flush();

            return $this->redirectToRoute('app_login', [
                'slug' => $user->getLogin(),
            ]);
        }

        return $this->render('/inscription/subscribe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}