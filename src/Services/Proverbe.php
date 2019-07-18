<?php

namespace App\Services;

class Proverbe {

    public static function getMessage()
    {

        $proverbes = [
            'Tout vient à point à qui sait attendre (Rabelais)',
            'Il faut cultiver notre jardin (Voltaire)',
            'Rien ne sert de courir il faut partir à point (La Fontaine)',
            'Tout corps plongé dans l\'eau est mouillé (Archimède)',
            'Dans la vie il y a 3 sortes de gens: Ceux qui savent compter et les autres (A. Einstein)',
            'La théorie, c\'est quand on sait tout et que rien ne fonctionne. La pratique c\'est quand tout fonctionne et que personne ne sait pourquoi. Ici nous avons réuni les deux: rien ne fonctionne et personne ne sait pourquoi (A. Einstein)'
        ];
        return $proverbes[array_rand($proverbes)];
    }


}