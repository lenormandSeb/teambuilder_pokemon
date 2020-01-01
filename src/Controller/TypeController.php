<?php

namespace App\Controller;

use App\Entity\Type;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(Type::class);

        $allType = $repository->findAll();

        $type = new Type();

        $form = $this->createFormBuilder()
                    ->add('Nom_du_type', TextType::class, [
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

            $pers = new Type();
            $pers->setName($type['Nom_du_type']);

            $entityManager->persist($pers);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_type'); 
        }

        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
            'form' => $form->createView(),
            'types' => $allType
        ]);
    }

    public function saveType($type) :Response 
    {
        dump($type);
        die();
    }
}
