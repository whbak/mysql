<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland add serie</title>
    </head>
        <?php
        /* pdo connect to mysql phpmyadmin database */
        $host = 'localhost';
        $db = 'netland';
        $user = 'bit_academy';
        $password = 'bit_academy';
        $charset = 'latin1';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [];
        try {
            $pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        /* mysql queries - - - - - - - - - - - - - */
        ?>
    <!- echo - - - - - - - - - - - - - - - - - ->
    <body>
        <?php
        echo "<div class=\"kop\">Nieuwe serie</div>";
        $rowlink = "/index.php";  
        $rowname = "* Terug";
        /* ------- wijzigen data ---------------------------- */
        echo "<form action=\"\" method=\"post\">";
            echo "<table class=\"backcol\">";
            echo "<tr><th><spanfont><a href=\"$rowlink\">" . $rowname . "</a></spanfont></th></tr>";
            echo "<div class=\"sum\"><tr><td><span>Title </span></td><td><input type=\"text\" id=\"title\" name=\"title\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Rating? </span></td><td><input type=\"number\" step=\"any\" id=\"rating\" name=\"rating\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Has won awards? </span></td><td><input type=\"number\" id=\"has_won_awards\" name=\"has_won_awards\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Seasons </span></td><td><input type=\"text\" id=\"seasons\" name=\"seasons\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Country </span></td><td><input type=\"text\" id=\"country\" name=\"country\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Language </span></td><td><input type=\"text\" id=\"spoken_in_language\" name=\"spoken_in_language\" value=\"\"></input></td></tr>";
            echo "<tr><td><spansum>Summary </spansum></td><td><textarea id=\"summary\" name=\"summary\" rows=\"12\" cols=\"30\"> </textarea></td></tr></div>";
            echo "<tr><td><input type=\"submit\" value=\"Toevoegen\"></td></tr>";
            echo "</table>";
        echo "</form>";
        /* --- tabel rows lezen en updaten ... */
        /* DELETE FROM series WHERE id = 7; */
        if (!empty($_POST)) {
            $sqlinsert = "INSERT INTO `series` (`title`, `rating`, `summary`, `has_won_awards`, `seasons`, `country`, `spoken_in_language`)
            VALUES (:uptitle, :uprating, :upsummary, :uphas_won_awards, :upseasons, :upcountry, :upspoken_in_language)";
            try {
                $stmt = $pdo->prepare($sqlinsert);
                $stmt->execute([":uptitle" => $_POST["title"], ":uprating" => $_POST["rating"], ":upsummary" => $_POST["summary"], ":uphas_won_awards" => $_POST["has_won_awards"], 
                ":upseasons" => $_POST["seasons"], ":upcountry" => $_POST["country"], ":upspoken_in_language" => $_POST["spoken_in_language"]]);
            } catch (Exception $err) {
                echo $err->getMessage();
            } //try
        } //if
        ?>
    </body>
</html>