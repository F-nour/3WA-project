<?php

namespace Library\HTML;

class Accessibility
{
    public function ariaLabel(?string $ariaLabel, ?string $arialLabeledBy = null): ?string
    {
        if ($ariaLabel === null && $arialLabeledBy === null) {
            return '';
        } elseif ($ariaLabel === null) {
            return 'aria-labelledby="' . $arialLabeledBy . '"';
        } elseif ($arialLabeledBy === null) {
            return 'aria-label="' . $ariaLabel . '"';
        } else {
            return 'aria-label="' . $ariaLabel . '" aria-labelledby="' . $arialLabeledBy . '"';
        }
    }

    public function ariaHidden(): string
    {
        return 'aria-hidden="true"';
    }

    public function srOnly(?string $label): string
    {
        return '<span class="sr-only">' . $label . '</span>';
    }
}