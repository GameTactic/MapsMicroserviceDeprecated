<?php

/**
 *
 * GameTactic Maps 2020 — NOTICE OF LICENSE
 *
 * This source file is released under GPLv3 license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2019-2020 (c) GameTactic
 * @author Niko Granö <niko@granö.fi>
 *
 */

namespace App\Controller\Maps;

use App\Integration\Wargaming\WorldOfTanks as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class WorldOfTanksController extends AbstractController
{
    /**
     * @Route(
     *     name="getWot",
     *     path="/maps/wot",
     *     methods={"GET"},
     *     defaults={
     *         "_api_collection_operation_name"="getWot",
     *     }
     * )
     *
     * @throws GuzzleException
     */
    public function __invoke(HttpClient $client, Request $request): JsonResponse
    {
        $maps = $client->getAll($request->get('region', 'eu'));
        foreach ($maps as &$map) {
            $map =
                [
                    'name' => $map->getName(),
                    'id'   => $map->getArenaId(),
                    'camo' => $map->getCamouflage(),
                ];
        }

        return new JsonResponse($maps);
    }
}
