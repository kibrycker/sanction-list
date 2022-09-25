<?php

namespace SanctionList;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * {@inheritDoc}
     */
    public function boot(): void
    {
        parent::boot();
        $container = $this->getContainer();

        // Устанавливаем часовой пояс, если задан в конфигурации
        if ($container->hasParameter('timezone')) {
            date_default_timezone_set($container->getParameter('timezone'));
        }
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }
}
