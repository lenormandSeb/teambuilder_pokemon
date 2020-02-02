<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Type;
use App\Entity\Talent;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends AbstractController
{
    /**
     * @Route("/pokemon/", name="pokemon")
     */
    public function getAllPokemon(Request $request)
    {
        try {
            $pr = $this->getDoctrine()->getRepository(Pokemon::class);
            $pokemons = $pr->findAll();
            return new Response(serialize($pokemons), 200, ['Content-Type' => 'application/json']);
        } catch(\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
