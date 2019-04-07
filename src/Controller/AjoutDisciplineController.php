<?php

namespace App\Controller;


use App\Entity\Discipline;
use App\Form\DisciplineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AjoutDisciplineController extends AbstractController
{
    /**
     * @Route("/admin/ajoutdiscipline")
     */
    public function create(Request $request, ObjectManager $objectManager, TokenStorageInterface $token)
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
}