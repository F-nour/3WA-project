<?php

namespace App\Model\Table;

class User
{
    private array $errors = []; // erreurs
    private int $id; // code postal
    public int $role_id; // ville
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
        $this->role_id = $role_id;
    }

    private function setSociety(string $society): void
    {
        $this->society = $society;
    }

    private function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    private function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    private function setService(string $service): void
    {
        $this->service = $service;
    }

    private function setAdress(string $adress): void
    {
        $this->adress = $adress;
    }

    private function setcomplement(string $complement): void
    {
        $this->complement = $complement;
    }

    private function setZip(int $zip): void
    {
        $this->zip = $zip;
    }

    private function setCity(string $city): void
    {
        $this->city = $city;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setPassword(string $password): void
    {
        $this->password = $password;
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
}