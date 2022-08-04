<?php

namespace App\Model\Table;

use DateTime;

class Ordered
{
    private array $errors = [];
    private int $id; // id de la commande
    private int $id_user; // id du client
    private int $id_product; // id du produit
    private int $quantity; // quantité commandée
    private int $price; // prix total de la commande
    private DateTime $created; // date d'ajout de la commande
    private DateTime $updated; // date de modification de la commande
    private int $status; // validation de la commande

    const ID_USER_INVALID = "L'utilisateur sélectionné n'est pas reconnu.";
    const ID_PRODUCT_INVALID = "Le produit sélectionné n'est pas reconnu.";
    const QUANTITY_INVALID = "La quantité commandée doit être supérieure ou égal à 1.";
    const PRODUCT_PRICE_INVALID = "Le prix total de la commande doit être supérieur à 0 euros.";
    const STATUS_INVALID = "Le statut de la commande n'est pas valide.";

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


    private function setId_user(int $id_user): void
    {
        if (empty($id_user)) {
            $this->errors[] = self::ID_USER_INVALID;
        }
        $this->id_user = $id_user;
    }

    private function setId_product(int $id_product): void
    {
        if (empty($id_product)) {
            $this->errors[] = self::ID_PRODUCT_INVALID;
        }
        $this->id_product = $id_product;
    }

    private function setQuantity(int $quantity): void
    {
        if (empty($quantity)) {
            $this->errors[] = self::QUANTITY_INVALID;
        }
        $this->quantity = $quantity;
    }

    private function setPrice(int $price): void
    {
        if (empty($price)) {
            $this->errors[] = self::PRICE_INVALID;
        }
        $this->price = $price;
    }

    private function setstatus(int $status): void
    {
        if (empty($status)) {
            $this->errors[] = self::STATUS_INVALID;
        }
        $this->status = $status;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getIdProduct(): int
    {
        return $this->id_product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    public function getstatus(): int
    {
        return $this->status;
    }
}
