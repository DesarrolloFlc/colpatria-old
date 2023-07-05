<form id="form_load_file" name="form_load_file" enctype="multipart/form-data" action="../includes/controllerRadicado.php" method="POST" target="grp">
  <div id="files_loaders">
    <input type="file" id="load_file" name="load_file"><br>
  </div>
  <input type="hidden" id="action" name="action" value="cargarArchivo">
  <input type="hidden" id="sucursal_sub" name="sucursal_sub" value="ARP BOGOTA">
  <input type="hidden" id="documento_sub" name="documento_sub" value="1050945543"><br><br>
  <iframe width="500" height="200" id="grp" name="grp" frameborder="0"></iframe><br><br>
  <input type="submit" value="Enviar">
</form>