<?php
session_start();
$logged_in = isset($_SESSION['session_id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>S & the 3 Ms - Homepage</title>
        <link rel="website icon" type="png" href="LOGO.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="styleIndex.css">
    </head>
    <body>
        <header>
            <button id="nav-home"><img class="logo" src="LOGO.png" alt="S & the 3 Ms logo" /></button>
            <h1>S & the 3 Ms</h1>
            <nav>
                <?php if (!$logged_in): ?>
                    <a href="register.html"><button id="nav-register">Register</button></a>
                    <a href="login.html"><button id="nav-login">Login</button></a>
                    <a href="theory.php"><button id="nav-theory" disabled>Teoria</button></a>
                    <a href="crypto.php"><button id="nav-theory" disabled>Cifrario di Cesare</button></a>
                    <a href="cronologia.php"><button id="nav-theory" disabled>Cronologia richieste</button></a>
                    <button id="nav-logout" disabled>Logout</button>
                <?php else: ?>
                    <button id="nav-register" disabled>Register</button>
                    <button id="nav-login" disabled>Login</button>
                    <a href="theory.php"><button id="nav-theory">Teoria</button></a>
                    <a href="crypto.php"><button id="nav-theory">Cifrario di Cesare</button></a>
                    <a href="cronologia.php"><button id="nav-theory">Cronologia richieste</button></a>  
                    <a href="logout.php"><button id="nav-logout">Logout</button></a>
                <?php endif; ?>
            </nav>
        </header>

        <section id="home-page">
            <h2>Benvenuto!</h2>
            <p>
                <?php if (!$logged_in): ?>
                    Usa il men&ugrave; in alto per fare il login o registrarsi.
                <?php else: ?>
                    Sei loggato come <?php echo htmlspecialchars($_SESSION['session_user']);?> adesso puoi accedere alle pagine dal sito dal men&ugrave; in alto.
                    <p>Il tuo session ID &egrave;: <?php echo htmlspecialchars($_SESSION['session_id']);?></p>
                <?php endif; ?>
            </p>
            
        
        </section>

        <section id="info">
            <h2>Informazioni personali:</h2>
                <?php if (!$logged_in): ?>
                   <p> Per vedere le informazioni personali, per favore effettua il login.</p>
                <?php else: ?>
                    <ul>
                        <li>Nome: <?php echo htmlspecialchars($_SESSION['session_name']);?> </li>
                        <li>Cognome: <?php echo htmlspecialchars($_SESSION['session_surname']);?> </li>
                        <li>Email: <?php echo htmlspecialchars($_SESSION['session_email']);?> </li>
                    </ul>
                <?php endif; ?>
        </section>

        <section id="servizi">
            <h2>I nostri Sviluppatori</h2>
            <ul>
                <li>Sebastiano Stefani</li>
                <li>Martino Loperfido</li>
                <li>Matteo Rampazzo</li>
                <li>Mattia Valvason detto Sarodine</li>
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