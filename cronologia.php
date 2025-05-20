<?php
session_start();
$logged_in = isset($_SESSION['session_id']);
require_once('database.php');

$user = $_SESSION['session_user'];
$risultato = '';
$errore = '';
    
    // Gestione cancellazione singola riga
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM cesare_cronologia WHERE id = ? AND user = ?");
    $stmt->bind_param("is", $delete_id, $user);
    $stmt->execute();
    $stmt->close();
    }

    // Gestione cancellazione totale
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    $stmt = $con->prepare("DELETE FROM cesare_cronologia WHERE user = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->close();
    }

    // Recupera cronologia utente (con id per cancellazione)
    $cronologia = [];
    $stmt = $con->prepare("SELECT id, operazione, frase_originale, shift, risultato, data FROM cesare_cronologia WHERE user = ? ORDER BY data DESC");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
      $cronologia[] = $row;
    }
    $stmt->close();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>S & the 3 Ms - Cronologia</title>
        <link rel="website icon" type="png" href="LOGO.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="styleCronologia.css">
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
        
        <section id="cronologia">
            <h2>Cronologia richieste</h2>
            <p>Qui puoi vedere la cronologia delle tue richieste di cifratura e decifratura.</p>
            <div class="center-container">
              <form method="post" style="display:inline;">
                <button type="submit" id="delete_all" name="delete_all" onclick="return confirm('Sei sicuro di voler cancellare tutta la cronologia?');">Cancella tutta la cronologia</button>
              </form>
            </div>
          <table border="1" cellpadding="5">
              <tr>
                  <th>Data</th>
                  <th>Operazione</th>
                  <th>Frase originale</th>
                  <th>Shift</th>
                  <th>Risultato</th>
                  <th>Cancella</th>
              </tr>
              <?php if (empty($cronologia)): ?>
                <tr>
                    <td colspan="6" id='nulla'>Nessuna richiesta trovata</td>
                </tr>
              <?php else: ?>
              <?php foreach ($cronologia as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['data']); ?></td>
                    <td><?php echo htmlspecialchars($row['operazione']); ?></td>
                    <td><?php echo htmlspecialchars($row['frase_originale']); ?></td>
                    <td><?php echo htmlspecialchars($row['shift']); ?></td>
                    <td><?php echo htmlspecialchars($row['risultato']); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" id="delete_id" onclick="return confirm('Cancellare questa riga?');">X</button>
                        </form>
                    </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </table>
        </section>
        <footer>
            <p>&copy; 2025 S & the 3 Ms. Tutti i diritti riservati.</p>
        </footer>
    </body>
</html>