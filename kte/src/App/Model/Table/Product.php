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
    private ?int $price_halfday; // prix à la demi-journée
    private ?int $price_day; // prix à la journée
    private ?int $traveling_region; // Frais de déplacement à l'intérieur de la métropole
    private ?int $traveling_country; // Frais de déplacement à l'extérieur de la métropole
    private ?string $image; // image file
    private ?string $titleImage;


    public const PRODUCT_TITLE_INVALID = "Le titre du produit n'est pas valide.";
    public const PRODUCT_CONTENT_INVALID = "Le contenu du produit n'est pas valide.";
    public const PRODUCT_PRICE_INVALID = "Le prix du produit n'est pas valide.";
    public const PRODUCT_iMAGE_INVALID = "L'image du produit n'est pas valide.";

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

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setContent(string $content): void
    {
        $this->content = $content;
    }

    private function setPrice_halfday(int $price_halfday): void
    {
        $this->price_halfday = $price_halfday;
    }

    private function setPrice_day(int $price_day): void
    {
        $this->price_day = $price_day;
    }

    private function setTraveling_region(int $traveling_region): void
    {
        $this->traveling_region = $traveling_region;
    }

    private function setTraveling_country(int $traveling_country): void
    {
        $this->traveling_country = $traveling_country;
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

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTitleImage(): string
    {
        return $this->titleImage;
    }
}