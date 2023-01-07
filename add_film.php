<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland add film</title>
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
        echo "<div class=\"kop\">Nieuwe film</div>";
        $rowlink = "/index.php";  
        $rowname = "* Terug";
        /* ------- wijzigen data ---------------------------- */
        echo "<form action=\"\" method=\"post\">";
            echo "<table class=\"backcol\">";
            echo "<tr><th><spanfont><a href=\"$rowlink\">" . $rowname . "</a></spanfont></th></tr>";
            echo "<div class=\"sum\"><tr><td><span>Titel </span></td><td><input type=\"text\" id=\"title\" name=\"title\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Duur </span></td><td><input type=\"number\" step=\"any\" id=\"length_in_minutes\" name=\"length_in_minutes\" value=\"\"></input></td></tr>";
            echo "<tr><td><span>Datum van uitkomst </span></td><td><input type=\"text\" id=\"released_at\" name=\"released_at\" value=\"\" ></input></td></tr>";
            echo "<tr><td><span>Land van uitkomst </span></td><td><input type=\"text\" id=\"country_of_origin\" name=\"country_of_origin\" value=\"\"></input></td></tr>";
            echo "<tr><td><spansum>Omschrijving </spansum></td><td><textarea id=\"summary\" name=\"summary\" rows=\"12\" cols=\"30\"> </textarea></td></tr>";
            echo "<tr><td><span>Youtube trailer ID </span></td><td><input type=\"text\" id=\"youtube_trailer_id\" name=\"youtube_trailer_id\" value=\"\">
            </input></td></tr></div>";
            echo "<tr><td><input type=\"submit\" value=\"Toevoegen\"></input></td></tr>";
            echo "</table>";
        echo "</form>";
        /* --- tabel rows lezen en updaten ... */
        /* DELETE FROM movies WHERE id = 7; */
        if (!empty($_POST)) {
            $sqlinsert = "INSERT INTO `movies` (`title`, `length_in_minutes`, `released_at`, `country_of_origin`, `summary`, `youtube_trailer_id`)
            VALUES (:uptitle, :uplength_in_minutes, :upreleased_at, :upcountry_of_origin, :upsummary, :upyoutube_trailer_id)";
            try {
                $stmt = $pdo->prepare($sqlinsert);
                $stmt->execute([":uptitle" => $_POST["title"], ":uplength_in_minutes" => $_POST["length_in_minutes"], ":upreleased_at" => $_POST["released_at"],
                ":upcountry_of_origin" => $_POST["country_of_origin"], ":upsummary" => $_POST["summary"], ":upyoutube_trailer_id" => $_POST["youtube_trailer_id"]]);
            } catch (Exception $err) {
                echo $err->getMessage();
            } //catch
        } //if
        ?>
    </body>
</html>