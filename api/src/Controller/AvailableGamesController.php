<?php

/**
 *
 * GameTactic Maps 2019 — NOTICE OF LICENSE
 *
 * This source file is released under GPLv3 license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2019-2019 (c) GameTactic
 * @author Niko Granö <niko@granö.fi>
 *
 */

namespace App\Controller;

use App\Entity\Swagger\Games;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class AvailableGamesController
{
    /**
     * @Route(
     *     name="getGames",
     *     path="/games",
     *     methods={"GET"},
     *     defaults={
     *         "_api_item_operation_name"="getGames"
     *     }
     * )
     */
    public function __invoke()
    {
        $games = [
            ['World of Tanks', '/maps/wot'],
            ['World of Warships', '/maps/wows'],
        ];

        foreach ($games as &$game) {
            $game = new Games(...$game);
        }

        return new JsonResponse($games);
    }
}
