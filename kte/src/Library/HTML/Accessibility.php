<?php

namespace Library\HTML;

class Accessibility
{
    public function ariaLabel(?string $ariaLabel, ?string $ariaLabelId): string
    {
        if ($ariaLabel === null && $ariaLabelId === null) {
            return '';
        } elseif ($ariaLabel === null) {
            return 'aria-labelledby="' . $ariaLabelId . '"';
        } elseif ($ariaLabelId === null) {
            return 'aria-label="' . $ariaLabel . '"';
        } else {
            return 'aria-label="' . $ariaLabel . '" aria-labelledby="' . $ariaLabelId . '"';
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