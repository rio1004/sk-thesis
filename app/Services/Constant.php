<?php

namespace App\Services;

class Constant
{

    public static function getBarangays()
    {
        return [
            'Barangay Poblacion I',
            'Barangay Poblacion II',
            'Barangay Poblacion III',
            'Barangay Poblacion IV',
            'La Esperanza',
            'Peñafrancia',
            'Salvacion',
            'San Antonio',
            'San Bartolome',
            'San Eugenio',
            'San Isidro',
            'San Rafael',
            'San Roque',
            'San Sebastian',
        ];
    }

    public static function getPositions()
    {
        return [
            'Brgy-Chairman',
            'Brgy-Secretary',
            'Brgy-Treasurer',
            'Brgy-Kagawad',
            'Sk-Chairperson',
            'Sk-Secretary',
            'Sk-Treasurer',
            'Sk-Kagawad',
        ];
    }

    public static function getOtherPositions(){
        return[
            'Appropriation',
            'BAC Chairman',
            'Vice BAC Chairman',
            'BMO',
        ];
    }


}
