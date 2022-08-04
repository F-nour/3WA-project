<?php

namespace Library\HTML;

class Form
{

    // form building

    /**
     * @brief build a form
     * @param string $action
     * @param string $method
     * @param ?string $id
     * @return string
     */
    public function openForm(string $action, string $method, ?string $id = null, ?string $classes = null): string
    {
        return <<<HTML
            <form {$this->getId($id)} method="$method" action="$action" class="form $classes">
        HTML;
    }

    /**
     * @brief create a group of inputs or selects
     * @param ?string $id
     * @param ?string $classes
     * @param ?string $ariaLabel
     * @param ?string $arialLabeledBy
     * @param mixed $content
     * @param bool $legend
     * @return string
     */
    public function formGroup(
        ?string $id,
        ?string $classes,
        ?string $ariaLabel,
        ?string $arialLabeledBy,
        mixed $content,
        bool $legend = true
    ): string {
        if ($arialLabeledBy === null) {
            $legend = false;
        }
        $label = '';
        if ($legend) {
            $label = <<<html
            <div class="legend">
                <legend id="$arialLabeledBy">
                    $ariaLabel
                </legend>
            </div>
            html;
        }
        return <<<HTML
            <div {$this->getId($id)}
            role="group"
            class="form-group $classes"
            {$this->ariaLabel($legend, $ariaLabel, $arialLabeledBy)}>
                $label
                $content
            </div>
        HTML;
    }

    private function getIcons($field)
    {
        switch ($field) {
            case 'firstname':
            case 'lastname':
            case 'name':
                return 'btn-name';
            case 'society':
            case 'status':
            case 'INSEE':
                return 'btn-society';
            case 'service':
                return 'btn-service';
            case 'phone':
                return 'btn-phone';
            case 'address':
            case 'complement':
                return 'btn-address';
            case 'zip':
            case 'city':
                return 'btn-city';
            case 'email':
                return 'btn-email';
            case 'password':
            case 'password_confirm':
            case 'actual_password':
            case 'new_password':
            case 'new_password_confirm':
                return 'btn-password';
            case 'title':
                return 'btn-title';
            case 'content':
                return 'btn-description';
            default:
                return '';
        }
    }

    /**
     * @brief create an input with label
     * @param string $field
     * @param string $label
     * @param string $type
     * @param string|null $autocomplete
     * @param ?string $value
     * @param bool $required
     * param bool $srOnly
     * @param bool $srOnly
     * @return string
     */
    public function input(
        string $field,
        string $label,
        string $type,
        ?string $autocomplete = null,
        ?string $value = null,
        bool $required = true,
        bool $srOnly = true
    ): string {
        return <<<HTML
            <div class="input-container">
                <label for="$field" class="{$this->getLabelClasses($field)}">
                    {$this->labelVisible($srOnly, $this->labelRequired($required, $label))}
                </label>
                <div class="input-content {$this->getIcons($field)}">
                    <input type="$type"
                        class="{$this->getInputClasses($field)}"
                        id="$field"
                        name="$field"
                        placeholder="{$this->placeHolderRequired($required, $label)}"
                        {$this->autocomplete($autocomplete)}
                        {$this->getValue($value)}
                        {$this->isInvalid($field)}
                        {$this->getRequired($required)} />
                    {$this->displayError($field)}
                </div>
            </div>
        HTML;
    }

    private function getChoices(
        string $type,
        string $field,
        string $id,
        array $values,
        bool $srOnly = false,
        ?string $direction
    ): string {
        if ($srOnly) {
            $direction = null;
        } else {
            $direction = 'check-' . $direction;
        }
        $options = '';
        $i = 0;
        foreach ($values as $value) {
            $i++;
            $options .= <<<HTML
                <div class="check-container $direction">
                    <label for="$id-$i">
                        {$this->labelVisible($srOnly, $value)}
                    </label>
                    <input type="$type"
                        class="{$this->getInputClasses($field)}"
                        id="$id"
                        name="$field"
                        value="$value"
                        {$this->isInvalid($field)}>
                </div>
                HTML;
        }
        return $options;
    }

    public function checkbox(
        string $id,
        string $field,
        string $legend,
        string $arialLabeledBy,
        array $options,
        bool $required,
        bool $srOnly = false,
        ?string $direction
    ): string {
        return <<<HTML
            {$this->formGroup(
            $id,
            'form-check' . $this->getLabelClasses($field),
            $this->labelRequired($required, $legend),
            $arialLabeledBy,
            $this->getChoices('checkbox', $field, $id, $options, $srOnly, $direction),
        )}
        HTML;
    }

    public function radio(
        string $id,
        string $field,
        string $legend,
        string $arialLabeledBy,
        array $options,
        bool $required,
        bool $srOnly = false,
        ?string $direction
    ): string {
        return <<<HTML
            {$this->formGroup(
            $id,
            'form-check' . $this->getLabelClasses($field),
            $this->labelRequired($required, $legend),
            $arialLabeledBy,
            $this->getChoices('radio', $field, $id, $options, $srOnly, $direction),
        )}
        HTML;
    }

    private function getOptions(array $values): string
    {
        $options = '';
        foreach ($values as $value) {
            $options .= <<<HTML
                <option value="$value">
                    $value
                </option>
            HTML;
        }
        return $options;
    }

    public function select(
        ?string $id,
        ?string $classes,
        string $field,
        string $label,
        array $options,
        bool $required,
        bool $srOnly = false
    ): string {
        $infos = '';
        if ($required) {
            $infos .= <<<HTML
                <span class="{$this->getInputClasses($field)}"></span>
            HTML;
        }
        return <<<HTML
            {$this->formGroup(
            $this->getId($id),
            'form-select',
            $this->labelRequired($required, $label),
            null,
            <<<HTML
                    <label for="$field">
                        {$this->labelRequired(
                $required,
                $this->labelVisible($srOnly, $label)
                    )}
                    </label>
                    <div class="select-container">
                        <select class="{$this->getInputClasses($classes)}"
                            id="$field"
                            name="$field"
                            {$this->isInvalid($field)}
                            {$this->getRequired($required)}>
                            <option value="$label">
                                ---$label---
                            </option>
                            {$this->getOptions($options)}
                        </select>
                        $infos
                    </div>
                HTML,
                false)}
        HTML;
    }

    private function submit(?string $classes, string $value): string
    {
        return <<<HTML
            <button type="submit" class="btn btn-success $classes">
                $value
            </button>
        HTML;
    }

    private function reset(?string $classes, string $value): string
    {
        return <<<HTML
            <button type="reset" class="btn btn-reset $classes">
                $value
            </button>
        HTML;
    }

    public function onclick(string $name, string $path, ?string $classes, string $value, bool $srOnly = false): string
    {
        $path = url($path);
        return <<<HTML
            <button type="button"
            name="$name"
            class="btn {$this->getButtonClasses($srOnly, $classes)}"
            onclick="window.location.href='$path'">
                {$this->valueVible($srOnly, $value)}
            </button>
        HTML;
    }

    public function button(
        ?string $classes,
        ?string $name,
        ?string $dataToggle,
        ?string $dataTarget,
        string $value,
        bool $srOnly = false
    ): string {
        if ($dataTarget) {
            $dataTarget = 'data-target="#' . $dataTarget . '"';
        }
        if ($dataToggle) {
            $dataToggle = 'data-toggle="' . $dataToggle . '"';
        }
        return <<<HTML
            <button id="$name" type="button" class="btn {$this->getButtonClasses($srOnly, $classes)}" name="$name" $dataToggle $dataTarget>
                {$this->valueVible($srOnly, $value)}
            </button>
        HTML;
    }

    private function submitReset(
        ?string $classesSubmit,
        string $valueSubmit,
        ?string $classesReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->reset($classesReset, $valueReset)}
            {$this->submit($classesSubmit, $valueSubmit)}
        HTML;
    }

    private function submitCancel(
        ?string $classesSubmit,
        string $valueSubmit,
        ?string $classesCancel,
        string $path,
        string $valueCancel
    ): string {
        return <<<HTML
            {$this->onclick('cancel', $path, 'btn-cancel ' . $classesCancel, $valueCancel, false)}
            {$this->submit($classesSubmit, $valueSubmit)}
        HTML;
    }

    private function allButtons(
        ?string $classesSubmit,
        string $valueSubmit,
        ?string $classesCancel,
        string $path,
        string $valueCancel,
        ?string $classesReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->onclick('cancel', $path, 'btn-cancel ' . $classesCancel, $valueCancel, false)}
            {$this->reset($classesReset, $valueReset)}
            {$this->submit($classesSubmit, $valueSubmit)}
        HTML;
    }

    private function endForm(): string
    {
        return <<<HTML
            </form>
        HTML;
    }

    public function endFormWithSubmit(?string $id, string $classesSubmit, string $valueSubmit): string
    {
        return <<<HTML
            {$this->infos()}
            {$this->formGroup(
            $id,
            'group-end',
            'Valider le formulaire',
            null,
            $this->submit($classesSubmit, $valueSubmit)
        )}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithSubmitReset(
        ?string $id,
        ?string $classesSubmit,
        string $valueSubmit,
        ?string $classesReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->infos()}
            {$this->formGroup(
            $id,
            'group-end',
            'Effacer le formulaire ou valider',
            null,
            $this->submitReset($classesSubmit, $valueSubmit, $classesReset, $valueReset)
            ,
            false
        )}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithSubmitCancel(
        ?string $id,
        ?string $classesSubmit,
        string $valueSubmit,
        ?string $classesCancel,
        string $path,
        string $valueCancel
    ): string {
        return <<<HTML
            {$this->infos()}
            {$this->formGroup(
            $id,
            'group-end',
            'Valider ou annuler le formulaire',
            null,
            $this->submitCancel($classesSubmit, $valueSubmit, $classesCancel, $path, $valueCancel),
            false
        )}
            {$this->endForm()}
        HTML;
    }

    public function endFormWithAllButtons(
        ?string $id,
        ?string $classesSubmit,
        string $valueSubmit,
        string $path,
        ?string $classesCancel,
        string $valueCancel,
        ?string $classesReset,
        string $valueReset
    ): string {
        return <<<HTML
            {$this->infos()}
            {$this->formGroup(
            $id,
            'group-end',
            'Effacer le formulaire, annuler ou valider',
            null,
            $this->allButtons(
                $classesSubmit,
                $valueSubmit,
                $classesCancel,
                $path,
                $valueCancel,
                $classesReset,
                $valueReset
            ),
            false
        )}
            {$this->endForm()}
        HTML;
    }

    private function ariaLabel(bool $description, ?string $ariaLabel, ?string $arialLabeledBy): ?string
    {
        if ($description) {
            return accessibility()->ariaLabel(null, $arialLabeledBy);
        } else {
            return accessibility()->ariaLabel($ariaLabel);
        }
    }

    private function getLabelClasses(string $field): string
    {
        $labelClass = 'form-label';
        if (flash()->hasError($field)) {
            $labelClass .= ' is-invalid';
        }
        return $labelClass;
    }

    private function labelVisible(bool $srOnly, ?string $label): string
    {
        if ($srOnly) {
            return accessibility()->srOnly($label);
        } else {
            return <<<HTML
                <span>$label</span>
            HTML;
        }
    }

    private function getInputClasses($field): string
    {
        $inputClass = 'form-control';
        if (flash()->hasError($field)) {
            $inputClass .= ' is-invalid';
        }
        return $inputClass;
    }

    private function getButtonClasses(bool $srOnly, string $classes): string
    {
        $buttonClasses = $classes;
        if ($srOnly) {
            return $classes . ' btn-sr';
        }
        return $classes;
    }

    private function isInvalid(string $field): string
    {
        if (flash()->hasError($field)) {
            return 'aria-invalid';
        }
        return '';
    }


    private function displayError(string $field): ?string
    {
        if (flash()->hasError($field)) {
            return flash()->getError($field);
        }
        return null;
    }

    private function getId(?string $id): ?string
    {
        return $id ? 'id="' . $id . '"' : '';
    }

    private function getValue(?string $value): string
    {
        if ($value === null) {
            return '';
        }
        return <<<html
            value="$value"
        html;
    }

    private function getRequired(bool $required): string
    {
        if ($required) {
            return 'aria-required="true"';
        }
        return '';
    }

    private function labelRequired(bool $required, string $label): string
    {
        if ($required) {
            return
                '<span>' .
                $label .
                '<span class="text-required"> *</span>
                </span>';
        }
        return $label;
    }

    private function autocomplete(?string $autocomplete): ?string
    {
        if ($autocomplete) {
            return 'autocomplete="' . $autocomplete . '"';
        }
        return '';
    }

    private function placeHolderRequired(bool $required, ?string $placeholder): ?string
    {
        if ($required === true) {
            return $placeholder . '*';
        } else {
            return "$placeholder";
        }
    }

    private function valueVible(bool $srOnly, string $value): string
    {
        if ($srOnly) {
            return accessibility()->srOnly($value);
        } else {
            return $value;
        }
    }

    private function infos(): string
    {
        $classesInfo = 'form-info';
        if (isset($_SESSION['error'])) {
            $classesInfo .= ' text-danger';
        }
        return <<<HTML
            <div class="$classesInfo">
                <p>
                    <span class="text-info">
                        Les champs indiqués d'un
                        <span class="text-required"> * </span>
                        sont obligatoires.
                    </span>
                </p>
            </div>
        HTML;
    }
}