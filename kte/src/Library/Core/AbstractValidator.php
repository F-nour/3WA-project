<?php

namespace Library\Core;

abstract class AbstractValidator
{
    protected $errors = [];

    const LASTNAME_INVALID = "Nom de famille invalide."; // id de l'utilisateur
    const FIRSTNAME_INVALID = "Prénom invalide."; // role_id de l'utilisateur
    const ADRESS_INVALID = "Adresse invalide."; // nom de famille
    const ZIP_INVALID = "Code postal invalide."; // prénom
    const CITY_INVALID = "Ville invalide."; // numéro de téléphone
    const EMAIL_INVALID = "Email invalide."; // service
    const PASSWORD_INVALID = "Mot de passe invalide."; // adresse
    const PASSWORD_CONFIRM_INVALID = "Les deux champs doivent contenir les mêmes caractères.";
    const NEW_PASSWORD_INVALID = "Le nouveau mot de passe est invalide.";
    const TITLE_INVALID = "Titre invalide."; // complément
    const CONTENT_INVALID = "Contenu invalide."; // code postal
    const PRICE_INVALID = "Prix invalide."; // ville
    const QUANTITY_INVALID = "Quantité invalide."; // mot de passe

    /**
     * @brief Constructor.
     * @return bool true if the form is valid, false otherwise.
     */
    public function isValid(): bool
    {
        if (count($this->errors) > 0) {
            return false;
        } else {
            return true;
        }
    }
}