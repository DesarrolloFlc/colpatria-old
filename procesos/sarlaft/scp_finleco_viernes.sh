#!/bin/bash
FILENAME="finleco_digitados_hasta_"`(date +%Y%m%d)`".txt"
ZIPFILE="finleco_digitados_hasta_"`(date +%Y%m%d)`".zip"
GPGFILE="finleco_digitados_hasta_"`(date +%Y%m%d)`".zip.gpg"

FILENAME2="finleco_radicados_hasta_"`(date +%Y%m%d)`".txt"
ZIPFILE2="finleco_radicados_hasta_"`(date +%Y%m%d)`".zip"
GPGFILE2="finleco_radicados_hasta_"`(date +%Y%m%d)`".zip.gpg"

cd /var/www/html/Aplicativos.Serverfin04/Colpatria/procesos/sarlaft
/usr/bin/php generar_digitados_viernes.php
/usr/bin/php generar_radicados_viernes.php

zip $ZIPFILE $FILENAME
zip $ZIPFILE2 $FILENAME2

gpg -er "AXA COLPATRIA" $ZIPFILE
gpg -er "AXA COLPATRIA" $ZIPFILE2
#scp -P 54322 $GPGFILE root@192.168.6.235:/home/Colpatria2/Colpatria/REPORTES\\\ CONSOLIDADO/$GPGFILE
#scp -P 54322 $GPGFILE2 root@192.168.6.235:/home/Colpatria2/Colpatria/REPORTES\\\ CONSOLIDADO/$GPGFILE2

#gpg -er "Finleco_Renovaciones" $ZIPFILE
#gpg -er "Finleco_Renovaciones" $ZIPFILE2

scp -P 22 $GPGFILE root@192.168.6.54:/home/Colpatria2/Colpatria/REPORTES\\\ CONSOLIDADO/$GPGFILE
scp -P 22 $GPGFILE2 root@192.168.6.54:/home/Colpatria2/Colpatria/REPORTES\\\ CONSOLIDADO/$GPGFILE2

rm -rf $FILENAME
rm -rf $FILENAME2
rm -rf $GPGFILE
rm -rf $GPGFILE2
