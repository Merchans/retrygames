<?php
$databaze = 'ete34e_2021ls_09';
$uzivatel = 'ete34e_2021ls_09';
$heslo = '0dTvOh';

if (!($cnn = mysqli_connect('localhost', $uzivatel, $heslo)))
	die('Nepodarilo se pripojit k databazovemu serveru.');
if (!mysqli_select_db($cnn, $databaze))
	die('Nepodarilo se otevrit databazi.');

echo 'Pripojeni k databazi bylo uspesne.';
