<?php

declare(strict_types=1);

namespace CyberSpectrum\I18NBundle;

use CyberSpectrum\I18NBundle\DependencyInjection\CompilerPass\CollectDictionaryProvidersPass;
use CyberSpectrum\I18NBundle\DependencyInjection\CyberSpectrumI18NExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/** This provides the bundle entry point. */
final class CyberSpectrumI18NBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new CollectDictionaryProvidersPass());
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getContainerExtension(): ExtensionInterface
    {
        if (!$this->extension) {
            return $this->extension = new CyberSpectrumI18NExtension();
        }
        assert($this->extension instanceof CyberSpectrumI18NExtension);

        return $this->extension;
    }
}
