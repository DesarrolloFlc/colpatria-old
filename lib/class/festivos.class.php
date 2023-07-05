<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class definePascua {

    var $a;
    var $m;
    var $n;

    function __construct($a, $m, $n) {
        $this->a = $a;
        $this->m = $m;
        $this->n = $n;
    }

    function getA() {
        return $this->a % 19;
    }

    function getB() {
        return $this->a % 4;
    }

    function getC() {
        return $this->a % 7;
    }

    function getD() {
        return (19 * $this->getA() + $this->m) % 30;
    }

    function getE() {
        return (2 * $this->getB() + 4 * $this->getC() + 6 * $this->getD() + $this->n) % 7;
    }

    function getDiaResurreccion() {
        return ($this->getD() + $this->getE()) - 9;
    }

    function getDiaMesResurreccion() {
        if ($this->getDiaResurreccion() > 0) {
            return array("mes" => "04", "dia" => $this->getDiaResurreccion());
        } else {
            switch ($this->getDiaResurreccion()) {
                case 0: {
                        return array("mes" => "03", "dia" => 31);
                        break;
                    }
                case -1: {
                        return array("mes" => "03", "dia" => 30);
                        break;
                    }
                case -2: {
                        return array("mes" => "03", "dia" => 29);
                        break;
                    }
                case -3: {
                        return array("mes" => "03", "dia" => 28);
                        break;
                    }
                case -4: {
                        return array("mes" => "03", "dia" => 27);
                        break;
                    }
                case -5: {
                        return array("mes" => "03", "dia" => 26);
                        break;
                    }
                case -6: {
                        return array("mes" => "03", "dia" => 25);
                        break;
                    }
                case -7: {
                        return array("mes" => "03", "dia" => 24);
                        break;
                    }
                case -8: {
                        return array("mes" => "03", "dia" => 23);
                        break;
                    }
                case -9: {
                        return array("mes" => "03", "dia" => 22);
                        break;
                    }
                default: {
                        return false;
                        break;
                    }
            }
        }
    }

}

class festivos {

    var $fecha;

    function __construct($fecha) {
        $this->fecha = $fecha;
    }

    function isBisiesto($anno) {
        return (($anno % 4 == 0) && (($anno % 100 != 0) || ($anno % 400 == 0))) ? true : false;
    }

    function getFestivosFijos() {
        return array(
            "01-01",
            "05-01",
            "07-20",
            "08-07",
            "12-08",
            "12-25"
        );
    }

    function getDiaSemana($param) {
        $fecha = date("Y", strtotime($this->fecha)) . $param;
        return date("N", strtotime($fecha));
    }

    function eslunes($param, $d) {
        $dia = $this->getDiaSemana($param);
        if ($dia != 1) {
            if (((8 - $dia) + $d) < 10) {
                return "0" . ((8 - $dia) + $d);
            } else {
                return ((8 - $dia) + $d);
            }
        } else {
            if ($d < 10) {
                $d = "0" . $d;
            }
            return $d;
        }
//        return $param;
    }

    function getpascua($resurreccion) {
        $cdias = 0;
        if ($resurreccion["mes"] == 3) {
            $cdias = 31;
        } elseif ($resurreccion["mes"] == 4) {
            $cdias = 30;
        }
        $contador = 0;
        $complemento = "";
        for ($index = 1; $index < 13; $index++) {//meses
            if ($index >= $resurreccion["mes"]) {//mayor o igual al mes de resurreccion
                if ($index == $resurreccion["mes"]) {//igual al mes de resurreccion
                    for ($index1 = 1; $index1 <= $cdias; $index1++) {
                        if ($index1 >= $resurreccion["dia"]) {//mayor o igual al dia de resurreccion
                            if ($contador <= 71) {
                                $contador++;
                            }
                        }
                    }
                } else {
                    if ($index == 4) {//si esta en abril
                        for ($index2 = 1; $index2 <= 30; $index2++) {
                            if ($contador <= 71) {
                                $contador++;
                            }
                            if ($contador == 43 || $contador == 64 || $contador == 71) {
                                if ($index2 > 10) {
                                    $complemento .= "0" . $index . "-" . $index2 . "|";
                                } else {
                                    $complemento .= "0" . $index . "-0" . $index2 . "|";
                                }
                            }
                        }
                    } elseif ($index == 5) {
                        for ($index2 = 1; $index2 <= 31; $index2++) {
                            if ($contador <= 71) {
                                $contador++;
                            }
                            if ($contador == 43 || $contador == 64 || $contador == 71) {
                                if ($index2 > 10) {
                                    $complemento .= "0" . $index . "-" . $index2 . "|";
                                } else {
                                    $complemento .= "0" . $index . "-0" . $index2 . "|";
                                }
                            }
                        }
                    } elseif ($index == 6) {
                        for ($index3 = 1; $index3 <= 30; $index3++) {
                            $contador++;
                            if ($contador == 43 || $contador == 64 || $contador == 71) {
                                if ($index3 > 10) {
                                    $complemento .= "0" . $index . "-" . $index3 . "|";
                                } else {
                                    $complemento .= "0" . $index . "-0" . $index3 . "|";
                                }
                            }
                            if ($contador == 72) {
                                break;
                            }
                        }
                    }
                }
            }
        }
        return explode("|", $complemento);
    }

    function getFestivosCorridos() {
        $a = "01-" . $this->eslunes("-01-06", 6);
        $b = "03-" . $this->eslunes("-03-19", 19);
        if ($this->eslunes("-06-29", 29) == 31) {
            $c = "07-" . "01";
        } else {
            $c = "06-" . $this->eslunes("-06-29", 29);
        }
        $d = "08-" . $this->eslunes("-08-15", 15);
        $e = "10-" . $this->eslunes("-10-12", 12);
        $f = "11-" . $this->eslunes("-11-01", 1);
        $g = "11-" . $this->eslunes("-11-11", 11);
        $u = new definePascua(date("Y", strtotime($this->fecha)), 24, 5);

        $resurreccion = $u->getDiaMesResurreccion();
        $pascua = $this->getpascua($resurreccion);

        $temp = explode("-", $pascua[0]);
        $h = $temp[0] . "-" . $this->eslunes(("-" . $pascua[0]), $temp[1]);
        $temp = explode("-", $pascua[1]);
        $i = $temp[0] . "-" . $this->eslunes(("-" . $pascua[1]), $temp[1]);
        $temp = explode("-", $pascua[2]);
        $j = $temp[0] . "-" . $this->eslunes(("-" . $pascua[2]), $temp[1]);
        $k = $resurreccion["mes"] . "-" . ($resurreccion["dia"] - 3);
        $l = $resurreccion["mes"] . "-" . ($resurreccion["dia"] - 2);
        $festivos = array($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l);

        return $festivos;
    }

}
