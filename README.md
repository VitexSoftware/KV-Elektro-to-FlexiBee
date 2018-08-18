![Project Logo](https://raw.githubusercontent.com/VitexSoftware/KV-Elektro-to-FlexiBee/master/projectlogo.png)

KV Elektro CSV -> FlexiBee
======================


Skript pro pro import KvElektro CSV do FlexiBee

Funkce
------

1) Načte se vstupní soubor input.csv ( uveden jako parametr příkazu **kvel2fb** )
2) Vystaví Faktura typu ("TYP_DOKLADU" v konfiguraci) jejíž dodavatelem je "FIRMA" z konfigurace
3) Pro každou jeho řádku se vystaví v tomto dokladu položku

Instalace
---------

Zatím nejsou k dispozici balíčky takže se pouze naklonuje repozitář a nainstalují
PHP závislosti nástrojem composer:

```    
    git clone git@github.com:VitexSoftware/KV-Elektro-to-FlexiBee.git
    cd KV-Elektro-to-FlexiBee && composer install --no-dev
```

Aktualizace
------------

Ve složce se zdrojové kódy akutlizují obdobně k instalaci:

```
    cd KV-Elektro-to-FlexiBee
    git pull
    composer update --no-dev
```

Konfigurace
-----------

kvel2fb.json

```
{
    "TYP_DOKLADU": "FAKTURA",
    "FIRMA": "code:KV"
}
```


Doporučuji nainstalovat balíček [php-flexibee-config](https://www.vitexsoftware.cz/package.php?package=php-flexibee-config) který spravuje konfigurační soubor /etc/flexibee/client.conf
a ten nasymlinkovat do složky projektu jako client.conf

Spuštění
--------

cd src
php -f ./kvel2fb.php csvfile.csv


Poděkování
----------

Tento software by nevznikl pez podpory:

[ ![Cleveron](https://raw.githubusercontent.com/VitexSoftware/KV-Elektro-to-FlexiBee/master/cleveron.png "Cleveron") ](https://cleveron.cz)
[ ![Spoje.Net](https://raw.githubusercontent.com/VitexSoftware/KV-Elektro-to-FlexiBee/master/spojenet.gif "Spoje.Net s.r.o.") ](https://spoje.net/)



