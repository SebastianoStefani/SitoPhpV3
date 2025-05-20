<?php
session_start(); // Inizia la sessione
require_once('database.php'); // Connessione al database

$msg = ''; // Variabile per i messaggi di errore o successo

// Controlla se il form è stato inviato
if (isset($_POST['register'])) {
    // Prendi i dati dal form e rimuovi spazi
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validazione dei dati
    if (empty($nome) || empty($cognome) || empty($username) || empty($email) || empty($password)) {
        $msg = 'Compila tutti i campi';
    } elseif (!validatePassword($password)) {
        $msg = "La password deve essere lunga tra 8 e 12 caratteri e contenere almeno una lettera maiuscola, una lettera minuscola e un carattere speciale";
    } elseif (!validateUsername($username)) {
        $msg = 'L\'username può contenere solo lettere, numeri e underscore';
    } elseif (!validateName($nome)) {
        $msg = 'Il nome non può contenere caratteri speciali';
    } elseif (!validateName($cognome)) {
        $msg = 'Il cognome non può contenere caratteri speciali';
    } elseif (!validateLength($username, 4, 20)) {
        $msg = 'L\'username deve essere lungo tra i 4 e i 20 caratteri';
    } elseif (!validateLength($nome, 2, 20)) {
        $msg = 'Il nome deve essere lungo tra i 2 e i 20 caratteri';
    } elseif (!validateLength($cognome, 2, 20)) {
        $msg = 'Il cognome deve essere lungo tra i 2 e i 20 caratteri';
    } else {
        // Controlla se l'username è già in uso
        $recuperauser = mysqli_query($con, "SELECT id FROM login WHERE username='$username'") or die(mysqli_error($con));
        $num_user = mysqli_num_rows($recuperauser);
        if ($num_user > 0) {
            $msg = 'Username già in uso';
        } else {
            // Hash della password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Inserisci l'utente nel database
            $inserimentouser = mysqli_query($con, "INSERT INTO login (username, password, nome, cognome, email) VALUES('$username', '$password', '$nome', '$cognome', '$email')") or die(mysqli_error($con));
            if ($inserimentouser > 0) {
                $msg = 'Registrazione eseguita con successo';
            } else {
                $msg = 'Problemi con l\'inserimento dei dati';
            }
        }
    }
}

// Funzione per validare la password
function validatePassword($password) {
    return strlen($password) >= 8 && strlen($password) <= 12 && preg_match("/^(?=.*\d)(?=.*[.*@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z.*@#\-_$%^&+=§!\?]{8,12}$/", $password);
}

// Funzione per validare l'username
function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9_]+$/', $username);
}

// Funzione per validare nome e cognome
function validateName($name) {
    return !preg_match("/[^a-zA-Z\d\s]/", $name);
}

// Funzione per validare la lunghezza di una stringa
function validateLength($string, $min, $max) {
    return strlen($string) >= $min && strlen($string) <= $max;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>S & the 3 Ms - Registrazione</title>
        <!-- Icona del sito -->
        <link rel="website icon" type="png" href="LOGO.png">
        <!-- Font Google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <!-- Foglio di stile personalizzato -->
        <link rel="stylesheet" href="styleRegister.css">
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
        <!-- Form di register -->
        <form method="post" action="register.php">
            <h1>Registrazione</h1>
            <!-- Messaggio di errore o successo -->
            <?php if (!empty($msg)): ?>
                <div class="msg"><?php echo $msg; ?></div>
            <?php endif; ?>
            <input type="text" id="nome" placeholder="Nome" name="nome" maxlength="50" required>
            <input type="text" id="cognome" placeholder="Cognome" name="cognome" maxlength="50" required>
            <input type="text" id="username" placeholder="Username" name="username" maxlength="50" required>
            <input type="email" id="email" placeholder="Email" name="email" maxlength="50" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <p></p>
            <button type="submit" name="register">Registrati</button>
            <p> Sei registrato?       <a href="login.php"> Login </a> </p>
        </form>
        <footer>
            <p>&copy; 2025 S & the 3 Ms. Tutti i diritti riservati.</p>
        </footer>
    </body>
</html>