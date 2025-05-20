query per creare le tabelle SQL:

-- Tabella utenti
CREATE TABLE login (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL, 
    cognome VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL  
);

-- Tabella cronologia cifrature/decifrature
CREATE TABLE cesare_cronologia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(50) NOT NULL,
    operazione VARCHAR(20) NOT NULL,
    frase_originale TEXT NOT NULL,
    shift INT NOT NULL,
    risultato TEXT NOT NULL,
    data DATETIME NOT NULL,
    FOREIGN KEY (user) REFERENCES login(username) ON DELETE CASCADE
);