<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland edit serie</title>
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
        $rowi = $_GET["id"];
        $sql = "SELECT * FROM series WHERE id = $rowi";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        if ($row["has_won_awards"] > 0) {
            $award = "ja"; 
        } else {
            $award = "nee";
        }
        echo "<div class=\"kop\">" . $row["title"] . "</div>";
        $rowlink = "/index.php";  
        $rowname = "* Terug";
        /* ------- wijzigen data ---------------------------- */
        $rowtitle = $row["title"];
        $rowrating = $row["rating"];
        $rowseasons = $row["seasons"];
        $rowcountry = $row["country"];
        $rowlanguage = $row["spoken_in_language"];
        $rowsummary = $row["summary"];
        echo "<form action=\"\" method=\"post\">";
            echo "<table class=\"backcol\">";
            echo "<tr><th><spanfont><a href=\"$rowlink\">" . $rowname . "</a></spanfont></th></tr>";
            echo "<div class=\"sum\"><tr><td><span>Title </span></td><td><input type=\"text\" id=\"title\" name=\"title\" value=\"$rowtitle\"></input></td></tr>";
            echo "<tr><td><span>Rating? </span></td><td><input type=\"number\" step=\"any\" id=\"rating\" name=\"rating\" value=\"$rowrating\"></input></td></tr>";
            echo "<tr><td><span>Awards? </span></td><td>" . $award . "</td></tr><br>";
            echo "<tr><td><span>Seasons </span></td><td><input type=\"text\" id=\"seasons\" name=\"seasons\" value=\"$rowseasons\"></input></td></tr>";
            echo "<tr><td><span>Country </span></td><td><input type=\"text\" id=\"country\" name=\"country\" value=\"$rowcountry\"></input></td></tr>";
            echo "<tr><td><span>Language </span></td><td><input type=\"text\" id=\"spoken_in_language\" name=\"spoken_in_language\" value=\"$rowlanguage\"></input></td></tr>";
            echo "<tr><td><spansum>Summary </spansum></td><td><textarea id=\"summary\" name=\"summary\" rows=\"12\" cols=\"30\">$rowsummary</textarea></td></tr></div>";
            echo "<tr><td><input type=\"submit\" value=\"Wijzigen\"></td></tr></div>";
            echo "</table>";
        echo "</form>";
        /* --- tabel rows lezen en updaten ... */
        if (!empty($_POST)) {
            $sqlupdate = "UPDATE series SET title = :uptitle, rating = :uprating, seasons = :upseasons, country = :upcountry, 
            spoken_in_language = :upspoken_in_language, summary = :upsummary WHERE id = :idee";
            try {
                $stmt = $pdo->prepare($sqlupdate);
                $stmt->execute([":uptitle" => $_POST["title"], ":uprating" => $_POST["rating"], ":upseasons" => $_POST["seasons"],
                ":upcountry" => $_POST["country"], ":upspoken_in_language" => $_POST["spoken_in_language"], ":upsummary" => $_POST["summary"], "idee" => $rowi]);
            } catch (Exception $err) {
                echo $err->getMessage();
            } //try
        } //if
        echo '<br><br> einde program <br>' 
        ?>
    </body>
</html>