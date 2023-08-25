<?php
date_default_timezone_set('America/Bogota');
require_once PATH_CLASS . DS . '_conexion.php';
require_once 'festivos.class.php';

class Radicados
{

    var $id;
    var $tipo;
    var $id_sucursal;
    /* var $fecha_envio;
      var $funcionario; */
    var $utc;
    var $telefono;
    var $extension;
    var $id_usuarioenvia;
    var $lote;
    var $fecha_recibido;
    var $estado;
    var $id_usuariorecibido;
    var $fecha_envio;
    var $fecha_creacion;
    var $observacion;
	public  $conn;

	public function __construct(){
		$this->conn = new Conexion();
	}
	public function __destruct(){
		$this->conn->desconectar();
	}

    const TIPOS = ['Fisico', 'Virtual', 'Masivo Fisico', 'Financial virtual', 'Gestor de ventas', 'Contingencia virtual', 'Masivo Falabella', 'Masivo Cencosud'];

    //Analizadoras
    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }
    public function getTipoRadicado(){
        return self::TIPOS[$this->tipo] ?? 'Fisico';
    }

    public function getId_sucursal() {
        return $this->id_sucursal;
    }

    /* public function getFecha_envio($text = ''){
      if($text == 'date'){
      $fec = explode("/",$this->fecha_envio);
      return $fec[2]."-".$fec[1]."-".$fec[0];
      }else
      if($text == 'formato'){
      $fec = explode("-",$this->fecha_envio);
      return $fec[2]."/".$fec[1]."/".$fec[0];
      }else
      return $this->fecha_envio;
      } */

    public function getUtc() {
        return $this->utc;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getId_usuarioenvia() {
        return $this->id_usuarioenvia;
    }

    public function getLote() {
        return $this->lote;
    }

    function isBisiesto($anno) {
        return (($anno % 4 == 0) && (($anno % 100 != 0) || ($anno % 400 == 0))) ? true : false;
    }

    public function getFecha_recibido($text = '') {
        if ($text == 'date') {
            $fec = explode("/", $this->fecha_recibido);
            return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
        } else
        if ($text == 'formato') {
            $fec = explode("-", $this->fecha_recibido);
            return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
        } else
            return $this->fecha_recibido;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getId_usuariorecibido() {
        return $this->id_usuariorecibido;
    }

    public function getFecha_envio($text = '') {
        if ($text == 'date') {
            $fec = explode("/", $this->fecha_envio);
            return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
        } else
        if ($text == 'formato') {
            $fec = explode("-", $this->fecha_envio);
            return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
        } else
            return $this->fecha_envio;
    }

    public function getFecha_creacion($text = '') {
        if ($text == 'date') {
            $fec = explode("/", $this->fecha_creacion);
            return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
        } else
        if ($text == 'formato') {
            $fec = explode("-", $this->fecha_creacion);
            return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
        } else
            return $this->fecha_creacion;
    }
    public function obtenerFechaCreacionTexto(){
        setlocale(LC_ALL,"es_CO");
        return strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($this->fecha_creacion));
    }

    public function getObservacion() {
        if(empty($this->observacion))
            return NULL;
        else
            return $this->observacion;
    }

    //Modificadoras
    public function setId($id) {
        $this->id = trim($id);
    }

    public function setTipo($tipo) {
        $this->tipo = trim($tipo);
    }

    public function setId_sucursal($id_sucursal) {
        $this->id_sucursal = trim($id_sucursal);
    }

    /* public function setFecha_envio($fecha_envio){
      $this->fecha_envio = $fecha_envio;
      }
      public function setFuncionario($funcionario){
      $this->funcionario = $funcionario;
      } */

    public function setUtc($utc) {
        $this->utc = trim($utc);
    }

    public function setTelefono($telefono) {
        $this->telefono = trim($telefono);
    }

    public function setExtension($extension) {
        $this->extension = trim($extension);
    }

    public function setId_usuarioenvia($id_usuarioenvia) {
        $this->id_usuarioenvia = trim($id_usuarioenvia);
    }

    public function setLote($lote) {
        $this->lote = trim($lote);
    }

    public function setFecha_recibido($fecha_recibido) {
        $this->fecha_recibido = trim($fecha_recibido);
    }

    public function setEstado($estado) {
        $this->estado = trim($estado);
    }

    public function setId_usuariorecibido($id_usuariorecibido) {
        $this->id_usuariorecibido = trim($id_usuariorecibido);
    }

    public function setFecha_envio($fecha_envio) {
        $this->fecha_envio = trim($fecha_envio);
    }

    public function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = trim($fecha_creacion);
    }

    public function setObservacion($observacion) {
        $this->observacion = trim($observacion);
    }

    public function setAtributos($atributos) {
        if (is_array($atributos)) {
            $this->id = isset($atributos["id"]) ? $atributos["id"] : "NULL";
            $this->tipo = isset($atributos["tipo"]) ? $atributos["tipo"] : "0";
            $this->id_sucursal = $atributos["id_sucursal"];
            /* $this->setFecha_envio($atributos["fecha_envio"]);
              $this->setFuncionario($atributos["funcionario"]); */
            $this->utc = (isset($atributos["utc"]) && trim($atributos["utc"]) != '') ? trim($atributos["utc"]) : "NULL";
            $this->telefono = $atributos["telefono"];
            $this->extension = (isset($atributos["extension"]) && trim($atributos["extension"]) != '') ? trim($atributos["extension"]) : "NULL";
            $this->id_usuarioenvia = $atributos["id_usuarioenvia"];
            $this->lote = (isset($atributos["lote"]) && trim($atributos["lote"]) != '') ? $atributos["lote"] : "NULL";
            $this->fecha_recibido = (isset($atributos["fecha_recibido"]) && trim($atributos["fecha_recibido"]) != '') ? $atributos["fecha_recibido"] : "NULL";
            $this->estado = (isset($atributos["estado"])) ? $atributos["estado"] : "NULL";
            $this->id_usuariorecibido = (isset($atributos["id_usuariorecibido"]) && trim($atributos["id_usuariorecibido"]) != '') ? $atributos["id_usuariorecibido"] : "NULL";
            $this->fecha_envio = (isset($atributos["fecha_envio"]) && trim($atributos["fecha_envio"]) != '') ? $atributos["fecha_envio"] : "0000-00-00";
            $this->fecha_creacion = (isset($atributos["fecha_creacion"]) && trim($atributos["fecha_creacion"]) != '') ? $atributos["fecha_creacion"] : "NULL";
        }
    }

    public function registrar() {
        $SQL = "INSERT INTO radicados 
				(
					tipo, id_sucursal, utc, telefono, extension, id_usuarioenvia
				)
				VALUES
				(
					:tipo, :id_sucursal, :utc, :telefono, :extension, :id_usuarioenvia
                )";
        $data = [
            ':tipo'=> $this->tipo, 
            ':id_sucursal'=> $this->id_sucursal, 
            ':utc'=>  $this->utc,
            ':telefono'=> $this->telefono, 
            ':extension'=> $this->extension, 
            ':id_usuarioenvia'=> $this->id_usuarioenvia
        ];
        if (!$this->conn->ejecutar($SQL, $data)) {
            return false;
        }
        $this->id = $this->conn->ultimaId();
        $this->getRadicado();
        return true;
    }

    public function aprobarRadicado() {
        $SQL = "INSERT INTO radicados 
				(
					lote, fecha_recibido, estado, id_usuariorecibido
				)
				VALUES
				(
					" . $this->lote . ", '" . $this->fecha_recibido . "', " . $this->estado . ", 
					" . $this->id_usuariorecibido . "
				)";
        if (!$this->conn->ejecutar($SQL)) {
            return false;
        }
        $this->setId($this->conn->ultimaId());
        $this->getRadicado();
        return true;
    }

    public function agregarItems($nom, $ced, $docespe) {
        $SQL = "INSERT INTO radicados_items
				(
					documento, descripcion, id_radicados, documento_especial
				)
				VALUES
				(
					:documento, :descripcion, :id_radicados, :documento_especial
				)";
        return $this->conn->ejecutar($SQL, [':documento'=> $ced, ':descripcion'=> strtoupper($nom), ':id_radicados'=> $this->id, ':documento_especial'=> strtoupper($docespe)]);
    }

    public function getRadicado() {
        $SQL = "SELECT * 
				  FROM radicados 
				 WHERE id = " . $this->id;
        $this->conn->consultar($SQL);
        if ($this->conn->getNumeroRegistros() <= 0) {
            return false;
        }
        $row = $this->conn->sacarRegistro();
        $this->setAtributos($row);
        return true;
    }

    public function getItemsDeRadicado($sucursal = '') {
        $upload_folder = '/var/www/html/Aplicativos.Serverfin04/Colpatria/virtuales_doc/virtuales/'.$sucursal;
        $upload_folder2 = '/var/www/html/Aplicativos.Serverfin04/Colpatria/virtuales_doc/virtuales_aceptados/'.$sucursal;
        $order = ($this->tipo == '2' || $this->tipo == '6') ? "ORDER BY id ASC" : "ORDER BY estado ASC";
        $SQL = "SELECT @rownum:=@rownum+1 AS rownum, 
                       ri.id, 
                       ri.descripcion, 
                       ri.documento, 
                       ri.estado, 
                       ri.fecha_creacion, 
                       ri.documento_especial,
                       ra.tipo,
                       e.radicado_item_id/*,
                       rf.nombre*/
				  FROM (SELECT @rownum:=0) r, radicados_items AS ri
                 INNER JOIN radicados AS ra ON(ra.id = ri.id_radicados)
                  LEFT JOIN radicado_item_evidencias AS e ON(e.radicado_item_id = ri.id)
                  /*LEFT JOIN radicados_files AS rf ON(rf.id_radicado = ri.id_radicados AND rf.documento = ri.documento)*/
				 WHERE ri.id_radicados = " . $this->id . "
				 $order";
        $this->conn->consultar($SQL);
        if ($this->conn->getNumeroRegistros() <= 0) {
            return false;
        }
        $array = [];
        while ($row = $this->conn->sacarRegistro('str')) {
            $row['estado_str'] = self::getEstados($row['estado'], $row['tipo']);
            $numstr = '0'.$row['rownum'];
            if (strlen($row['rownum']) > 1) $numstr = $row['rownum'];
            //$fileName = "";
            if ($sucursal !== '') {
                if(file_exists($upload_folder.'/'.$row['documento'].'/'.$sucursal.'_'.$row['documento']."_TODO.pdf")){
                    $row['file_name'] = $sucursal.'_'.$row['documento']."_TODO.pdf";
                }else if(file_exists($upload_folder.'/'.$row['documento'].'/'.$sucursal.'_'.$row['documento']."_MULTI.tiff")){
                    $row['file_name'] = $sucursal.'_'.$row['documento']."_MULTI.tiff";
                }else if($row['estado'] == '2' && file_exists($upload_folder2.'/'."LOTE_".$this->id."_".$numstr.".pdf")){
                    $row['file_name'] = "LOTE_".$this->id."_".$numstr.".pdf";
                }else if($row['estado'] == '2' && file_exists($upload_folder2.'/'."LOTE_".$this->id."_".$numstr.".tiff")){
                    $row['file_name'] = "LOTE_".$this->id."_".$numstr.".tiff";
                }else
                    $row['file_name'] = "LOTE_".$this->id."_".$numstr.".pdf";
            }
            $row['file_path'] = $upload_folder.'/'.$row['documento'].'/'.$sucursal.'_'.$row['documento']."_";
            $array[] = $row;
        }
        return $array;
    }

    public function getSucursal() {
        $SQL = "SELECT t2.sucursal 
				FROM radicados AS t1
				INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
				WHERE t1.id = " . $this->id;
        $this->conn->consultar($SQL);
        if ($this->conn->getNumeroRegistros() <= 0) {
            return false;
        }
        $row = $this->conn->sacarRegistro();
        return $row[0];
    }

    public function aprobarOrden() {
        $SQL = "UPDATE radicados
				   SET lote = :lote, 
                       fecha_recibido = :fecha_recibido, 
                       id_usuariorecibido = :id_usuariorecibido, 
                       estado = :estado, 
                       fecha_envio = :fecha_envio,
                       observacion = :observacion
                 WHERE id = :id";
        $data = [
            ':lote'=> $this->id,
            ':fecha_recibido'=> date('Y-m-d'),
            ':id_usuariorecibido'=> $this->id_usuariorecibido,
            ':estado'=> '2',
            ':fecha_envio'=> $this->fecha_envio,
            ':observacion'=> $this->observacion,
            ':id'=> $this->id
        ];
        if (!$this->conn->ejecutar($SQL, $data)) {
            return false;
        }
        $this->getRadicado();
        return true;
    }

    public function aprobarCliente($id_cliente, $estado) {
        $SQL = "UPDATE radicados_items
				   SET estado = :estado
				 WHERE id = :id
				   AND id_radicados = :id_radicados";
        return $this->conn->ejecutar($SQL, [':estado'=> $estado, ':id'=> $id_cliente, ':id_radicados'=> $this->id]);
    }

    public function getFuncionario() {
        $SQL = "SELECT t2.name
				FROM radicados AS t1 
				INNER JOIN user AS t2 ON(t1.id_usuarioenvia = t2.id)
				WHERE t1.id = " . $this->id;
        $this->conn->consultar($SQL);
        if ($this->conn->getNumeroRegistros() !== 1) {
            return false;
        }
        $row = $this->conn->sacarRegistro();
        return $row[0];
    }

    public static function getJustFuncionario() {
        $conn = new Conexion();
        $SQL = "SELECT name
				FROM user
				WHERE id = " . $_SESSION['id'];
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() !== 1) {
            $conn->desconectar();
            return false;
        }
        $consulta = $conn->sacarRegistro();
        $conn->desconectar();
        return $consulta[0];
    }

    public function getOficial() {
        $SQL = "SELECT t2.* 
				  FROM radicados AS t1 
				 INNER JOIN official AS t2 ON(t1.id_usuarioenvia = t2.id)
				 WHERE t1.id = " . $this->id . "
				   AND t1.id_usuarioenvia = " . $this->id_usuarioenvia;
        $this->conn->consultar($SQL);
        if ($this->conn->getNumeroRegistros() !== 1) {
            return false;
        }
        $row = $this->conn->sacarRegistro();
        return $row;
    }

    public static function validaFestivos($id) {
        $sql = "SELECT fecha_creacion FROM radicados WHERE tipo IN ('0', '2') and estado = '0' and id = " . $id;
        $conn = new Conexion();
        $conn->consultar($sql);
        $dactual = [
            "dia" => date('d'),
            "mes" => date('m'),
            "anio" => date('Y'),
            "stdia" => date('N')
        ];
        $dcreacion = [
            "dia" => 0,
            "mes" => 0,
            "anio" => 0,
            "stdia" => 0
        ];
        $sd = new festivos(date("d-m-Y"));
        $fcorridos = $sd->getFestivosCorridos();
        $festables = $sd->getFestivosFijos();

        if ($conn->getNumeroRegistros() <= 0) {
            $conn->desconectar();
            return 0;
        }
        $count = 0;
        while ($consulta = $conn->sacarRegistro()) {
            if ($dactual["anio"] !== date('Y', strtotime($consulta["fecha_creacion"]))) continue;

            $dcreacion = [
                "dia" => date('d', strtotime($consulta["fecha_creacion"])),
                "mes" => date('m', strtotime($consulta["fecha_creacion"])),
                "anio" => date('Y', strtotime($consulta["fecha_creacion"])),
                "stdia" => date("N", strtotime($consulta["fecha_creacion"]))
            ];
                
            $dsemana = $dcreacion["stdia"];
            for ($mes = 1; $mes <= 12; $mes++) {
                if ($mes >= $dcreacion["mes"] && $mes <= $dactual["mes"]) {//---
                    for ($dia = 1; $dia <= 31; $dia++) {

                        if ($dia >= $dcreacion["dia"] || $mes > $dcreacion["mes"] && $dia <= $dactual["dia"]) {

                            for ($i = 0; $i < count($fcorridos); $i++) {
                                $ftemp = explode("-", $fcorridos[$i]);
                                if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                                    $count++;
                                }
                            }
                            for ($a = 0; $a < count($festables); $a++) {
                                $ftemp = explode("-", $festables[$a]);
                                if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                                    $count++;
                                }
                            }
                            
                            if ($dsemana == 7) {
                                $count++;
                            }

                            $dsemana++;

                            if ($dsemana == 8) {
                                $dsemana = 1;
                            }
                        }
                        if ($mes == $dactual["mes"] && $dia == $dactual["dia"]) {//---
                            $dia = 31;
                        }

                        //----
                        if ($mes == 9 || $mes == 4 || $mes == 6 || $mes == 11) {
                            if ($dia == 30) {
                                $dia = 31;
                            }
                        }
                        if ($mes == 2) {
                            if ($dia == 28) {
                                $dia = 31;
                            }
                        }
                    }
                }
            }
        }
        $conn->desconectar();
        return $count;
    }

    public static function radicadosNoAprobados() {
        $conn = new Conexion();
        $fecha = date('Y-m-d');
        $SQL = "SELECT id, id_usuarioenvia, DATEDIFF('$fecha', fecha_creacion) AS diferencia
				FROM radicados
				WHERE tipo IN ('0', '2') AND estado = '0'";
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() <= 0) {
            return false;
        }
        $array = [];
        while (($consulta = $conn->sacarRegistro())) {
            $diferencia = $consulta['diferencia'] - self::validaFestivos($consulta['id']);
            if ($consulta['diferencia'] <= 3) continue;

            $objeto = new Radicados();
            $objeto->setId($consulta['id']);
            $objeto->setId_usuarioenvia($consulta['id_usuarioenvia']);
            $oficial = $objeto->getOficial();
            $oficial['dias_atrazo'] = $diferencia;
            $oficial['id_radicado'] = $consulta['id'];
            $array[] = $oficial;
        }
        return $array;
    }

    public static function verificarNotificacionDia() {
        $conn = new Conexion();
        $fecha = date('Y-m-d');
        $SQL = "SELECT * FROM radicados_recordatorio 
				WHERE fecha = '$fecha'";
        $conn->consultar($SQL);
        $resp = $conn->getNumeroRegistros() > 0;
        $conn->desconectar();
        return $resp;
    }

    public static function insertarNotificacionDia() {
        $conn = new Conexion();
        $fecha = date('Y-m-d');
        $SQL = "INSERT INTO radicados_recordatorio (fecha) VALUES ('$fecha')";
        $resp = $conn->ejecutar($SQL);
        $conn->desconectar();
        return $resp;
    }

    public function insertarDevolucion($cliente, $causal, $causalobservacion, $observation, $persontype) {
        $observacionesCausal = $this->obtenerTextoDevoluciones($causalobservacion);
        $SQL = "INSERT INTO workflow
				(
					id_user, causal, causal_id, causal_observacion_id, observaciones_causal, id_official, observation, status, persontype, documento, nombre, id_radicado, id_sucursal, id_area, lote
				)
				VALUES
				(
                    :id_user, :causal, :causal_id, :causal_observacion_id, :observaciones_causal, :id_official, :observation, :status, :persontype, :documento, :nombre, :id_radicado, :id_sucursal, :id_area, :lote
				)";
        return $this->conn->ejecutar($SQL, [
            ':id_user'=> $_SESSION['id'], 
            ':causal'=> "", 
            ':causal_id'=> $causal, 
            ':causal_observacion_id'=> "NULL",
            ':observaciones_causal'=> mb_strtoupper($observacionesCausal),
            ':id_official'=> $this->id_usuarioenvia, 
            ':observation'=> mb_strtoupper($observation), 
            ':status'=> 1, 
            ':persontype'=> $persontype, 
            ':documento'=> $cliente['documento'], 
            ':nombre'=> str_replace("'", "´", $cliente['descripcion']), 
            ':id_radicado'=> $this->id, 
            ':id_sucursal'=> $this->id_sucursal, 
            ':id_area'=> $this->id_sucursal, 
            ':lote'=> $this->id
        ]);
    }

    public function getDevolucion($documento) {
        $SQL = "SELECT w.*, c.descripcion AS causal_str, o.descripcion AS causal_observacion_str
                  FROM workflow AS w
                  LEFT JOIN param_causal AS c ON(c.id = w.causal_id)
                  LEFT JOIN param_causal_observacion AS o ON(o.id = w.causal_observacion_id)
				 WHERE w.documento = :documento
				   AND w.id_radicado = :id_radicado
				 ORDER BY w.date_created DESC
				 LIMIT 1";
        $this->conn->consultar($SQL, [':documento'=> $documento, ':id_radicado'=> $this->id]);
        if ($this->conn->getNumeroRegistros() !== 1) {
            return false;
        }
        $row = $this->conn->sacarRegistro('str');
        return $row;
    }

    public function getClienteItem($id_cliente) {
        $SQL = "SELECT * FROM radicados_items WHERE id = :id";
        $this->conn->consultar($SQL, [':id'=> $id_cliente]);
        if ($this->conn->getNumeroRegistros() !== 1) {
            return false;
        }
        $row = $this->conn->sacarRegistro('str');
        return $row;
    }

    public static function inserFileRadicado($nombre, $documento, $pdfFile = '', $pathUpload = '') {
        if($pdfFile != '' && $pathUpload != ''){
            if(file_exists($pathUpload.DS.$pdfFile))
                $nombre = $pdfFile;
        }
        $conn = new Conexion();
        $SQL = "INSERT INTO radicados_files
				(
					nombre, documento 
				)
				VALUES
				(
					'$nombre', '$documento'
				)";
        $resp = $conn->ejecutar($SQL);
        $conn->desconectar();
        return $resp;
    }

    public function updateFilesRadicado($documento) {
        $SQL = "UPDATE radicados_files SET estado = '1', id_radicado = " . $this->id . "
				WHERE documento = '$documento'";
        return $this->conn->ejecutar($SQL);
    }

    public function updateFilesRadicadoNombre($documento, $pos_cli) {
        $SQL = "UPDATE radicados_files SET nombre = 'LOTE_" . $this->id . "_" . $pos_cli . ".pdf'
				WHERE documento = '$documento'";
        return $this->conn->ejecutar($SQL);
    }

    public static function clientesDelOficial($fec_ini, $fec_fin) {
        $id_usuarioenvia = $_SESSION['id'] == '1' ? '2589' : $_SESSION['id'];
        $conn = new Conexion();
        $SQL = "SELECT t1.*, 
                       t3.name,
                       t2.tipo
                  FROM radicados_items AS t1
                 INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
                  LEFT JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
                 WHERE (t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59')
                   AND t2.id_usuarioenvia = '$id_usuarioenvia'
                 ORDER BY t1.id_radicados";
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() <= 0) {
            $conn->desconectar();
            return false;
        }
        $array = [];
        while ($row = $conn->sacarRegistro()) {
            $row['estado_str'] = self::getEstados($row['estado'], $row['tipo']);
            $array[] = $row;
        }
        $conn->desconectar();
        return $array;
    }

    public static function clientesDelOficialSucursal($fec_ini, $fec_fin, $sucursal) {
        $comp = ' AND t2.id_sucursal = ' . $sucursal;
        if ($sucursal == 'T')
            $comp = '';
        $conn = new Conexion();
        $SQL = "SELECT t1.id_radicados,
                       t2.tipo,
                       t4.sucursal,
                       t3.name AS oficial,
                       t1.documento,
                       t1.descripcion,
                       t1.fecha_creacion,
                       t2.fecha_envio,
                       t2.fecha_recibido,
                       t1.estado
                  FROM radicados_items AS t1
                 INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id)
                 /*INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)*/
                 INNER JOIN user AS t3 ON(t2.id_usuarioenvia = t3.id)
                 INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
                 WHERE t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'$comp
                 ORDER BY t2.id";
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() > 0) {
            $array = [];
            while (($consulta = $conn->sacarRegistro('str'))) {
                $array[] = $consulta;
            }
            $conn->desconectar();
            return $array;
        } else {
            $conn->desconectar();
            return false;
        }
    }

    public static function clientesDelOficialOficial($fec_ini, $fec_fin, $oficial) {
        $comp = ' AND t2.id_usuarioenvia = ' . $oficial;
        if ($oficial == 'T')
            $comp = '';
        $conn = new Conexion();
        $SQL = "SELECT t1.id_radicados, t2.tipo, t4.sucursal, t3.name AS oficial, t1.documento, t1.descripcion,
				t1.fecha_creacion, t2.fecha_envio, t2.fecha_recibido, t1.estado 
				FROM radicados_items AS t1
				INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
				WHERE t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'$comp				
				ORDER BY t2.id";
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() > 0) {
            $array = [];
            while (($consulta = $conn->sacarRegistro())) {
                $array[] = $consulta;
            }
            $conn->desconectar();
            return $array;
        } else {
            $conn->desconectar();
            return false;
        }
    }

    public static function getRadicadosDia($fecha) {
        $conn = new Conexion();
        /* $SQL = "SELECT t1.id, t1.fecha_recibido, t2.sucursal, t2.sucursal, t1.utc, t3.name, t3.name, 
          COUNT(t4.id), IF(t1.tipo = 0, 'Fisico', 'Virtual'), t1.fecha_creacion
          FROM radicados AS t1
          INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
          INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
          INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados)
          WHERE t1.estado = 2
          AND t1.fecha_recibido = '$fecha'"; */
        $SQL = "SELECT t1.id, t1.fecha_recibido, t2.sucursal, t2.sucursal, t1.utc, t3.name, t3.name, 
				  COUNT(t4.id), IF(t1.tipo = 0, 'Fisico', IF(t1.tipo = 2, 'Fisico', 'Virtual')), t1.fecha_creacion
				FROM radicados AS t1
					INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
					INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
					INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados AND t4.estado = 2)
				WHERE t1.estado = 2
					AND t1.fecha_recibido = '$fecha'
					GROUP BY t1.id";
        $conn->consultar($SQL);
        if ($conn->getNumeroRegistros() > 0) {
            $array = [];
            while (($consulta = $conn->sacarRegistro())) {
                $array[] = $consulta;
            }
            $conn->desconectar();
            return $array;
        } else {
            $conn->desconectar();
            return false;
        }
    }

    public static function cancelRadicado($id_radicado) {
        $conn = new Conexion();
        $hoy = date('Y-m-d');
        $SQL = "UPDATE radicados 
				SET estado = '4', fecha_recibido = '$hoy'
				WHERE id = $id_radicado
				AND estado = '0'";
        if ($conn->ejecutar($SQL)) {
            if (Radicados::cancelItemsRadicado($id_radicado)) {
                $conn->desconectar();
                return true;
            } else {
                $conn->desconectar();
                return false;
            }
        } else {
            $conn->desconectar();
            return false;
        }
    }

    public static function cancelItemsRadicado($id_radicado) {
        $conn = new Conexion();
        $SQL = "UPDATE radicados_items 
				SET estado = '4'
				WHERE id_radicados = $id_radicado";
        if ($conn->ejecutar($SQL))
            return true;
        else
            return false;
    }

    public static function getValidaCliente($cliente) {
        $conn = new Conexion();
        $SQL = "SELECT form.id as cformularios 
                  FROM form 
                 INNER JOIN client ON (form.id_client = client.id) 
                 WHERE client.document = :document";
        $conn->consultar($SQL, [':document'=> $cliente]);
        if ($conn->getNumeroRegistros() > 0) {
            $conn->desconectar();
            return true;
        } else {
            $conn->desconectar();
            return false;
        }
    }

    public function updateRadicadoNombCliente($Ndocumento, $estado, $id_radicado, $item) {
        $conn = new Conexion();
        $SQL = "UPDATE radicados_items SET documento = '" . $Ndocumento . "'
				WHERE radicados_items.estado =" . $estado . " AND radicados_items.id_radicados =" . $id_radicado . " AND radicados_items.id =" . $item;
        if ($conn->ejecutar($SQL)) {
            $conn->desconectar();
            return true;
        } else {
            $conn->desconectar();
            return false;
        }
    }
    public static function verificarCambioEstadoRadicado($documento, $id_radicado){
        $conn = new Conexion();
        $SQL = "SELECT r.tipo, r.id_sucursal, r.utc, r.telefono, r.extension, r.id_usuarioenvia,
                       ri.id AS radicado_item_id, ri.documento, ri.descripcion, ri.id_radicados, ri.documento_especial, ri.estado
                  FROM radicados_items ri
                 INNER JOIN radicados r ON(r.id = ri.id_radicados)
                 WHERE ri.documento = $documento
                   AND ri.id_radicados = $id_radicado
				   AND r.estado = '2'
                   AND ri.estado IN ('0', '1', '2', '3')";
        if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$consulta = $conn->sacarRegistro();
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return "No se encontraron resultados con los datos suministrados, por favor verifique.";
			}
		}else{
			$conn->desconectar();
			return false;
		}
    }

    public static function cambiarEstadoItemRadicado($id, $estado) {
        $conn = new Conexion();
        $SQL = "UPDATE radicados_items 
                   SET estado = :estado
                 WHERE id = :id";
        return $conn->ejecutar($SQL, [':estado'=> $estado, ':id'=> $id]);
    }
    public function insertarMasivo($documento, $descripcion, $especial, $especial_str, $item){
        $insertado = $item === false ? 1 : 0;
        $SQL = "INSERT INTO radicados_masivos 
                (
                    radicados_id, documento, descripcion, documento_especial, especial_str, estado
                )
                VALUES
                (
                    ".$this->id.", '$documento', '$descripcion', $especial, '$especial_str', $insertado
                )";
        return $this->conn->ejecutar($SQL);
    }
    public static function getEstados($estado, $tipo = 0) {
        $estados = ['Radicado', [], 'Aprobado', 'Devuelto', 'Cancelado'];
        return $estado === 1 ? ($tipo == 1 || $tipo == 5 ? 'No se adjunto documento' : 'No llego fisico') : $estados[$estado] ?? 'Radicado';
    }
    public static function obtenerCausales(int $tipo_persona){
        $conn = new Conexion();
        $sql = "SELECT id, descripcion 
                  FROM param_causal 
                 WHERE tipo_persona = :tipo_persona
                   AND estado = '0'";
        $conn->consultar($sql, [':tipo_persona'=> $tipo_persona]);
        if ($conn->getNumeroRegistros() <= 0) {
            $conn->desconectar();
            return [];
        }
        $objs = $conn->sacarTodoRegistro('str');
        return $objs;
    }
    public static function obtenerObservacionCausales(int $causal_id){
        $conn = new Conexion();
        $sql = "SELECT id, descripcion 
                  FROM param_causal_observacion 
                 WHERE causal_id = :causal_id
                   AND estado = :estado";
        $conn->consultar($sql, [':causal_id'=> $causal_id, ':estado'=> '0']);
        if ($conn->getNumeroRegistros() <= 0) {
            $conn->desconectar();
            return [];
        }
        $objs = $conn->sacarTodoRegistro('str');
        return $objs;
    }
    public function obtenerTextoDevoluciones(array $ids)
    {
        $idtxt = "";
        $i = 0;
        foreach ($ids as $key => $value) {
            $idtxt .= $i === 0 ? $value : ", " . $value;
            $i++;
        }
        $sql = "SELECT id, descripcion  
                  FROM param_causal_observacion 
                 WHERE id IN ($idtxt)";
        if (!$this->conn->consultar($sql)) return "";

        if ($this->conn->getNumeroRegistros() <= 0) return "";

        $texto = "";
        $i = 0;
        while ($row = $this->conn->sacarRegistro('str')) {
            $texto .= $i === 0 ? $row['descripcion'] : ", " . $row['descripcion'];
            $i++;
        }
        return $texto;
    }
}
