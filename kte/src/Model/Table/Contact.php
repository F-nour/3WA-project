<?php

namespace App\Model\Table;

use DateTime;

class Contact
{
    public const NAME_INVALID = "Le nom n'est pas valide.";
    public const EMAIL_INVALID = "L'email n'est pas valide.";
    public const MESSAGE_INVALID = "Le message n'est pas valide.";

    private array $errors = [];
    private int $id; // id du contact
    private string $name; // nom du contact
    private string $email; // email du contact
    private string $message; // message du contact
    private DateTime $created; // date d'ajout du contact

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

    private function setName(string $name): void
    {
        if (empty($name)) {
            $this->errors[] = self::NAME_INVALID;
        }
        $this->name = $name;
    }

    private function setEmail(string $email): void
    {
        if (empty($email)) {
            $this->errors[] = self::EMAIL_INVALID;
        }
        $this->email = $email;
    }

    private function setMessage(string $message): void
    {
        if (empty($message)) {
            $this->errors[] = self::MESSAGE_INVALID;
        }
        $this->message = $message;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreated(): DateTime
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