<?php
/**
 * Created by PhpStorm.
 * User: valen
 * Date: 21/02/2019
 * Time: 22:35
 */

namespace App\Controller;


use App\Entity\Advert;
use App\Entity\Discipline;
use Elastica\Processor\Date;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HomepageController extends AbstractController
{
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }
    /**
     * @Route("/", name="homepage")
     */
    public function read()
    {
        //return new Response('OMG! My first Symfony page! :D');
        $securityContext = $this->container->get('security.authorization_checker');

        if($securityContext->isGranted('ROLE_USER')){
            return $this->render('homePage.html.twig', ['adverts' => $this->getDoctrine()->getRepository(Advert::class)->findAll(),
                'disciplines' => $this->getDoctrine()->getRepository(Discipline::class)->findAll(),
                'advutilisateur'=>$this->user->getAdverts()]);
        }

        if($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')){
            return $this->render('homePage.html.twig', ['adverts' => $this->getDoctrine()->getRepository(Advert::class)->findAll(),
                'disciplines' => $this->getDoctrine()->getRepository(Discipline::class)->findAll()]);
        }

    }

    /**
     * @Route("/form")
     */
    public function filter(Request $request)
    {

        if ( !empty($_POST['dateChoice'])){
            $date = new \DateTime($_POST['dateChoice']);
        } else {
            $date = null;
        }
        if (!empty($_POST['price'])){

            $price = $_POST['price'];

        } else {
            $price = null;
        }
        if (isset($_POST['disciplinesCheckbox'])){
            $disciplines = $_POST['disciplinesCheckbox'] ;

        } else {
            $disciplines = null;
        }

        $listeAdverts = $this->getDoctrine()->getRepository(Advert::class)->findWithFilter($date,$price,$disciplines);

        return $this->render( 'homePage.html.twig', ['adverts' => $listeAdverts,
            'disciplines' => $this->getDoctrine()->getRepository(Discipline::class)->findAll(),
            'advutilisateur'=>$this->user->getAdverts()]);

    }

    /**
     * @Route("/homePage/removediscipline/{id}")
     * @ParamConverter("Discipline", class="App\Entity\Discipline")
     */
    public function removeDiscipline(Discipline $discipline, ObjectManager $objectManager)
    {
        $objectManager->remove($discipline);
        $objectManager->flush();
        if ($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('homepage');
        } else
            return $this->redirectToRoute('advertRead');
    }
}