#!/bin/bash

php /var/www/html/Aplicativos.Serverfin04/Colpatria/procesos/autos/autosftp.php

FILENAME="autos_"`(date +%Y%m%d)`".txt"
scp /var/www/html/Aplicativos.Serverfin04/Colpatria/autosfile/$FILENAME Colpatria_autos@192.168.6.1:/home/Colpatria_autos/$FILENAME

