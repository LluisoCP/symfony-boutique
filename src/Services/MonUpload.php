<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class MonUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }


    public function upload(UploadedFile $file)

    {

        //on crée un nom de fichier sécurisé
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        //on déplace le fichier dans le répertoire
        $file->move($this->targetDir, $fileName);
        //on retourne le nom du fichier 
        return $fileName;
    }

    public function getTargetDir()

    {
        return $this->targetDir;
    }
}
