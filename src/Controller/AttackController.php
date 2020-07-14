<?php

namespace App\Controller;
use App\Entity\Pokemon;
use App\Entity\AttackDex;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AttackController extends AbstractController
{
    /**
     * @Route("/attack", name="attack")
     */
    public function index(SessionInterface $session)
    {
        $pokemons = [];
        $pokemonRepo = $this->getDoctrine()->getRepository(Pokemon::class);
        $Repo = $this->getDoctrine()->getRepository(AttackDex::class);

        $all = $Repo->findAll();

        $team = $session->get('pokemon');
        $form = $this->createFormBuilder()
                    ->add('attaque', ChoiceType::class,[
                            'choices' => [$all],
                            'choice_label' => function(AttackDex $all, $key, $value) {
                                $val = '';
                                switch($all->getCategorie()) {
                                    case 0:
                                        $val = 'Status';
                                    break;
                                    case 1:
                                        $val = 'Physique';
                                    break;
                                    case 2:
                                        $val = 'Spécial';
                                    break;
                                };
                                return $all->getName().' - '.$val;
                            },
                            'required' => false,
                            'attr' => ['class' => 'form-control']
                        ])
                    ->getForm();
        if($team)
        {
            foreach($team as $to)
            {
                array_push($pokemons, $pokemonRepo->findByNumDex($to));
            }
        }

        return $this->render('attack/index.html.twig', [
            'controller_name' => 'TeamCoverageController',
            'pokemons' => $pokemons,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/attack/ajout/{place}", name="attack-ajout")
     */
    public function attackAjout($place)
    {
        $Repo = $this->getDoctrine()->getRepository(AttackDex::class);
        $all = $Repo->findAll();
        return $this->render('modal/attack.html.twig', [
            'place' => $place,
            'attaques' => $all
        ]);
    }
}
