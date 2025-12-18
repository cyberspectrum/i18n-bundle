<?php

declare(strict_types=1);

namespace CyberSpectrum\I18NBundle\Test\DependencyInjection;

use CyberSpectrum\I18NBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

#[CoversClass(Configuration::class)]
final class ConfigurationTest extends TestCase
{
    public function testDefaults(): void
    {
        $processor     = new Processor();
        $configuration = new Configuration();

        $processed = $processor->processConfiguration($configuration, [[]]);

        self::assertTrue($processed['enable_xliff']);
        self::assertTrue($processed['enable_memory']);
    }
}
