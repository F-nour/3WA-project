<?php

namespace Library\HTML;

class Modal
{
    public function modal($field, $title): string {
    return <<<HTML
        <div id="$field-modal" class="popup">
        <div class="popup-content">
            <div class="popup-header">
                <h1 class="center">$title</h1>
            </div>  
        <div class="modal-body">
HTML;
}

public function endModal(): string {
    return <<<HTML
        </div>
        </div>
        </div>
HTML;
}