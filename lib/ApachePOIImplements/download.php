<?php
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=estructura_clientes.xlsx');
header('Pragma: no-cache');
readfile("estructura_clientes.xlsx");
?>