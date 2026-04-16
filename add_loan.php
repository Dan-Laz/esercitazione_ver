<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_libro = $_POST['id_libro'];
        $id_utente = $_POST['id_utente'];
        $data_inizio = $_POST['data_inizio'];
        $data_fine_prevista = $_POST['data_fine_prevista'];

        try {
            $sql = "INSERT INTO prestiti (id_libro, id_utente, data_inizio, data_fine_prevista) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_libro, $id_utente, $data_inizio, $data_fine_prevista]);
            echo "Loan added successfully!";
        } catch(PDOException $e) {
            echo "Error adding loan: " . $e->getMessage();
        }
    }

    $conn = null;
?>
