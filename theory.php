<?php
session_start();
$logged_in = isset($_SESSION['session_id']);
?>
<!DOCTYPE html>
<html>
  <head>
      <title>S & the 3 Ms - Teoria</title>
      <link rel="website icon" type="png" href="LOGO.png">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
      <link rel="stylesheet" href="styleIndex.css">
  </head>
  <body>
      <header>
          <a href="index.php"><button id="nav-home"><img class="logo" src="LOGO.png" alt="S & the 3 Ms logo" /></button></a>
          <h1>S & the 3 Ms</h1>
          <nav>
              <?php if (!$logged_in): ?>
                  <button id="nav-logout" disabled>Logout</button>
              <?php else: ?>
                <a href="theory.php"><button id="nav-theory">Teoria</button></a>
                <a href="crypto.php"><button id="nav-theory">Cifrario di Cesare</button></a>
                <a href="cronologia.php"><button id="nav-theory">Cronologia richieste</button></a>  
                <a href="logout.php"><button id="nav-logout">Logout</button></a>
              <?php endif; ?>
          </nav>
      </header>
      
      <section id="cryptovalute">
          <h2>Crypto Valute:</h2>
          <div><img src="Screenshot 2025-05-17 213650.png" alt="Foto token crypto" width="612" height="376" class="centra-img"></div>
          <p>Le nuove tecnologie stanno determinando un cambiamento radicale nell'economia globale, con particolare riferimento al settore finanziario, sotto il profilo delle modalità di scambio di beni, servizi e ogni attività finanziaria.</p>
          <p class="light-blue"><strong>Tra le più significative applicazioni della tecnologia digitale al settore finanziario spicca la nascita delle "criptovalute" (o "valute virtuali"), la più nota delle quali è il bitcoin.</strong></p>
          <p>Si tratta quindi di valuta ‘nascosta', nel senso che è visibile/utilizzabile solo conoscendo un determinato codice informatico (le c.d. ‘chiavi di accesso' pubblica e privata) → SI SFRUTTA QUINDI LA crittografia a chiave pubblica</p>
          <h3>Tipologie criptovalute:</h3>
          <ul>
              <li><strong>chiusa:</strong> NON è possibile scambiare la criptovaluta con moneta a corso legale (o valuta ‘ufficiale' o ‘moneta fiat', secondo altre comuni denominazioni)</li>
              <li><strong>unidirezionale:</strong> soluzione ibrida dove è consentito solo passare da valuta ufficiale a virtuale</li>
              <li><strong>bidirezionale:</strong> è possibile scambiare la criptovaluta con moneta a corso legale (o valuta ‘ufficiale' o ‘moneta fiat', secondo altre comuni denominazioni)</li>
          </ul>
          <h3>Un esempio:</h3>
          <ul>
              <li>Un esempio è il <strong>bitcoin</strong> che è una moneta virtuale bidirezionale in quanto può essere facilmente convertita con le principali valute ufficiali e viceversa.</li>
          <ul>
      </section>
      <section id="reti">
      <h1>Reti Internet</h1>
          <h2>🌐 Cos'è Internet</h2>
          <p>Internet è una <strong>rete di reti</strong>, un’infrastruttura globale che collega milioni di reti locali, metropolitane e geografiche in tutto il mondo. È un sistema distribuito e decentralizzato.</p>
          <h2>📡 Elementi principali di una rete Internet</h2>
          <ul>
            <li><strong>Host</strong>: dispositivi connessi alla rete, come PC o smartphone.</li>
            <li><strong>Router</strong>: instrada i pacchetti verso la destinazione.</li>
            <li><strong>Switch/Hub</strong>: collegano più dispositivi in una rete locale.</li>
            <li><strong>Modem</strong>: collega la rete domestica a Internet tramite l'ISP.</li>
          </ul>
          <h2>📦 Trasferimento dei dati: pacchetti</h2>
          <p>I dati vengono suddivisi in <strong>pacchetti</strong>, inviati separatamente e ricostruiti alla destinazione.</p>
          <h2>🔗 Protocolli fondamentali</h2>
          <ul>
            <li><code>TCP/IP</code>: regola il trasporto e l’indirizzamento dei pacchetti.</li>
            <li><code>HTTP/HTTPS</code>: per il trasferimento delle pagine web.</li>
            <li><code>DNS</code>: traduce i nomi di dominio in indirizzi IP.</li>
          </ul>
          <h2>🛠️ Struttura a livelli (Modello TCP/IP)</h2>
          <table>
            <thead>
              <tr>
                <th>Livello</th>
                <th>Funzione</th>
                <th>Esempi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Applicazione</td>
                <td>Interazione con l'utente</td>
                <td>HTTP, FTP, SMTP, DNS</td>
              </tr>
              <tr>
                <td>Trasporto</td>
                <td>Gestione della comunicazione tra host</td>
                <td>TCP, UDP</td>
              </tr>
              <tr>
                <td>Internet</td>
                <td>Instradamento dei pacchetti</td>
                <td>IP</td>
              </tr>
              <tr>
                <td>Rete / Accesso</td>
                <td>Connessione fisica e trasmissione dati</td>
                <td>Ethernet, Wi-Fi</td>
              </tr>
            </tbody>
          </table>
          <h2>🧠 Concetti chiave</h2>
          <ul>
            <li><strong>Indirizzo IP</strong>: numero identificativo del dispositivo.</li>
            <li><strong>MAC Address</strong>: indirizzo fisico della scheda di rete.</li>
            <li><strong>Firewall</strong>: protegge la rete filtrando il traffico.</li>
            <li><strong>ISP</strong>: fornitore di accesso a Internet.</li>
          </ul>
          <h2>📈 Evoluzione moderna</h2>
          <p>Internet oggi supporta tecnologie come:</p>
          <ul>
              <li>Cloud computing</li>
              <li>Internet of Things (IoT)</li>
              <li>Streaming e social media</li>
              <li>VPN per sicurezza e privacy</li>
          </ul>   
      </section>
      
      <section id="cifrario">
    
        <h2>Cifrario di Cesare</h2>
        <p>
            Il <strong>cifrario di Cesare</strong> è uno dei più semplici e antichi metodi di crittografia.
            Consiste nello <strong>spostare ogni lettera</strong> del testo originale di un numero fisso di posizioni nell'alfabeto.
        </p>

        <h3>Come funziona?</h3>
        <p>
            È un <em>cifrario a sostituzione</em>: ogni lettera viene sostituita con quella che si trova un certo numero di posizioni dopo.
        </p>

        <h3>Esempio con spostamento di 3:</h3>
        <ul>
            <li>Testo originale: <code>A B C D E</code></li>
            <li>Testo cifrato: <code>D E F G H</code></li>
        </ul>

        <h3>Chiave</h3>
        <p>
            La <strong>chiave</strong> del cifrario è il numero di posizioni di spostamento (es. 3).
        </p>

        <h3>Decifratura</h3>
        <p>
            Per <strong>decifrare</strong> il messaggio, basta spostare le lettere all'indietro di quel numero.
        </p>

        <h3>Limitazioni</h3>
        <ul>
            <li>È molto semplice e facile da violare con analisi delle frequenze o forza bruta.</li>
            <li>Non è adatto per la sicurezza moderna, ma è utile a fini didattici.</li>
        </ul>
      </section>
      
      <section id="contatti">
          <h2>Contattaci su Instagram:</h2>
          <ul>
              <li><a href="https://www.instagram.com/_sebastiano.stefani_/">@_sebastiano.stefani_</a></li>
              <li><a href="https://www.instagram.com/martino_loperfido/">@martino_loperfido</a></li>
              <li><a href="https://www.instagram.com/matteoo.rrampazzo/">@matteoo.rrampazzo</a></li>
              <li><a href="https://www.instagram.com/valvasonmattia/">@valvasonmattia</a></li>
          </ul>
      </section>
      <footer>
          <p>&copy; 2025 S & the 3 Ms. Tutti i diritti riservati.</p>
      </footer>
  </body>
</html>