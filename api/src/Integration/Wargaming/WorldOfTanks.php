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

namespace App\Integration\Wargaming;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class WorldOfTanks
{
    public const REGION_EU = 'eu';
    public const REGION_NA = 'na';
    public const REGION_RU = 'ru';
    public const REGION_ASIA = 'asia';
    public const REGIONS =
        [
            self::REGION_EU,
            self::REGION_NA,
            self::REGION_RU,
            self::REGION_ASIA,
        ];
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var string
     */
    private $wgApplicationId;

    /**
     * WorldOfTanks constructor.
     *
     * @param ContainerInterface $container
     * @param string             $wgApplicationId
     */
    public function __construct(ContainerInterface $container, string $wgApplicationId)
    {
        $this->container = $container;
        $this->wgApplicationId = $wgApplicationId;
    }

    /**
     * @param string $region
     *
     * @return ClientInterface
     */
    private function getClient(string $region): ClientInterface
    {
        if (!\in_array($region, self::REGIONS, true)) {
            throw new \InvalidArgumentException(
                sprintf('Region must be one of %s.', implode(', ', self::REGIONS))
            );
        }

        return $this->container->get(sprintf('eight_points_guzzle.client.wot_%s_maps', $region));
    }

    /**
     * @param string $region
     *
     * @throws GuzzleException
     *
     * @return \App\Entity\Swagger\Maps\WorldOfTanks[]
     */
    public function getAll(string $region): array
    {
        $contents = $this->getClient($region)
            ->request('GET', '?application_id='.$this->wgApplicationId)
            ->getBody()
            ->getContents();
        $contents = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        if ('ok' !== $contents['status']) {
            return [];
        }

        $contents = $contents['data'];
        foreach ($contents as &$item) {
            $item = new \App\Entity\Swagger\Maps\WorldOfTanks(
                $item['arena_id'],
                $item['name_i18n'],
                $item['camouflage_type'],
                $item['description'],
            );
        }

        return $contents;
    }
}
