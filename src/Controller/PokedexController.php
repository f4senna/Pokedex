<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PokedexRepository;
use App\Entity\Pokedex;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokedexController extends AbstractController
{
    #[Route('/pokedex', name: 'app_pokedex')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PokedexController.php',
        ]);
    }

    #[Route('/pokedex/pokemons', name:"pokedex.getAll", methods: ['GET'])]
    public  function getAllPokemons(PokedexRepository $repository, SerializerInterface $serializer) {
        $jsonPokemons =  $serializer->serialize($repository->findAll(), "json");
        return new JsonResponse($jsonPokemons,200,[],true);
    }

    //#[Route('/pokedex/pokemon/{idPokemon}', name:"pokedex.get", methods: ['GET'])]
    //#[ParamConverter('pokemon', options: ['id' => 'idPokemon'])]
    //public function getOnePokemon(Pokedex $pokemon, SerializerInterface $serializer) {
    //    $jsonPokemon= $serializer->serialize($pokemon,'json');
    //    return new JsonResponse($jsonPokemon,200,[],true);
    //}

    #[Route('/pokedex/pokemon/{idPokemon}', name:"pokedex.get", methods: ['GET'])]
    public function getOnePokemon(Request $request, PokedexRepository $repository, SerializerInterface $serializer) {
        $idPokemon = $request->attributes->get('idPokemon');
        $pokemon = $repository->find($idPokemon);
        if (!$pokemon) {
            throw $this->createNotFoundException('Pokemon not found');
        }
        $jsonPokemon = $serializer->serialize($pokemon, 'json');
        return new JsonResponse($jsonPokemon, 200, [], true);
    }

    #[Route('/pokedex/pokemon', name:"pokemon.create", methods: ['POST'])]
    public function addPokemon(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $pokemon = new Pokedex();
        $pokemon->setName($data['name'] ?? null);
        $pokemon->setType($data['type'] ?? null);
        $pokemon->setEvolution($data['evolution'] ?? null);
        $pokemon->setStatistique($data['statistique'] ?? null);
        $pokemon->setHp($data['hp'] ?? null);
        $pokemon->setAtk($data['atk'] ?? []);
        $pokemon->setDefense($data['defense'] ?? null);
        $pokemon->setWeight($data['weight'] ?? null);
        $pokemon->setHeight($data['height'] ?? null);
        $pokemon->setImage($data['image'] ?? null);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pokemon);
        $entityManager->flush();

        return new Response('Pokemon ajouté avec succès', Response::HTTP_CREATED);
    }

    #[Route('/pokedex/pokemon/{idPokemon}', name:"pokemon.update", methods: ['PUT'])]
    public function updatePokemon(Request $request, Pokedex $pokemon): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $pokemon->setName($data['name']);
        }
        if (isset($data['type'])) {
            $pokemon->setType($data['type']);
        }
        if (isset($data['evolution'])) {
            $pokemon->setEvolution($data['evolution']);
        }
        if (isset($data['statistique'])) {
            $pokemon->setStatistique($data['statistique']);
        }
        if (isset($data['hp'])) {
            $pokemon->setHp($data['hp']);
        }
        if (isset($data['atk'])) {
            $pokemon->setAtk($data['atk']);
        }
        if (isset($data['defense'])) {
            $pokemon->setDefense($data['defense']);
        }
        if (isset($data['weight'])) {
            $pokemon->setWeight($data['weight']);
        }
        if (isset($data['height'])) {
            $pokemon->setHeight($data['height']);
        }
        if (isset($data['image'])) {
            $pokemon->setImage($data['image']);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new Response('Pokemon mis à jour avec succès', Response::HTTP_OK);
    }


    #[Route('/pokedex/pokemon/{idPokemon}', name:"pokemon.delete", methods: ['DELETE'])]
    public function deletePokemon(Pokedex $pokemon): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($pokemon);
        $entityManager->flush();

        return new Response('Pokemon supprimé avec succès', Response::HTTP_OK);
    }

}
