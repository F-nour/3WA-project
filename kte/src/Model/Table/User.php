<?php

namespace App\Model\Table;

class User
{
    private array $errors = [];
    private int $id; // id de l'utilisateur
    private int $role; // role de l'utilisateur
    private string $society; // nom de la société
    private string $INSEE; // numéro INSEE de la société
    private string $lastname; // nom de famille
    private string $firstname; // prénom
    private int $tel; // numéro de téléphone
    private string $service; // service
    private string $adress; // adresse
    private string $conplement; // complément d'adresse
    private int $zip; // code postal
    private string $city; // ville
    private string $email; // email
    private string $password; // mot de passe

    const ROLE_INVALID = 1;

    const LASTNAME_INVALID = "Nom de famille invalide.";
    const FIRSTNAME_INVALID = "Prénom invalide.";
    const TEL_INVALID = "Numéro de téléphone invalide.";
    const SERVICE_INVALID = "Service invalide.";
    const ADRESS_INVALID = "Adresse invalide.";
    const ZIP_INVALID = "Code postal invalide.";
    const CITY_INVALID = "Ville invalide.";
    const EMAIL_INVALID = "Email invalide.";
    const PASSWORD_INVALID = "Mot de passe invalide.";

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

    private function setRole(int $role)
    {
        if (empty($role)) {
            $this->addError(self::ROLE_INVALID);
        } else {
            $this->role = $role;
        }
    }

    private function setSociety(string $society)
    {
        if (empty($society)) {
            $this->addError(self::LASTNAME_INVALID);
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

    private function setLastname(string $lastname)
    {
        if (empty($lastname) || strlen($lastname) < 3 || strlen($lastname) > 50 || !is_string($lastname) ) {
            $this->addError(self::LASTNAME_INVALID);
        } else {
            $this->lastname = $lastname;
        }
    }

    private function setFirstname(string $firstname)
    {
        if (empty($firstname) || strlen($firstname) < 3 || strlen($firstname) > 50 || !is_string($firstname) ) {
            $this->addError(self::FIRSTNAME_INVALID);
        } else {
            $this->firstname = $firstname;
        }
    }

    private function setTel(int $tel)
    {
        if (empty($tel) || strlen($tel) != 10 || !is_numeric($tel)) {
            $this->addError(self::TEL_INVALID);
        } else {
            $this->tel = $tel;
        }
    }

    private function setService(string $service)
    {
        if (empty($service) || strlen($service) < 3 || strlen($service) > 50 || !is_string($service) ) {
            $this->addError(self::SERVICE_INVALID);
        } else {
            $this->service = $service;
        }
    }

    private function setAdress(string $adress)
    {
        if (empty($adress) || strlen($adress) < 3 || strlen($adress) > 50 || !is_string($adress) ) {
            $this->addError(self::ADRESS_INVALID);
        } else {
            $this->adress = $adress;
        }
    }

    private function setConplement(string $conplement)
    {
        if (empty($conplement) || strlen($conplement) < 3 || strlen($conplement) > 50 || !is_string($conplement) ) {
            $this->addError(self::CONPLEMENT_INVALID);
        } else {
            $this->conplement = $conplement;
        }
    }

    private function setZip(int $zip)
    {
        if (empty($zip) || strlen($zip) != 5 || !is_numeric($zip)) {
            $this->addError(self::ZIP_INVALID);
        } else {
            $this->zip = $zip;
        }
    }

    private function setCity(string $city)
    {
        if (empty($city) || strlen($city) < 3 || strlen($city) > 50 || !is_string($city) ) {
            $this->addError(self::CITY_INVALID);
        } else {
            $this->city = $city;
        }
    }

    private function setEmail(string $email)
    {
        if (empty($email) || strlen($email) < 3 || strlen($email) > 50 || !is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError(self::EMAIL_INVALID);
        } else {
            $this->email = $email;
        }
    }

    private function setPassword(string $password)
    {
        if (empty($password) || strlen($password) < 8 || strlen($password) > 50 || !is_string($password) ) {
            $this->addError(self::PASSWORD_INVALID);
        } else {
            $this->password = $password;
        }
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function getSociety(): string
    {
        return $this->society;
    }

    public function getINSEE(): string
    {
        return $this->INSEE;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getTel(): int
    {
        return $this->tel;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getAdress(): string
    {
        return $this->adress;
    }

    public function getConplement(): string
    {
        return $this->conplement;
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

    // validation

    public function addError(string $error)
    {
        $this->errors[] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}