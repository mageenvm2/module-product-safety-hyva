<?php
/**
 * Copyright © MageEnv. All rights reserved.
 * Licensed under the Open Software License 3.0 (OSL-3.0). See LICENSE.txt.
 */
declare(strict_types=1);

namespace MageEnv\ProductSafetyHyva\Test\Unit;

use PHPUnit\Framework\TestCase;

/**
 * The add-on must stay presentation only: no PHP classes besides registration.php.
 */
class NoBusinessLogicTest extends TestCase
{
    public function testOnlyRegistrationPhp(): void
    {
        $root = dirname(__DIR__, 2);
        $php = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));
        foreach ($iterator as $file) {
            $path = substr((string)$file, strlen($root) + 1);
            if (str_ends_with($path, '.php') && !str_starts_with($path, 'Test/') && !str_starts_with($path, 'vendor/')) {
                $php[] = $path;
            }
        }
        $this->assertSame(['registration.php'], $php);
    }

    public function testTemplateIsScopedToHyva(): void
    {
        $template = (string)file_get_contents(dirname(__DIR__, 2) . '/view/frontend/templates/product/safety.phtml');
        $this->assertStringContainsString('mageenv-ps--hyva', $template);
        $css = (string)file_get_contents(dirname(__DIR__, 2) . '/view/frontend/web/css/mageenv-product-safety.css');
        foreach (preg_split('/}/', $css) as $rule) {
            $selector = trim((string)strstr($rule, '{', true));
            $selector = trim((string)preg_replace('#/\*.*?\*/#s', '', $selector));
            if ($selector === '' || str_starts_with($selector, '@media')) {
                continue;
            }
            foreach (explode(',', $selector) as $part) {
                $this->assertStringContainsString('.mageenv-ps--hyva', $part, 'Unscoped selector: ' . $part);
            }
        }
    }
}
