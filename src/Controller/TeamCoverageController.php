<?php

namespace App\Controller;

use App\Entity\Type;
use App\Entity\Pokemon;
use App\Entity\Nature;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeamCoverageController extends AbstractController
{
    /**
     * @Route("/team/coverage", name="team_coverage")
     */
    public function index(SessionInterface $session)
    {
        $pokemons = [];
        $type = $this->getDoctrine()->getRepository(Type::class);
        $nature = $this->getDoctrine()->getRepository(Nature::class);
        $pokemonRepo = $this->getDoctrine()->getRepository(Pokemon::class);
        $allType = $type->findAllASC();
        $allNature = $nature->findAll();

        $team = $session->get('pokemon');

        if($team)
        {
            foreach($team as $to)
            {
                array_push($pokemons, $pokemonRepo->find($to));
            }
        }

        return $this->render('team_coverage/index.html.twig', [
            'controller_name' => 'TeamCoverageController',
            'natures' => $allNature,
            'types' => $allType,
            'pokemons' => $pokemons,
            'natureTab' => ($session->get('nature') ? $session->get('nature') : '')
        ]);
    }

    /**
     * @Route("/team/nature/{id}/{nature}", name="teamcoverage-nature")
     */
    public function addNature($id, $nature, SessionInterface $session)
    {
        $array = $session->get('nature');
        $t[$id] = $nature;
        if (!$array) {
            $bs = $t;
        }else {
            $bs = array_replace($array, $t);
        }

        $session->set('nature', $bs);

        return $this->redirectToRoute('app_team_coverage');
    }

    /**
     * @Route("/team/coverage/{place}", name="teamcoverage-ajout")
     */
    public function ajout($place)
    {
        $repository = $this->getDoctrine()->getRepository(Pokemon::class);
        $pokemons = $repository->findAll();
        return $this->render('modal/allPokemon.html.twig', [
            'place' => $place,
            'pokemons' => $pokemons
        ]);
    }

    /**
     * @Route("/team/coverage/remove/{place}", name="teamcoverage-remove")
     */
    public function suppSession($place, SessionInterface $session)
    {
        $array = $session->get('pokemon');
        array_splice($array, $place,1);

        $session->set('pokemon', $array);

        return $this->render('modal/removePokemon.html.twig');
    }

    /**
     * @Route("/team/coverage/{place}/{pokemonId}", name="teamcoverage-add")
     */
    public function addSession($place, $pokemonId, SessionInterface $session)
    {
        $array = $session->get('pokemon');
        $t[$place] = $pokemonId;
        if (!$array) {
            $bs = $t;
        }else {
            $bs = array_replace($array, $t);
        }

        $session->set('pokemon', $bs);

        return $this->redirectToRoute('app_team_coverage');
    }

}
