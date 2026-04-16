<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Loan</title>
</head>
<body>
    <h1>Add Loan</h1>
    <form action="" method="post">
        <label for="libro">Book:</label>
        <select name="id_libro" required>
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

                try {
                $sql = "SELECT id_libro, titolo FROM libri;";
                $result = $conn->query($sql);
                $libri = $result->fetchAll();

                foreach ($libri as $libro) {
                    echo "<option value='" . $libro['id_libro'] . "'>" . $libro['titolo'] . "</option>";
                }
                } catch(PDOException $e) {
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }
            ?>
        </select><br><br>

        <label for="utente">User:</label>
        <select name="id_utente" required>
            <?php
                try {
                $sql = "SELECT id_utente, nome, cognome FROM utenti;";
                $result = $conn->query($sql);
                $utenti = $result->fetchAll();

                foreach ($utenti as $utente) {
                    echo "<option value='" . $utente['id_utente'] . "'>" . $utente['nome'] . " " . $utente['cognome'] . "</option>";
                }
                } catch(PDOException $e) {
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }
            ?>
        </select><br><br>

        <label for="data_inizio">Start Date:</label>
        <input type="date" name="data_inizio" required><br><br>

        <label for="data_fine_prevista">Expected Return Date:</label>
        <input type="date" name="data_fine_prevista" required><br><br>

        <input type="submit" value="Add Loan">
    </form>

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
</body>
</html>
