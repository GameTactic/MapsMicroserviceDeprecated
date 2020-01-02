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

namespace App\Entity\Swagger\Maps;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class WorldOfTanks.
 *
 * @ApiResource(
 *     itemOperations={},
 *     collectionOperations={
 *         "viewGames"={
 *             "route_name"="getWot",
 *             "swagger_context"={
 *                 "parameters"={
 *                      {
 *                          "name"="region",
 *                          "in"="query",
 *                          "required"="true",
 *                          "type"="string",
 *                      },
 *                 },
 *             },
 *         }
 *     }
 * )
 */
class WorldOfTanks
{
    /**
     * @var string
     */
    private $arenaId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $camouflage;
    /**
     * @var string
     */
    private $description;

    public function __construct(string $arenaId, string $name, string $camouflage, string $description)
    {
        $this->arenaId = $arenaId;
        $this->name = $name;
        $this->camouflage = $camouflage;
        $this->description = $description;
    }

    public function getArenaId(): string
    {
        return $this->arenaId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCamouflage(): string
    {
        return $this->camouflage;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
