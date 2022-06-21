<?php

namespace App\Model\Table;

// class des produits
use DateTime;

class Product
{
    private array $errors = [];
    private int $id; // id du produit
    private string $title; // Titre du produit
    private string $content; // description du produit
    private DateTime $created; // date d'ajout du produit
    private DateTime $updated; // date de modification du produit

    // propriétés NULL par défault
    private int $price_halfday; // prix à la demi-journée
    private int $price_day; // prix à la journée
    private int $traveling_region; // Frais de déplacement à l'intérieur de la métropole
    private int $traveling_country; // Frais de déplacement à l'extérieur de la métropole
    private string $img; // image file


    public const TITLE_INVALID = "Le titre du produit n'est pas valide.";
    public const CONTENT_INVALID = "Le contenu du produit n'est pas valide.";
    public const PRICE_INVALID = "Le prix du produit n'est pas valide.";
    public const IMG_INVALID = "L'image du produit n'est pas valide.";

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

    private function setTitle(string $title)
    {
        if (!empty($title)) {
            $this->title = $title;
        } else {
            $this->errors[] = self::TITLE_INVALID;
        }
    }

    private function setContent(string $content)
    {
        if (!empty($content)) {
            $this->content = $content;
        } else {
            $this->errors[] = self::CONTENT_INVALID;
        }
    }

    private function setPrice_halfday(int $price_halfday)
    {
        if (!empty($price_halfday)) {
            $this->price_halfday = $price_halfday;
        } else {
            $this->errors[] = self::PRICE_INVALID;
        }
    }

    private function setPrice_day(int $price_day)
    {
        if (!empty($price_day)) {
            $this->price_day = $price_day;
        } else {
            $this->errors[] = self::PRICE_INVALID;
        }
    }

    private function setTraveling_region(int $traveling_region)
    {
        if (!empty($traveling_region)) {
            $this->traveling_region = $traveling_region;
        } else {
            $this->errors[] = self::PRICE_INVALID;
        }
    }

    private function setTraveling_country(int $traveling_country)
    {
        if (!empty($traveling_country)) {
            $this->traveling_country = $traveling_country;
        } else {
            $this->errors[] = self::PRICE_INVALID;
        }
    }

    private function setImg(string $img)
    {
        if (!empty($img)) {
            $this->img = $img;
        } else {
            $this->errors[] = self::IMG_INVALID;
        }
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

    public function getPrice_halfday(): int
    {
        return $this->price_halfday;
    }

    public function getPrice_day(): int
    {
        return $this->price_day;
    }

    public function getTraveling_region(): int
    {
        return $this->traveling_region;
    }

    public function getTraveling_country(): int
    {
        return $this->traveling_country;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    // validation

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}