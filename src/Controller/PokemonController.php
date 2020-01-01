<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Type;
use App\Entity\Talent;

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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PokemonController extends AbstractController
{
    /**
     * @Route("/pokemon", name="pokemon")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $pokemon = new Pokemon();

        $type = $this->getDoctrine()->getRepository(Type::class);
        $talent = $this->getDoctrine()->getRepository(Talent::class);
        $repositoryPokemon = $this->getDoctrine()->getRepository(Pokemon::class);

        $allType = $type->findAll();
        $allTalent = $talent->findAll();
        $pokemons = $repositoryPokemon->findAll();

        $form = $this->createFormBuilder()
                    ->add('Nom', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('Numero', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('type_1', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('type_2', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_1', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_2', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_cache', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('generation', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('HP', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('ATK', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('DEF', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPE_ATK', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPE_DEF', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPEED', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
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

            $po = $form->getData();

            $okemon = new Pokemon();
            $pokemon->setName($po['Nom']);
            $pokemon->setNumDex($po['Numero']);
            $pokemon->setTypeOne($po['type_1']->getId());
            $pokemon->setTalentOne($po['talent_1']->getId());
            $pokemon->setTalentHide($po['talent_cache']->getId());
            $pokemon->setHp($po['HP']);
            $pokemon->setAttack($po['ATK']);
            $pokemon->setDefense($po['DEF']);
            $pokemon->setSpeAttack($po['SPE_ATK']);
            $pokemon->setSpeDefense($po['SPE_DEF']);
            $pokemon->setSpeed($po['SPEED']);

            if (is_null($po['talent_2']))
            {
                $pokemon->setTalentTwo(0);
            }else {
                $pokemon->setTalentTwo($po['talent_2']->getId());
            }

            if (is_null($po['type_2']))
            {
                $pokemon->setTypeTwo(0);
            }else {
                $pokemon->setTypeTwo($po['type_2']->getId());
            }

            $entityManager->persist($pokemon);
            
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_pokemon'); 
        }

        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
            'form' => $form->createView(),
            'pokemons' => $pokemons
        ]);
    }

    /**
     * @Route("/pokemon/add", name="pokemon-add")
     */
    public function ajout(Request $request)
    {
        $pokemon = new Pokemon();

        $type = $this->getDoctrine()->getRepository(Type::class);
        $talent = $this->getDoctrine()->getRepository(Talent::class);
        $repositoryPokemon = $this->getDoctrine()->getRepository(Pokemon::class);

        $allType = $type->findAll();
        $allTalent = $talent->findAll();
        $pokemons = $repositoryPokemon->findAll();

        $form = $this->createFormBuilder()
                    ->add('Nom', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('Numero', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('type_1', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('type_2', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_1', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_2', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talent_cache', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('generation', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('HP', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('ATK', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('DEF', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPE_ATK', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPE_DEF', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPEED', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
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

            $po = $form->getData();

            $talent = $type = $this->getDoctrine()->getRepository(Type::class);

            $type1 = $talent->find($po['type_1']->getId());
            $okemon = new Pokemon();
            $pokemon->setName($po['Nom']);
            $pokemon->setNumDex($po['Numero']);
            $pokemon->setTypeOne($type1);
            $pokemon->setHp($po['HP']);
            $pokemon->setAttack($po['ATK']);
            $pokemon->setDefense($po['DEF']);
            $pokemon->setSpeAttack($po['SPE_ATK']);
            $pokemon->setSpeDefense($po['SPE_DEF']);
            $pokemon->setSpeed($po['SPEED']);

            if ($po['type_2'] != null) {
                $type2 = $talent->find($po['type_2']->getId());
                $pokemon->setTypeTwo($type2);
            }

            $entityManager->persist($pokemon);
            
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_pokemon'); 
        }

        return $this->render('modal/pokemon-add.html.twig', [
            'controller_name' => 'PokemonController',
            'form' => $form->createView(),
            'pokemons' => $pokemons
        ]);
    }

    /**
     * @Route("/pokemon/{id}", name="pokemon-modification")
     */
    public function modification(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Pokemon::class);
        $type = $this->getDoctrine()->getRepository(Type::class);
        $talent = $this->getDoctrine()->getRepository(Talent::class);
        $allType = $type->findAll();
        $allTalent = $talent->findAll();
        $pokemon = $repository->find($id);


        $form = $this->createFormBuilder($pokemon)
                    ->add('name', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('numDex', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('typeone', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('typetwo', ChoiceType::class,[
                        'choices' => [$allType],
                        'choice_label' => function(Type $allType, $key, $value) {
                            return $allType->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talentone', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talenttwo', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => false,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('talenthide', ChoiceType::class,[
                        'choices' => [$allTalent],
                        'choice_label' => function(Talent $allTalent, $key, $value) {
                            return $allTalent->getName();
                        },
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('generation', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('HP', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('attack', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('defense', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('speattack', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('spedefense', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
                    ])
                    ->add('SPEED', TextType::class, [
                        'required' => true,
                        'attr' => ['class' => 'form-control']
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

        if ($form->isSubmitted() /* && $form->isValid() */)
        {
            $em = $this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('app_admin_pokemon');
        }
        return $this->render('modal/pokemon.html.twig',[
            'form' => $form->createView(),
            'pokemon' => $pokemon
        ]);
    }
}
