<?php

/**
 * @file Actuality.php
 * @namespace App\Model\Table
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $img path to the image
 * @property string $date
 * @property int id_category
 * @const string TITLE_INVALID : invalid title
 * @const string CONTENT_INVALID : invalid content
 */

namespace App\Model\Table;

use DateTime;

class Actualities
{
    private array $errors = [];
    private int $id; // id de l'actualité
    private string $title; // titre de l'actualité
    private string $content; // description de l'actualité
    private ?string $image; // image de l'actualité
    private ?string $titleImage;
    private string $date; // date d'ajout de l'actualité
    private int $id_category; // id de la catégorie de l'actualité

    /**
     * @brief Method to automatically set the data of the actualities table.
     * @method array @hydrate
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
     * @brief Method to create a new actualities.
     * @method array @createDataRow
     * @param array $data
     * @return static
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

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setContent(string $content): void
    {
        $this->content = $content;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    private function getImage(): ?string
    {
        return $this->image;
    }

    private function getTitleImage(): ?string
    {
        return $this->titleImage;
    }

    public function getDate(): DateTime
    {
        return $this->created;
    }
}