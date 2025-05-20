<?php
session_start(); // Avvia la sessione PHP
require_once('database.php'); // Include il file per la connessione al database

$msg = ''; // Variabile per i messaggi di errore o info

// Controlla se l'utente è già loggato
if (isset($_SESSION['session_id'])) {
    echo "Hai già effettuato l'accesso. Per favore, esci prima.";
    echo '<br><a href="logout.php">Logout</a>';
    exit; // Interrompe l'esecuzione se già loggato
}

// Controlla se il form di login è stato inviato
if (isset($_POST['login'])) {
    $username = trim($_POST['username']); // Prende lo username dal form e rimuove spazi
    $password = trim($_POST['password']); // Prende la password dal form e rimuove spazi

    // Controlla che username e password non siano vuoti
    if (empty($username) || empty($password)) {
        $msg = 'Compila tutti i campi';
    } else {
        // Prepara la query SQL per recuperare i dati dell'utente
        $query = "SELECT username, password, nome, cognome, email FROM login WHERE username = ?";
        $stmt = mysqli_prepare($con, $query); // Prepara la query in modo sicuro
        mysqli_stmt_bind_param($stmt, "s", $username); // Collega il parametro username
        mysqli_stmt_execute($stmt); // Esegue la query
        $result = mysqli_stmt_get_result($stmt); // Ottiene il risultato

        // Controlla se l'utente esiste
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); // Prende i dati dell'utente
            $usernameDB = $row['username'];
            $passwordDB = $row['password'];

            // Verifica che la password inserita corrisponda a quella salvata (hash)
            if (password_verify($password, $passwordDB)) {
                // Crea la sessione utente
                session_regenerate_id(); // Rigenera l'ID sessione per sicurezza
                $_SESSION['session_id'] = session_id();
                $_SESSION['session_user'] = $usernameDB;
                $_SESSION['session_name'] = $row['nome'];
                $_SESSION['session_surname'] = $row['cognome'];
                $_SESSION['session_email'] = $row['email'];
                header('Location: index.php'); // Reindirizza alla home
                exit;
            } else {
                $msg = 'Password errata'; // Password non corretta
            }
        } else {
            $msg = 'Utente non trovato'; // Username non esistente
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>S & the 3 Ms - Login</title>
        <!-- Icona del sito -->
        <link rel="website icon" type="png" href="LOGO.png">
        <!-- Font Google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <!-- Foglio di stile personalizzato -->
        <link rel="stylesheet" href="styleLogin.css">
    </head>
    <body>
        <header>
            <!-- Logo e titolo -->
            <a href="index.php"><button id="nav-home"><img class="logo" src="LOGO.png" alt="S & the 3 Ms logo, stylized, BLUE, with white background" /></button></a>
            <h1>S & the 3 Ms</h1>
            <!-- Navigazione -->
            <nav>
                <a href="register.php"><button id="nav-register">Register</button></a>
                <a href="login.php"><button id="nav-login">Login</button></a>
            </nav>
        </header>
        <!-- Form di login -->
        <form method="post" action="login.php">
            <h1>Login</h1>
            <!-- Messaggio di errore o info -->
            <?php if (!empty($msg)): ?>
                <div class="msg"><?php echo $msg; ?></div>
            <?php endif; ?>
            <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <p></p>
            <button type="submit" name="login">Accedi</button>
            <p>Non hai un account?        <a href="register.php">Registrati</a></p>
        </form>
        <footer>
            <p>&copy; 2025 S & the 3 Ms. Tutti i diritti riservati.</p>
        </footer>
    </body>
</html>