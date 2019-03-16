
<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 01/03/2019
 * Time: 15:32
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\ProfilType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render('userSpace/userSpace.html.twig', ['user'=>$this->getUser()]);
    }

    /**
     * @Route("/modifyProfil", name="modifyProfil")
     */
    public function create(Request $request, ObjectManager $objectManager)
    {
        $user = $this->getUser();
//        $form = $this->createFormBuilder($article)
//            ->add('title', TextType::class)
//            ->add('content', TextareaType::class)
//            ->add('author', TextType::class, [
//                'required' => true,
//            ])
//            ->add('submit', SubmitType::class)
//            ->getForm();

        $form = $this->createForm(ProfilType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;

            $objectManager->persist($user);
            $objectManager->flush();

            return $this->redirectToRoute('userSpace', [
                'slug' => $user->getLogin(),
            ]);
        }

        return $this->render('/userSpace/modifyProfil.html.twig', [
            'form' => $form->createView(), 'user2' => $user
        ]);
    }

}