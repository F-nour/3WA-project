<?php

namespace Library\Validator;

use \Library\Core\AbstractValidator;

class ProductValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function productForm(
        array $data) {
        if (empty($data['name']) || strlen($data['name']) <= 3 || !is_string($data['name'])) {
            $this->errors['name'] = self::TITLE_INVALID;
        }
        if (empty($data['description']) || strlen($data['description']) <= 3 || !is_string($data['description'])) {
            $this->errors['description'] = self::CONTENT_INVALID;
        }
        if (empty($data['price']) || strlen($data['price']) <= 3 || !is_string($data['price'])) {
            $this->errors['price'] = self::PRICE_INVALID;
        }
        if (empty($data['quantity']) || strlen($data['quantity']) <= 3 || !is_string($data['quantity'])) {
            $this->errors['quantity'] = self::QUANTITY_INVALID;
        }
        return $this->errors;
    }
}