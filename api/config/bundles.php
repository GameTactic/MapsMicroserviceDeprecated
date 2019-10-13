<?php

/**
 *
 * GameTactic xxxx 2019 — NOTICE OF LICENSE
 *
 * This source file is released under GPLv3 license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2019-2019 (c) GameTactic
 * @author Niko Granö <niko@granö.fi>
 *
 */

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class            => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class              => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class                      => ['all' => true],
    Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle::class   => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class             => ['all' => true],
    ApiPlatform\Core\Bridge\Symfony\Bundle\ApiPlatformBundle::class  => ['all' => true],
    Nelmio\CorsBundle\NelmioCorsBundle::class                        => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class        => ['dev' => true, 'test' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class                    => ['dev' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
];
