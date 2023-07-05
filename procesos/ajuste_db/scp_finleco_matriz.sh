#!/bin/bash
echo "INICIO DEL PROCESO"
cd /var/www/html/Aplicativos.Serverfin04/Colpatria/procesos/ajuste_db
echo "Creando tabla data_matriz: "`(date +'%Y-%m-%d %H:%M:%S')`""
/usr/bin/php index.php
echo "Fin de la creacion de la tabla data_matriz: "`(date +'%Y-%m-%d %H:%M:%S')`""

FILENAME="finleco_data_matriz_"`(date +%Y%m%d)`".txt"
ZIPFILE="finleco_data_matriz_"`(date +%Y%m%d)`".zip"
GPGFILE="finleco_data_matriz_"`(date +%Y%m%d)`".zip.gpg"

echo "Generando archivo con la informacion: "`(date +'%Y-%m-%d %H:%M:%S')`""
/usr/bin/php generar_archivo_matriz.php
echo "Fin de la generacion: "`(date +'%Y-%m-%d %H:%M:%S')`""

echo "Comprimiendo archivo: "`(date +'%Y-%m-%d %H:%M:%S')`""
zip $ZIPFILE $FILENAME
echo "Fin de la compresion: "`(date +'%Y-%m-%d %H:%M:%S')`""

echo "Encryptando archivo: "`(date +'%Y-%m-%d %H:%M:%S')`""
gpg -er "AXA COLPATRIA" $ZIPFILE
#gpg -er "Finleco_Renovaciones" $ZIPFILE
echo "Fin de la encryptacion: "`(date +'%Y-%m-%d %H:%M:%S')`""

echo "Enviando archivo mediante SCP: "`(date +'%Y-%m-%d %H:%M:%S')`""
#scp -P 54322 $GPGFILE root@192.168.6.235:"/home/Colpatria2/Colpatria/REPORTES\ CONSOLIDADO/$GPGFILE"
scp -P 22 $GPGFILE root@192.168.6.54:"/home/Colpatria2/Colpatria/REPORTES\ CONSOLIDADO/$GPGFILE"
echo "Fin del envio: "`(date +'%Y-%m-%d %H:%M:%S')`""

rm -rf $FILENAME
echo "FIN DEL PROCESO "`(date +'%Y-%m-%d %H:%M:%S')`
echo ""
