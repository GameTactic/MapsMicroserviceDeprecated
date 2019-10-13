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

namespace App\Entity\Swagger;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Games.
 *
 * @ApiResource(
 *     itemOperations={},
 *     collectionOperations={
 *         "viewGames"={
 *             "route_name"="getGames",
 *             "swagger_context"={
 *                  "parameters"={}
 *              }
 *         }
 *     }
 * )
 */
class Games
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $path;

    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
    }
}
