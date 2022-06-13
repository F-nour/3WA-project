<?php

namespace App\Model\Table;

class Actualities
{
    private array $errors = [];
    private int $id; // id de l'actualité
    private string $title; // titre de l'actualité
    private string $content; // description de l'actualité
    private string $img; // image de l'actualité
    private \DateTime $date; // date d'ajout de l'actualité
    private int $id_category; // id de la catégorie de l'actualité

    public const TITLE_INVALID = "Le titre est invalide";
    public const CONTENT_INVALID = "Le contenu est invalide";

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

    public function setImg(string $img)
    {
        if (!empty($img)) {
            $this->img = $img;
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

    public function getImg(): string
    {
        return $this->img;
    }

    public function getDate(): \DateTime
    {
        return $this->created;
    }

    // validation

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}