<?php

namespace App\Services;

class Constant
{
    public const TEMPLATE_PATH_PR = 'docs/pr_template.docx';
    public const TEMPLATE_PATH_NOA = 'docs/noa.docx';
    public const TEMPLATE_PATH_NTP = 'docs/ntp.docx';
    public const TEMPLATE_PATH_PO = 'docs/po_template.docx';
    public const TEMPLATE_PATH_RFQ = 'docs/RFQ.xlsx';
    public const TEMPLATE_PATH_CANVASS = 'docs/SK-canvass.xlsx';
    public const TEMPLATE_PATH_SKCC = 'docs/skcc-voucher.docx';


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
