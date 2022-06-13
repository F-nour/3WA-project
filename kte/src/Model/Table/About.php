<?php

namespace App\Model\Table;

class About
{
    private array $errors = [];
    private string $society; // Nom de la société
    private string $INSEE; // Numéro INSEE
    private int $zip; // Code postal
    private string $city; // Ville
    private string $phone; // Téléphone
    private string $mail; // Email

    const INVALID_SOCIETY = "Nom de la société invalide.";
    const INVALID_INSEE = "Numéro INSEE invalide.";
    const INVALID_ZIP = "Code postal invalide.";
    const INVALID_CITY = "Ville invalide.";
    const INVALID_PHONE = "Téléphone invalide.";
    const INVALID_MAIL = "Email invalide.";

    private function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public static function createDataRow(array $data): self
    {
        $product = new self();
        $product->hydrate($data);
        return $product;
    }

    // setters

    private function setSociety(string $society)
    {
        if (empty($society)) {
            $this->addError(self::INVALID_SOCIETY);
        } else {
            $this->society = $society;
        }
    }

    private function setINSEE(string $INSEE)
    {
        if (empty($INSEE) || strlen($INSEE) != 5 || !is_numeric($INSEE)) {
            $this->addError(self::INVALID_INSEE);
        } else {
            $this->INSEE = $INSEE;
        }
    }

    private function setZip(int $zip)
    {
        if (empty($zip) || strlen($zip) != 5 || !is_numeric($zip)) {
            $this->addError(self::INVALID_ZIP);
        } else {
            $this->zip = $zip;
        }
    }

    private function setCity(string $city)
    {
        if (empty($city) || strlen($city) < 3 || strlen($city) > 50 || !is_string($city) ) {
            $this->addError(self::INVALID_CITY);
        } else {
            $this->city = $city;
        }
    }

    private function setPhone(string $phone)
    {
        if (empty($phone) || !is_numeric($phone)) {
            $this->addError(self::INVALID_PHONE);
        } else {
            $this->phone = $phone;
        }
    }

    private function setMail(string $mail)
    {
        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->addError(self::INVALID_MAIL);
        } else {
            $this->mail = $mail;
        }
    }

    // getters

    public function getSociety(): string
    {
        return $this->society;
    }

    public function getINSEE(): string
    {
        return $this->INSEE;
    }

    public function getZip(): int
    {
        return $this->zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    // addError

    private function addError(int $error)
    {
        $this->errors[] = $error;
    }

    // Validation

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}