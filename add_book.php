<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=lazzaroni_biblioteca", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Could not connect. " . $e->getMessage());
    }

    if ($_POST) {
        $titolo = $_POST['titolo'];
        $anno_pubblicazione = $_POST['anno_pubblicazione'];
        $isbn = $_POST['isbn'];
        $autore_id = $_POST['autore'];

        try {
            $sql = "INSERT INTO libri (titolo, anno_pubblicazione, isbn, id_autore) VALUES (:titolo, :anno_pubblicazione, :isbn, :id_autore)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':titolo', $titolo);
            $stmt->bindParam(':anno_pubblicazione', $anno_pubblicazione);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':id_autore', $autore_id);
            $stmt->execute();
            echo "Libro aggiunto con successo.";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>