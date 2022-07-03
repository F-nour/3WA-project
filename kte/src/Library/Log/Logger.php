<?php

/* Telling PHP that the class Logger is in the namespace Library\Log. */
namespace Library\Log;

class Logger
{
    private $depot; // Dossier où sont enregistrés les fichiers logs
    private $ready; // Le logger est prêt quand le dossier de dépôt des logs existe

    // Granularité
    const GRAN_VOID  = 'VOID';  // Aucun archivage
    const GRAN_MONTH = 'MONTH'; // Archivage mensuel
    const GRAN_YEAR  = 'YEAR';  // Archivage annuel

// Type de log
    const LOG_VOID   = 'VOID';  // Aucun log
    const LOG_ERROR  = 'ERROR'; // Log des erreurs
    const LOG_INFO   = 'INFO';  // Log des informations
    const LOG_DEBUG  = 'DEBUG'; // Log des débogages

    /**
     * @brief Constructor
     * @param string $depot : Directory of the log file.
     * @return void
     */

    public function __construct($path){
        $this->ready = false;

        // Si le dépôt n'existe pas
        if( !is_dir($path) ){
            trigger_error("<code>$path</code> n'existe pas", E_USER_WARNING);
            return false;
        }

        $this->depot = realpath($path);
        $this->ready = true;
        return true;
    }

    public function path($type, $name, $granularity = self::GRAN_YEAR){
        // On vérifie que le logger est prêt (et donc que le dossier de dépôt existe
        if( !$this->ready ){
            trigger_error("Logger is not ready", E_USER_WARNING);
            return false;
        }

        // Contrôle des arguments
        if( !isset($type) || empty($name) ){
            trigger_error("Paramètres incorrects", E_USER_WARNING);
            return false;
        }

        // On construit le nom du fichier de logger
        $filename = $type . '_' . $name . '_' . date('Ymd_H-i-s') . '.log';

        // On construit le chemin du fichier de logger
        $path = $this->depot . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . date('Ymd');

        // Si le dossier n'existe pas, on le crée
        if( !is_dir($path) ){
            mkdir($path, 0777, true);
        } else {
            // Si le dossier existe, on vérifie qu'il est vide
            $files = scandir($path);
            if( count($files) > 10 ){
                // Si le dossier n'est pas vide, on le vide
                foreach( $files as $file ){
                    if( $file != '.' && $file != '..' ){
                        unlink($path . DIRECTORY_SEPARATOR . $file);
                    }
                }
            }

            // On vérifie que le dossier n'est pas trop vieux
            $files = scandir($path);
            if( count($files) > 10 ){
                // Si le dossier n'est pas trop vieux, on le vide
                foreach( $files as $file ){
                    if( $file != '.' && $file != '..' ){
                        unlink($path . DIRECTORY_SEPARATOR . $file);
                    }
                }
            }
    }
}