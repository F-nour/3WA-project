<?php

/**
 * @brief file for the About class to get and set data of about table.
 * @file About.php
 * @namespace App\Model\Table
 * @property string $status
 * @property string $society
 * @property int INSEE
 * @property int $zip
 * @property string $city
 * @property string phone
 * @property string $mail
 * @property string $image path to the image
 * @property array $errors array of errors
 * @const string INVALID_STATUS : invalid status
 * @const string INVALID_SOCIETY : invalid society
 * @const string INVALID_INSEE : invalid INSEE
 * @const string INVALID_ZIP : invalid zip
 * @const string INVALID_CITY : invalid city
 * @const string INVALID_PHONE : invalid phone
 * @const string INVALID_MAIL : invalid mail
 * @const string INVALID_IMAGE : invalid image
 */

namespace App\Model\Table;

class About
{
    private int $id;
    private string $society; // Nom de la société
    private string $INSEE; // Numéro INSEE
    private int $zip; // Code postal
    private string $city; // Ville
    private string $phone; // Téléphone
    private string $mail; // Email
    private ?string $image; // Photo
    private ?string $titleImage;

    /**
     * @brief Method to automatically set the data of the about table.
     * @method hydrate
     * @param array $data
     * @return void
     */
    private function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @brief Method to create row in the about table.
     * @method void createDataRow
     * @param array $data
     * @return self
     */
    public static function createDataRow(array $data): self
    {
        $product = new self();
        $product->hydrate($data);
        return $product;
    }

    // setters

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    private function setSociety(string $society): void
    {
        $this->society = $society;
    }

    private function setINSEE(string $INSEE): void
    {
        $this->INSEE = $INSEE;
    }

    private function setZip(int $zip): void
    {
        $this->zip = $zip;
    }

    private function setCity(string $city): void
    {
        $this->city = $city;
    }

    private function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    private function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    private function setImage(string $image): void
    {
        $this->image = $image;
    }

    private function setTitleImage(string $titleImage): void
    {
        $this->titleImage = $titleImage;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getSociety(): string
    {
        return $this->society;
    }

    public function getstatus(): string
    {
        return $this->status;
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

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTitleImage(): string
    {
        return $this->titleImage;
    }
}