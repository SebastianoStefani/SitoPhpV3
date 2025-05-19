<?php
session_start();
$logged_in = isset($_SESSION['session_id']);
require_once('database.php');

$user = $_SESSION['session_user'];
$risultato = '';
$errore = '';

// Funzione cifrario di Cesare
function cesare($testo, $shift, $mode = 'cifra') {
    $ris = '';
    $shift = $shift % 26;
    if ($mode === 'decifra') $shift = 26 - $shift;
    for ($i = 0; $i < strlen($testo); $i++) {
        $c = $testo[$i];
        if (ctype_alpha($c)) {
            $base = ctype_upper($c) ? ord('A') : ord('a');
            $c = chr((ord($c) - $base + $shift) % 26 + $base);
        }
        $ris .= $c;
    }
    return $ris;
}

// Gestione invio form cifratura/decifratura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_id']) && !isset($_POST['delete_all'])) {
    $frase = trim($_POST['frase'] ?? '');
    $shift = intval($_POST['shift'] ?? 0);
    $operazione = $_POST['operazione'] ?? 'cifratura';

    if ($frase === '' || $shift < 0) {
        $errore = "Inserisci una frase e uno shift valido.";
    } else {
        $risultato = cesare($frase, $shift, $operazione === 'decifratura' ? 'decifra' : 'cifra');

        // Salva in cronologia
        $stmt = $con->prepare("INSERT INTO cesare_cronologia (user, operazione, frase_originale, shift, risultato, data) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssis", $user, $operazione, $frase, $shift, $risultato);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
  <head>
      <meta charset="UTF-8">
      <title>S & the 3 Ms - Cifrario di Cesare</title>
      <link rel="website icon" type="png" href="LOGO.png">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
      <link rel="stylesheet" href="styleCrypto.css">
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
    
    <section id="cifrario_cesare">
      <h3>Cifrario di Cesare</h3>
          <p class="nota"><strong>Nota:</strong> Per cifrare o decifrare una frase, inserisci il testo e lo shift desiderato.</p>
          <form method="post">
              <label for="frase">Frase:</label><br>
              <input type="text" name="frase" id="frase" required value="<?php echo htmlspecialchars($_POST['frase'] ?? ''); ?>"><br><br>
              <label for="shift">Shift (numero):</label><br>
              <input type="number" name="shift" id="shift" min="0" max="25" required value="<?php echo htmlspecialchars($_POST['shift'] ?? ''); ?>"><br><br>
              <label>Operazione:</label>
              <select name="operazione">
                  <option value="cifratura" <?php if(($_POST['operazione'] ?? '')=='cifratura') echo 'selected'; ?>>Cifra</option>
                  <option value="decifratura" <?php if(($_POST['operazione'] ?? '')=='decifratura') echo 'selected'; ?>>Decifra</option>
              </select><br><br>
              <button type="submit">Esegui</button>
          </form>
          <?php if ($errore): ?>
              <p style="color:red;"><?php echo $errore; ?></p>
          <?php endif; ?>
          <?php if ($risultato): ?>
              <p class="risultato"><strong>Risultato:</strong> <?php echo htmlspecialchars($risultato); ?></p>
          <?php endif; ?>
          <!--<a href="cronologia.php"><button id="nav-cronologia">Visualizza Cronologia</button></a>-->
          <div class="center-container">
               <a href="cronologia.php"><button id="nav-cronologia">Visualizza Cronologia</button></a>
          </div>
        </section>
    <footer>
        <p>&copy; 2025 S & the 3 Ms. Tutti i diritti riservati.</p>
    </footer>
  </body>
</html>