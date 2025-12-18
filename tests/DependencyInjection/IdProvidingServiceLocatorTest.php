<?php

declare(strict_types=1);

namespace CyberSpectrum\I18NBundle\Test\DependencyInjection;

use CyberSpectrum\I18NBundle\DependencyInjection\IdProvidingServiceLocator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(IdProvidingServiceLocator::class)]
class IdProvidingServiceLocatorTest extends TestCase
{
    public function testReturnsIds(): void
    {
        $locator = new IdProvidingServiceLocator([
            'test1' => fn () => null,
            'test2' => fn () => null,
            'test3' => fn () => null,
        ]);

        self::assertSame(['test1', 'test2', 'test3'], $locator->ids());
    }
}
