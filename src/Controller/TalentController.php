<?php

namespace App\Controller;

use App\Entity\Talent;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;


class TalentController extends AbstractController
{
    /**
     * @Route("/talent", name="talent")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $talent = new Talent();

        $ta = $this->getDoctrine()->getRepository(Talent::class);

        $alltalent = $ta->findAll();

        echo 'hello';
        die();

        $form = $this->createFormBuilder()
                    ->add('Nom_du_talent', TextType::class, [
                        'required' => true
                    ])
                    ->add('Effet_combat', TextType::class, [
                        'required' => false
                    ])
                    ->add('Valider', SubmitType::class,[
                        'attr' => 
                            ['class' => 'btn btn-success']
                        ]
                    )
                    ->add('Annuler', ResetType::class,[
                        'attr' => 
                            ['class' => 'btn btn-danger']
                    ])
                    ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $type = $form->getData();
            $pers = new Talent();
            $pers->setName($type['Nom_du_talent']);
            $pers->setEffetCombat($type['Effet_combat']);

            $entityManager->persist($pers);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_talent');
        }

        return $this->render('talent/index.html.twig', [
            'controller_name' => 'TalentController',
            'form' => $form->createView(),
            'talents' => $alltalent
        ]);
    }

    /**
     * @Route("/talent/add", name="talent-add")
     */
    public function ajout(Request $request)
    {
        $talent = new Talent();

        $form = $this->createFormBuilder($talent)
                    ->add('Name', TextType::class, [
                        'required' => true
                    ])
                    ->add('EffetCombat', TextType::class, [
                        'required' => false
                    ])
                    ->add('Valider', SubmitType::class,[
                        'attr' => 
                            ['class' => 'btn btn-success']
                        ]
                    )
                    ->add('Annuler', ResetType::class,[
                        'attr' => 
                            ['class' => 'btn btn-danger']
                    ])
                    ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $talent = new Talent();
            $talent->setName($form->getData()->getName());
            $talent->setEffetCombat($form->getData()->getEffetCombat());

            $entityManager->persist($talent);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_talent');
        }

        return $this->render('modal/talent-add.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/talent/{id}", name="talent-modification")
     */
    public function modification(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Talent::class);

        $getTalent = $repository->find($id);

        $form = $this->createFormBuilder($getTalent)
                    ->add('Name', TextType::class, [
                        'required' => true
                    ])
                    ->add('EffetCombat', TextType::class, [
                        'required' => false
                    ])
                    ->add('Valider', SubmitType::class,[
                        'attr' => 
                            ['class' => 'btn btn-success']
                        ]
                    )
                    ->add('Annuler', ResetType::class,[
                        'attr' => 
                            ['class' => 'btn btn-danger']
                    ])
                    ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('app_admin_talent');
        }
        return $this->render('modal/talent.html.twig',[
            'form' => $form->createView(),
            'talent' => $getTalent
        ]);
    }
}
