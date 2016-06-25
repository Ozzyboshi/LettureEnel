<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'LettureEnel Applicazione web';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<p>LettureEnel è una applicazione web per registrare e tenere traccia dei consumi rilevati da contatori ENEL in regime di scambio sul posto.</p>
	<p>Letture Enel permette di registrare su di un database mysql ciò che viene riportato dai contatori Enel, in particolare:</p>
	<ul>
	<li>Consumi da rete ENEL</li>
	<li>Immissioni del proprio impianto fotovoltaico su rete ENEL</li>
	<li>Produzione del proprio impianto fotovoltaico
	Tutti gli inserimenti sono divisi per fascia oraria (F1,F2 e F3).</li>
	</ul>
	<p>Da questi dati di input viene poi calcolata una pagina con i delta dei consumi per ogni intervallo temporale, il calcolo dei consumi sfruttando la produzione del fotovoltaico e un suo rapporto con i consumi totali.</p>
	<h2><a id="REQUISITI_13"></a>REQUISITI</h2>
	<p>Un interprete php e un server MySQL e un web server.</p>
	<h2><a id="INSTALLAZIONE_18"></a>INSTALLAZIONE</h2>
	<h3><a id="Installazione_da_sorgenti_21"></a>Installazione da sorgenti</h3>
	<ul>
	<li>Clonare i sorgenti dal <a href="https://github.com/Ozzyboshi/LettureEnel.git">Github repository</a> in una directory sotto la Web root (solitamente /var/www).</li>
	<li>Editare il file config/db.php e immettere i dati necessari alla connessione al server MySQL come da esempio:</li>
	</ul>
	<pre><code class="language-php"><span class="hljs-keyword">return</span> [
	    <span class="hljs-string">'class'</span> =&gt; <span class="hljs-string">'yii\db\Connection'</span>,
	    <span class="hljs-string">'dsn'</span> =&gt; <span class="hljs-string">'mysql:host=localhost;dbname=lettureenel'</span>,
	    <span class="hljs-string">'username'</span> =&gt; <span class="hljs-string">'root'</span>,
	    <span class="hljs-string">'password'</span> =&gt; <span class="hljs-string">'1234'</span>,
	    <span class="hljs-string">'charset'</span> =&gt; <span class="hljs-string">'utf8'</span>,
	];
	</code></pre>
	<ul>
	<li>Lanciare composer update per generare la cartella ‘vendor’</li>
	<li>Creare le tabelle e i records necessari per il funzionamento della applicazione web, per fare cio lanciare ./yii migrate dalla root del progetto.</li>
	<li>Se non si dispone di un proprio server web lanciare ./yii serve</li>
	<li>Richiamare la applicazione web dal proprio browser inserendo l’indirizzo ip del server</li>
	</ul>
	<h3><a id="Installazione_con_Docker_39"></a>Installazione con Docker</h3>
	<p>Per installare la applicazione web usando docker occorre prima creare un container con un server mysql e creare il database che conterrà i dati, ad esempio:</p>
	<pre><code>docker run --name some-mysql -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql
	docker exec -it some-mysql mysql -e &quot;create database lettureenel&quot; -pmy-secret-pw -u root --host localhost
	</code></pre>
	<p>quindi procedere con il container che conterrà l’installazione vera e propria della applicazione web:</p>
	<pre><code>docker run --name lettureenel -p 80:80 -e &quot;DB_USER=root&quot; -e &quot;DB_PASS=my-secret-pw&quot; -e &quot;DB_STRING=mysql:host=db;dbname=lettureenel&quot; -e &quot;DATALOGGER_URL=http://home1.solarlog-web.it/&quot; --link some-mysql:db -d ozzyboshi/lettureeneldockerimage
	docker exec -it lettureenel ./yii migrate
	</code></pre>
	<h2><a id="CONFIGURAZIONE_52"></a>CONFIGURAZIONE</h2>
	<h3><a id="Utenti_55"></a>Utenti</h3>
	<p>Ad installazione avvenuta è possibile autenticarsi come amministratore cliccando sul tasto Login in alto a destra, le credenziali di accesso sono admin/admin.</p>
	<p>Ovviamente è conigliato cambiare la password di amministrazione dopo il primo accesso.
	E’ inoltre possibile creare nuovi utenti, una volta creato un nuovo utente occorre assegnargli i permessi di admin attraverso la pagina /index.php/admin/assignment, questa operazione inizialmente è concessa solo all’utente admin.</p>
	<p>In questo momento non esiste una procedura di cancellazione utenti.</p>
	<h3><a id="Demo_64"></a>Demo</h3>
	<p>E’ presente una demo online di questa applicazione all’indirizzo <a href="http://lettureenel.ozzyboshi.com/">http://lettureenel.ozzyboshi.com/</a></p>
</div>
