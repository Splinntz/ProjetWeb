<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 21/02/2019
 * Time: 21:31
 */

namespace App\Controller;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\RegistrationFormType;
use App\Security\StubAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/subscribe", name="subscribe")
     */
    /* public function create(Request $request, ObjectManager $objectManager)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;
            $user->setNote(0);
            $user->setNumberRatings(0);
            $objectManager->persist($user);
            $objectManager->flush();

            return $this->redirectToRoute('app_login', [
                'slug' => $user->getLogin(),
            ]);
        } */

        public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $user->setNote(0);
            $user->setNumberRatings(0);
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login', [
                'slug' => $user->getLogin(),
            ]);
        }


        return $this->render('/inscription/subscribe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}