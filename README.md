# MageEnv_ProductSafetyHyva

Composer package: `mageenv/module-product-safety-hyva`
Magento module: `MageEnv_ProductSafetyHyva`
License: OSL-3.0 (free)

Hyvä storefront templates for **GPSR Product Safety** (`mageenv/module-product-safety`),
the extension for Magento that manages and shows the product safety information the EU
General Product Safety Regulation (EU) 2023/988 asks online shops to display.

## What it does

On Hyvä themes it renders the core module's **Product Safety** block on the product page:
manufacturer, EU responsible person, importer, product identification, warnings with
icons, safety information and downloadable documents. All placements of the core module
work: product page section (default), product info column (Hyvä's slot directly below
Add to Cart), full width below the product sections, and the "Product Safety Information"
widget.

This module contains **no business logic**. It only provides a template and a stylesheet.
Data, settings, translations and caching all come from the core module.

## Requirements

| | |
|---|---|
| Core module (required) | `mageenv/module-product-safety` `^1.0.0` |
| Hyvä | `hyva-themes/magento2-theme-module` 1.1 or later |
| Magento Open Source / Adobe Commerce | 2.4.7 to 2.4.9 |
| PHP | 8.2 to 8.5 |

A Luma-only store needs the core module alone.

## Installation

```bash
composer require mageenv/module-product-safety-hyva
bin/magento module:enable MageEnv_ProductSafetyHyva
bin/magento setup:upgrade
bin/magento setup:di:compile            # production mode
bin/magento setup:static-content:deploy # production mode
bin/magento cache:flush
```

## Safe on Luma store views

* The template is used only when the active theme is a Hyvä theme (or inherits from one);
  Luma store views keep the core Luma template.
* The stylesheet is added in `hyva_default.xml`, a layout handle that `Hyva_Theme`
  activates only on Hyvä themes.
* Every CSS selector is scoped under `.mageenv-ps--hyva`.

No Tailwind build is needed: the stylesheet is plain CSS and inherits your theme's font
and link colours. Override the `--mageenv-ps-*` CSS variables in your theme to restyle it.

## Accessibility

Real headings, a definition list, text alternatives for icons, links that announce new
windows, keyboard-operable collapsible section (`<details>`, no JavaScript), visible focus
and reduced-motion support.

## Support

info@mageenv.com · [mageenv.com/extensions](https://mageenv.com/extensions/)

This extension helps you manage and display product safety information. It does not give
legal advice; you remain responsible for the accuracy of your data.
