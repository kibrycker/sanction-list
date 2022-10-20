<?php

namespace SanctionList;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SanctionListBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * {@inheritdoc}
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
//        $projectPath = $container->getParameter('kernel.project_dir');
//        $curDir = $projectPath . '/vendor/k2/sanction-list';
//        $curDir = $projectPath;
        /** Устанавливаем путь к шаблону для модуля */
//        if ($container->hasExtension('twig')) {
//            $container->loadFromExtension('twig', [
//                'path' => $curDir . '/templates',
//                'form_themes' => ['bootstrap_4_layout.html.twig']
//            ]);
//        }
//
//        if ($container->hasExtension('webpack_encore')) {
//            $container->loadFromExtension('webpack_encore', [
//                'output_path' => $curDir . '/html/sl-build',
//                'builds' => [
//                    'sanction-list' => $curDir . '/html/sl-build',
//                ],
//                'strict_mode' => false
//            ]);
//        }
//
//        if ($container->hasExtension('framework')) {
//            $container->loadFromExtension('framework', [
//                'assets' => [
//                    'json_manifest_path' => $curDir . '/html/sl-build/manifest.json',
//                ],
//            ]);
//        }

        /** Пока временное решение для прокидывания симлинка build`а с css и js файлами */
//        $publicDir = 'html';
//        if (!file_exists($projectPath . '/' . $publicDir . '/sl-build')
//        || linkinfo($projectPath . '/' . $publicDir . '/sl-build') === -1) {
//            if (file_exists($curDir . '/html/sl-build')) {
//                symlink($curDir . '/html/sl-build', $projectPath . '/' . $publicDir . '/sl-build');
//            }
//        }

        unset($curDir);
//        $kernel = $container->get('kernel');
//        bin/console assets:install --symlink
//        $buildDir = $container->getParameter('kernel.build_dir');
//        var_dump($buildDir);die();
    }

}
