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
    /**
     * @Route("/pokedex", name="pokedex")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $pokemon = $this->getDoctrine()->getRepository(Pokemon::class);

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $p = $pokemon->findAllByNumDex();

        $r = [];

        foreach($p as $po) {
            array_push($r, $po->__toArray());
        }

        return $response->setContent(json_encode(
            [
                'result' => 'ok',
                'pokemons' => $r
            ]
        ));
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