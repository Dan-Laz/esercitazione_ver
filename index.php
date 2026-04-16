
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Biblioteca</h1>
    <h2>books</h2>
    <p><?php
                $servername = "localhost";
                $username = "root";
                $password = "";

                try {
                $conn = new PDO("mysql:host=$servername;dbname=lazzaroni_biblioteca", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                die("Could not connect. " . $e->getMessage());
                }

                try {
                $sql = "SELECT * FROM libri;";
                $result = $conn->query($sql);
                $libri = $result->fetchAll();

                foreach ($libri as $libro) {
                    echo "Titolo: " . $libro['titolo'] . ", Anno di pubblicazione: " . $libro['anno_pubblicazione'] . ", ISBN: " . $libro['isbn'] . "<br>";
                }



                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
            ?></p>

    <form action="add_book.php" method="post">
        <label>aggiungi libro</label>
        <input type="text" name="titolo" placeholder="titolo" required>
        <input type="number" min="1900" max="2100" step="1" value="2026" name="anno_pubblicazione" required>
        <input type="text" name="isbn" placeholder="isbn" required>
        <select name="autore" required>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";

                try {
                $conn = new PDO("mysql:host=$servername;dbname=lazzaroni_biblioteca", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e) {
                die("Could not connect. " . $e->getMessage());
                }

                try {
                $sql = "SELECT id_autore, nome, cognome FROM autori;";
                $result = $conn->query($sql);
                $autors = $result->fetchAll();

                foreach ($autors as $autor) {
                    echo "<option value='" . $autor['id_autore'] . "'>" . $autor['nome'] . " " . $autor['cognome'] . "</option>";
                }



                } catch(PDOException $e) {
                // Handle errors during query execution
                echo "Error executing query: " . $sql . "<br>" . $e->getMessage();
                }

                // Close connection
                $conn = null;
            ?>
        </select>
        <input type="submit" value="aggiungi">
    </form>
</body>
</html>