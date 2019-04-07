<?php

namespace App\Controller;


use App\Entity\Discipline;
use App\Form\DisciplineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GestionDisciplineController extends AbstractController
{


    /**
     * @Route("/admin/gestiondiscipline")
     */
    public function create(){
        return $this->render('/admin/gestiondiscipline.html.twig', ['listdiscipline'=>$this->getDoctrine()->getRepository(Discipline::class)->findAll()]);
    }

    /**
     * @Route("/admin/adddiscipline")
     */
    public function addDiscipline(Request $request, ObjectManager $objectManager)
    {
        $discipline = new Discipline();

        $form = $this->createForm(DisciplineType::class, $discipline);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->get('name')->getData();
            $discipline->setName($data);
            $objectManager->persist($discipline);
            $objectManager->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('/admin/adddiscipline.html.twig', [
            'form' => $form->createView()]);
    }

    /**
     * @Route("/admin/removediscipline/{id}")
     * @ParamConverter("Discipline", class="App\Entity\Discipline")
     */
    public function deleteDiscipline(Discipline $discipline, ObjectManager $objectManager){

        $objectManager->remove($discipline);
        $objectManager->flush();
        return $this->create();

    }


}