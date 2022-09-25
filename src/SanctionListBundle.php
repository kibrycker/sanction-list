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
        /** Устанавливаем путь к шаблону для модуля */
        $container->loadFromExtension('twig', [
            'path' => '%kernel.project_dir%/vendor/k2/sanction-list/templates'
        ]);
    }

}
