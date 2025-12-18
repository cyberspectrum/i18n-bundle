<?php

declare(strict_types=1);

namespace CyberSpectrum\I18NBundle\Test\Configuration\Loader;

use CyberSpectrum\I18N\Configuration\Configuration;
use CyberSpectrum\I18N\Configuration\Definition\Definition;
use CyberSpectrum\I18N\Configuration\DefinitionBuilder;
use CyberSpectrum\I18NBundle\Configuration\Loader\AbstractFileLoader;
use CyberSpectrum\I18NBundle\Configuration\Loader\YamlLoader;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\FileLocatorInterface;

#[CoversClass(AbstractFileLoader::class)]
final class YamlLoaderTest extends TestCase
{
    public function testLoading(): void
    {
        $config = new Configuration();

        $definitionBuilder = $this
            ->getMockBuilder(DefinitionBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $definitionBuilder
            ->expects($this->exactly(2))
            ->method('buildDictionary')
            ->willReturnCallback(
                static function (Configuration $configuration, array $data) use ($config) {
                    static $invocation = 0;
                    switch ($invocation++) {
                        case 0:
                            self::assertSame($config, $configuration);
                            self::assertSame(['type' => 'xliff', 'name' => 'xliff-out'], $data);
                            break;
                        case 1:
                            self::assertSame($config, $configuration);
                            self::assertSame(['type' => 'xliff', 'name' => 'xliff-in'], $data);
                            break;
                        default:
                            self::fail('Unexpected invocation.');
                    }
                    return new Definition('dummy');
                }
            );

        $loader = new YamlLoader($config, new FileLocator([__DIR__ . '/../Fixtures']), $definitionBuilder);
        $loader->load('import-parent.yaml');

        self::assertSame($config, $loader->getConfiguration());
    }
}
