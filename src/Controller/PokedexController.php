<?php

namespace App\Controller;
use App\Entity\Pokedex;
use App\Entity\Pokemon;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PokedexController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager)
    {
        $pokemon = $this->getDoctrine()->getRepository(Pokemon::class);

        $pokemons = $pokemon->findAllByNumDex();

        return $this->render('pokedex/index.html.twig',[
            'pokemons' => $pokemons,
            'gen' => false
        ]);
    }

    /**
     * @Route("/pokedex/{gen}", name="pokedex")
     */
    public function generation($gen)
    {
        $pokemon = $this->getDoctrine()->getRepository(Pokemon::class);

        $pokemons = $pokemon->findByGeneration($gen);

        return $this->render('pokedex/index.html.twig',[
            'gen' => $gen,
            'pokemons' => $pokemons
        ]);
    }
}