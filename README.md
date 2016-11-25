LettureEnel Applicazione web
================================

LettureEnel è una applicazione web per registrare e tenere traccia dei consumi rilevati da contatori Enel in regime di scambio sul posto.

LettureEnel permette di registrare su di un database mysql ciò che viene riportato dai contatori Enel, in particolare:
* Consumi da rete ENEL
* Immissioni del proprio impianto fotovoltaico su rete Enel
* Produzione del proprio impianto fotovoltaico

Tutti gli inserimenti sono divisi per fascia oraria (F1,F2 e F3).

Da questi dati in input viene poi generata una pagina web che riporta:
* delta dei consumi/produzione/immissione su rete Enel per ogni intervallo temporale.
* conteggio dei consumi casalinghi prelevati da impianto fotovoltaico.
* rapporto con i consumi totali.

REQUISITI
------------

Un interprete php, un server MySQL e un web server.

INSTALLAZIONE
------------

### Installazione da sorgenti

* Clonare i sorgenti dal [Github repository](https://github.com/Ozzyboshi/LettureEnel.git) in una directory sotto la Web root (solitamente /var/www).
* Editare il file config/db.php e immettere i dati necessari alla connessione al server MySQL come da esempio:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=lettureenel',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
* Lanciare composer update per generare la cartella 'vendor'
* Creare le tabelle e i records necessari per il funzionamento della applicazione web, per fare cio lanciare ./yii migrate dalla root del progetto.
* Se non si dispone di un proprio server web lanciare ./yii serve
* Richiamare la applicazione web dal proprio browser inserendo l'indirizzo ip o dominio del server

### Installazione con Docker
Per installare la applicazione web usando docker occorre prima creare un container con un server mysql, quindi creare il database che conterrà i dati, ad esempio:
```
docker run --name some-mysql -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql
docker exec -it some-mysql mysql -e "create database lettureenel" -pmy-secret-pw -u root --host localhost
```
successivamente procedere con il container che conterrà l'installazione vera e propria della applicazione web:
```
docker run --name lettureenel -p 80:80 -e "DB_USER=root" -e "DB_PASS=my-secret-pw" -e "DB_STRING=mysql:host=db;dbname=lettureenel" -e "DATALOGGER_URL=http://home1.solarlog-web.it/" --link some-mysql:db -d ozzyboshi/lettureeneldockerimage
docker exec -it lettureenel ./yii migrate
```
### Supporto SSL / TLS
In caso di installazione su server pubblico è consigliato accedere all' applicazione web in modalità sicura passando al container in modo appropriato certificato e chiave pregenerati.
Nel seguente esempio vengono generati certificati e chiavi con Letsencrypt, una certification authority che fornisce certificati X.509 in modo gratuito ed automatico.
Prima di lanciare il seguente comando assicurarsi che i DNS del dominio per il quale viene richiesto il certificato siano funzionanti e risolvano l'ip pubblico della macchina deputata a servire la applicazione web.

```
docker run -it --rm -p 443:443 -p 80:80 --name letsencrypt -v "/etc/letsencrypt:/etc/letsencrypt" -v "/var/lib/letsencrypt:/var/lib/letsencrypt" quay.io/letsencrypt/letsencrypt:latest auth
```

Una volta generati i certificati (che avranno validità trimestrale) e chiavi, lanciare la applicazione web come nel seguente esempio, ovviamente occorre rimpiazzare example.com con il vostro dominio.

```
docker run -v /etc/letsencrypt/archive/lettureenel.example.com/cert1.pem:/etc/certdir/cert.pem:ro -v /etc/letsencrypt/archive/lettureeneltest.example.com/privkey1.pem:/etc/certdir/privkey.pem:ro --name lettureenel -p 80:80 -p 443:443  -e "DB_USER=root" -e "DB_PASS=my-secret-pw" -e "DB_STRING=mysql:host=db;dbname=lettureenel" -e "DATALOGGER_URL=http://home1.solarlog-web.it/" --link some-mysql:db -d ozzyboshi/lettureeneldockerimage
```

CONFIGURAZIONE
-------------

### Utenti

Ad installazione avvenuta è possibile autenticarsi come amministratore cliccando sul tasto Login in alto a destra, le credenziali di accesso sono admin/admin.

Ovviamente è conigliato cambiare la password di amministrazione dopo il primo accesso.
E' inoltre possibile creare nuovi utenti, una volta creato un nuovo utente occorre assegnargli i permessi di admin attraverso la pagina /index.php/admin/assignment, questa operazione inizialmente è concessa solo all'utente admin.

In questo momento non esiste una procedura di cancellazione utenti.

### Demo

E' presente una demo online di questa applicazione all'indirizzo [http://lettureenel.ozzyboshi.com/](http://lettureenel.ozzyboshi.com/) oppure in versione sicura all'indirizzo [https://lettureenel.ozzyboshi.com/](https://lettureenel.ozzyboshi.com/)


