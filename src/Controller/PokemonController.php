<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Type;
use App\Entity\Talent;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonController extends AbstractController
{
    /**
     * @Route("/pokemon", name="pokemon")
     */
    public function getAllPokemon()
    {
        try {
            $id = 1;
            $pr = $this->getDoctrine()->getRepository(Pokemon::class);
            $pokemons = $pr->find($id);
            var_dump($this->serialize($pokemons));
            die();
        } catch(\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @Route("/pokemon/{id}", name="pokemon")
     */
    public function getOnePokemon(int $id)
    {
        try {
            $pr = $this->getDoctrine()->getRepository(Pokemon::class);
            $pokemons = $pr->find($id);
            return new Response(serialize($pokemons),200, ['Content-Type' => 'application/json']);
        }catch(\Exception $ex) {
            return new Response(serialize($ex->getMessage()),404, ['Content-Type' => 'application/json']);
        }
    }
}
