#!/bin/bash
FILENAME="finleco_sarlaft_"`(date +%Y%m%d)`".txt"
ZIPFILE="finleco_sarlaft_"`(date +%Y%m%d)`".zip"
GPGFILE="finleco_sarlaft_"`(date +%Y%m%d)`".zip.gpg"
cd /var/www/html/Aplicativos.Serverfin04/Colpatria/procesos/sarlaft
/usr/bin/php generar_archivo_sarlaft.php

zip $ZIPFILE $FILENAME
gpg -er "AXA COLPATRIA" $ZIPFILE
#scp -P 54322 $GPGFILE root@192.168.6.235:/home/Colpatria2/sarlaft/$GPGFILE
#gpg -er "Finleco_Renovaciones" $ZIPFILE
scp -P 22 $GPGFILE root@192.168.6.54:/home/Colpatria2/sarlaft/$GPGFILE

rm -rf $FILENAME
