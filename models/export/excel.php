<?php

require "../../config/connection.php";
include "functions.php";

    $korisnici = getUsers();
    $excel = new COM("Excel.Application");
    $excel->DisplayAlerts = 1;
    $workbook = $excel->Workbooks->Add();
    $sheet = $workbook->Worksheets('Sheet1');
    $sheet->activate;
    $br = 1;
    foreach ($korisnici as $korisnik) {

        $polje = $sheet->Range("A{$br}");
        $polje->activate;
        $polje->value = $korisnik->user_id;

        $polje = $sheet->Range("B{$br}");
        $polje->activate;
        $polje->value = $korisnik->first_name;

        $polje = $sheet->Range("C{$br}");
        $polje->activate;
        $polje->value = $korisnik->last_name;

        $polje = $sheet->Range("D{$br}");
        $polje->activate;
        $polje->value = $korisnik->role;
        $br++;

    }

$polje = $sheet->Range("E{$br}");
$polje->activate;
$polje->value = count($korisnici);
$workbook->_SaveAs("Korisnici.xlsx", -4143);
$workbook->Save();