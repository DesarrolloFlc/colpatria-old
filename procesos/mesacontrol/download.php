<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=estructura_cargue.csv');
header('Pragma: no-cache');
readfile('estructura_cargue.csv');
?>