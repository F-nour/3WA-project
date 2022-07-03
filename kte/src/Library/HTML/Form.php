<?php

namespace Library\HTML;

class Form
{
    private $labelClass;

    public function open(string $action, string $method, ?string $class = null): string
    {
        $class = $class ? 'class="' . $class . '"' : '';
        return <<<HTML
            <form action="{$action}" method="{$method}" {$class}>
        HTML;
    }

    public function formGroup(
        ?string $id = null,
        ?string $classGroup = null,
        ?string $ariaLabel = null,
        ?string $ariaLabelId = null,
        mixed $content,
        bool $legend = true
    ): string {
        $id = $id ? 'id="' . $id . '"' : '';
        $label = '';
        if ($legend) {
            $label = <<<html
                <p class="legend">{$ariaLabel}</p>
            html;
        }
        return <<<HTML
            <div {$id} role="group" class="form-group {$classGroup}" {$this->ariaLabel($ariaLabelId)}>
                    {$label}
                    {$content}    
            </div>
        HTML;
    }

    public function input(
        string $field,
        string $label,
        string $type,
        ?string $value,
        bool $required,
        bool $srOnly = false
    ): string {
        $labelClass = $this->getLabelClass($field, $srOnly);
        $inputClass = $this->getInputClass($field);
        return <<<HTML
            <label for="{$field}" class="{$labelClass}">
                {$this->labelVisible($srOnly, $this->labelRequired($required, $label))}
                <input type="{$type}" class="{$inputClass}" id="{$field}" name="{$field}" placeholder="{$label}" {$this->getValue(
            $value
        )} {$this->isInvalid($field)} {$this->getRequired($required)}>
            </label>
            {$this->displayError($field)}
        HTML;
    }

    public function textarea(
        string $field,
        string $label,
        ?string $value,
        bool $required,
        bool $srOnly = false
    ): string {
        $inputClass = $this->getInputClass($field);
        $labelClass = $this->getLabelClass($field, $srOnly);
        return <<<HTML
            <label for="{$field}" class="{$labelClass}">
                {$this->labelVisible($srOnly, $this->labelRequired($required, $label))}
            </label>
            <textarea class="{$inputClass}" id="{$field}" name="{$field}" title="{$label} placeholder="{$label}" class="{$inputClass}" id="{$field}" name="{$field}" placeholder="{$label}"  {$this->isInvalid(
            $field
        )} {$this->getRequired(
            $required
        )}>{$value}</textarea>
            {$this->displayError($field)}
        HTML;
    }

    public function select(
        string $field,
        string $label,
        array $options,
        bool $required,
        bool $srOnly = false
    ): string {
        $labelClass = $this->getLabelClass($field, $srOnly);
        $inputClass = $this->getInputClass($field);
        $optionsHTML = '';
        foreach ($options as $option) {
            $optionsHTML .= <<<HTML
                <option value="{$option}">{$option}</option>
            HTML;
        }
        $select = <<<HTML
                <label for="{$field}" class="{$labelClass}">
                    {$this->labelVisible($srOnly, $this->labelRequired($required, $label))}
                    <select class="{$inputClass}" id="{$field}" name="{$field}" {$this->isInvalid(
            $field
        )} {$this->getRequired($required)}>
                        {$optionsHTML}
                    </select>
                </label>
                {$this->displayError($field)}
        HTML;
        return $this->formGroup(null, null, $field, $select);
    }

    public function checkbox(
        string $field,
        string $label,
        ?string $value,
        bool $required,
        bool $srOnly = false
    ): string {
        $labelClass = $this->getLabelClass($field, $srOnly);
        $inputClass = $this->getInputClass($field);
        return <<<HTML
            <div class="form-check">
                <label for="{$field}" class="{$labelClass}">
                    <input type="checkbox" class="{$inputClass}" id="{$field}" name="{$field}" {$this->getValue(
            $value
        )}  {$this->isInvalid($field)} {$this->getRequired($required)}>
                    {$this->labelVisible($srOnly, $this->labelRequired($required, $label))}
                </label>
            </div>
            {$this->displayError($field)}
        HTML;
    }

    public function radio(
        string $field,
        string $label,
        array $options,
        bool $required,
        bool $srOnly = false
    ): string {
        $labelClass = $this->getLabelClass($field, $srOnly);
        $inputClass = $this->getInputClass($field);
        $optionsHTML = '';
        foreach ($options as $option) {
            $optionsHTML .= <<<HTML
                <label for="{$field}">
                    <input type="radio" class="{$inputClass}" id="{$field}" name="{$field}" value="{$option}" {$this->isInvalid(
                $field
            )} {$this->getRequired(
                $required
            )}>
                    {$this->labelVisible($option)}
                </label>
            HTML;
        }
        $radio = <<<HTML
                <label for="{$field}" class="{$labelClass}">
                    {$this->labelVisibility($srOnly, $this->labelRequired($required, $label))}
                    <div class="form-check">
                        {$optionsHTML}
                    </div>
                </label>
                {$this->displayError($field)}
        HTML;
        return $this->formGroup(null, null, $field, $radio);
    }

    public function submit(string $class, string $value): string
    {
        return <<<HTML
            <button type="submit" class="{$class}">{$value}</button>
        HTML;
    }

    public function reset(string $class, string $value): string
    {
        return <<<HTML
            <button type="reset" class="{$class}">{$value}</button>
        HTML;
    }

    public function button(string $path, string $name, string $class, string $value): string
    {
        $path = url($path);
        return <<<HTML
            <button type="button" name="{$name}" class="{$class}" onclick="window.location.href='{$path}'">{$value}</button>
        HTML;
    }

    public function submitReset(
        string $classSubmit,
        string $valueSubmit,
        string $classReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->reset($classReset, $valueReset)}
            {$this->submit($classSubmit, $valueSubmit)}
        HTML;
    }

    public function submitButton(
        string $classSubmit,
        string $valueSubmit,
        string $name,
        string $path,
        string $classCancel,
        string $valueCancel
    ): string {
        return <<<HTML
            {$this->submit($classSubmit, $valueSubmit)}
            {$this->button($path, $name, $classCancel, $valueCancel)}
        HTML;
    }

    public function allButtons (
        string $classSubmit,
        string $valueSubmit,
        string $name,
        ?string $path,
        string $classCancel,
        string $valueCancel,
        string $classReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->button($path, $name, $classCancel, $valueCancel)}
            {$this->reset($classReset, $valueReset)}
            {$this->submit($classSubmit, $valueSubmit)}
        HTML;
    }

    public function endForm(): string
    {
        return <<<HTML
            </form>
        HTML;
    }

    public function endFormWithSubmitReset(
        string $classSubmit,
        string $valueSubmit,
        string $classReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->formGroup(
            null, 'group-end', 
            'Effacer le formulaire ou Valider',
            null,
            $this->submitReset($classSubmit, $valueSubmit, $classReset, $valueReset)
        , false)}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithSubmitCancel(
        string $classSubmit,
        string $valueSubmit,
        string $path,
        string $classCancel,
        string $valueCancel
    ): string {
        return <<<HTML
            {$this->formGroup(
            null, 'group-end', 
            'Effacer le formulaire ou Valider',
            null,
            $this->submitButton($classSubmit, $valueSubmit, $path, 'cancel', $classCancel, $valueCancel)
        , false)}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithAllButtons(
        string $classSubmit,
        string $valueSubmit,
        string $name,
        string $path,
        string $classCancel,
        string $valueCancel,
        string $classReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->formGroup(
            null, 'group-end',
            'Effacer le formulaire, Annuler votre inscription ou Valider',
            null,
            $this->allButtons($classSubmit, $valueSubmit, $path, 'cancel', $classCancel, $valueCancel, $classReset, $valueReset)
        , false)}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithSubmit(string $classSubmit, string $valueSubmit): string
    {
        return <<<HTML
            {$this->submit($classSubmit, $valueSubmit)}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithReset(string $classReset, string $valueReset): string
    {
        return <<<HTML
            {$this->reset($classReset, $valueReset)}
            {$this->endForm()}
        HTML;
    }

    public function endFormButton(string $class, string $value): string
    {
        return <<<HTML
            {$this->button($class, $value)}
            {$this->endForm()}
        HTML;
    }

    private function ariaLabel(?string $ariaLabel, ?string $arialabelId = null): string
    {
        $description = accessibility()->ariaLabel($ariaLabel, $arialabelId);
        return $description;
    }

    private function displayError(string $field): string
    {
        if (flash()->hasError($field)) {
            return flash()->getError($field);
        }
        return '';
    }

    private function getLabelClass(string $field): string
    {
        $this->labelClass = 'form-label';
        if (!empty($this->displayError($field))) {
            $this->labelClass .= ' text-danger';
        }
        return $this->labelClass;
    }

    private function labelVisible(bool $srOnly, ?string $label): string
    {
        if ($srOnly) {
            return accessibility()->srOnly($label);
        }
        return $label;
    }

    private function getInputClass($field): string
    {
        $inputClass = 'form-control';
        if (!empty($this->displayError($field))) {
            $inputClass .= ' is-invalid';
        }
        return $inputClass;
    }

    private function isInvalid(string $field): string
    {
        if (flash()->hasError($field)) {
            return 'aria-invalid';
        }
        return '';
    }

    private function getValue(?string $value): string
    {
        if ($value === null) {
            return '';
        }
        return <<<html
            value="{$value}" 
        html;
    }

    private function getRequired($required): string
    {
        if ($required) {
            return 'aria-required="true"';
        }
        return '';
    }

    private function labelRequired(bool $required, string $label): string
    {
        if ($required) {
            return $label . '<span class="text-required"> *</span>';
        }
        return $label;
    }
}