<?php

namespace App\Model\Table;

class User
{
    const role_id_INVALID = 1;
    const LASTNAME_INVALID = "Nom de famille invalide."; // id de l'utilisateur
    const FIRSTNAME_INVALID = "Prénom invalide."; // role_id de l'utilisateur
    const SERVICE_INVALID = "Service invalide."; // nom de la société
    const ADRESS_INVALID = "Adresse invalide."; // nom de famille
    const ZIP_INVALID = "Code postal invalide."; // prénom
    const CITY_INVALID = "Ville invalide."; // numéro de téléphone
    const EMAIL_INVALID = "Email invalide."; // service
    const PASSWORD_INVALID = "Mot de passe invalide."; // adresse
    private array $errors = []; // erreurs
    private int $id; // code postal
    private int $role_id; // ville
    private string $society; // email
    private string $lastname; // mot de passe
    private string $firstname;
    private string $service;
    private string $adress;
    private string $complement;
    private int $zip;
    private string $city;
    private string $email;
    private string $password;

    public function createDataRow(array $data): void
    {
        $this->hydrate($data);
    }

    private function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // setters

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    private function setRole_id(int $role_id): void
    {
        if (empty($role_id)) {
            $this->errors[] = self::role_id_INVALID;
        } else {
            $this->role_id = $role_id;
        }
    }

    private function setSociety(string $society): void
    {
        $this->society = $society;
    }

    private function setLastname(string $lastname): void
    {
        if (empty($lastname) || strlen($lastname) < 3 || strlen($lastname) > 50 || !is_string($lastname)) {
            $this->errors .= self::LASTNAME_INVALID;
        } else {
            $this->lastname = $lastname;
        }
    }

    private function setFirstname(string $firstname): void
    {
        if (empty($firstname) || strlen($firstname) < 3 || strlen($firstname) > 50 || !is_string($firstname)) {
            $this->errors .= self::FIRSTNAME_INVALID;
        } else {
            $this->firstname = $firstname;
        }
    }

    private function setService(string $service): void
    {
        $this->service = $service;
    }

    private function setAdress(string $adress): void
    {
        if (empty($adress) || strlen($adress) < 3 || strlen($adress) > 50 || !is_string($adress)) {
            $this->errors .= self::ADRESS_INVALID;
        } else {
            $this->adress = $adress;
        }
    }

    private function setcomplement(string $complement): void
    {
        $this->complement = $complement;
    }

    private function setZip(int $zip): void
    {
        if (empty($zip) || strlen($zip) != 5 || !is_numeric($zip)) {
            $this->errors .= self::ZIP_INVALID;
        } else {
            $this->zip = $zip;
        }
    }

    private function setCity(string $city): void
    {
        if (empty($city) || strlen($city) < 3 || strlen($city) > 50 || !is_string($city)) {
            $this->errors .= self::CITY_INVALID;
        } else {
            $this->city = $city;
        }
    }

    private function setEmail(string $email): void
    {
        if (empty($email) || strlen($email) < 3 || strlen($email) > 50 || !is_string($email) || !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )) {
            $this->errors .= self::EMAIL_INVALID;
        } else {
            $this->email = $email;
        }
    }

    private function setPassword(string $password): void
    {
        if (empty($password) || strlen($password) < 8 || !is_string($password)) {
            $this->errors[] = self::PASSWORD_INVALID;
        } else {
            $this->password = $password;
        }
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getrole_id(): int
    {
        return $this->role_id;
    }

    public function getSociety(): string
    {
        return $this->society;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function getZip(): int
    {
        return $this->zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(string $error): void
    {
        $this->errors[] .= $error;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}