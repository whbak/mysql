<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland films</title>
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
        $sql = "SELECT * FROM movies WHERE id = $rowi";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        echo "<div class=\"kop\">" . $row["title"] . "</div>";
        $rowlink = "/index.php";  
        $rowname = "* Terug";
         /* ------- wijzigen data ---------------------------- */
        $rowtitle = $row["title"];
        $rowlength = $row["length_in_minutes"];
        $rowreleased_at = $row["released_at"];
        $rowcountry = $row["country_of_origin"];
        $rowsummary =  $row["summary"];
        $rowyoutube_trailer_id = $row["youtube_trailer_id"];
        echo "<form action=\"\" method=\"post\">";
            echo "<table class=\"backcol\">";
            echo "<tr><th><spanfont><a href=\"$rowlink\">" . $rowname . "</a></spanfont></th></tr>";
            echo "<div class=\"sum\"><tr><td><span>Titel </span></td><td><input type=\"text\" id=\"title\" name=\"title\" value=\"$rowtitle\"]\"></input></td></tr>";
            echo "<tr><td><span>Duur </span></td><td><input type=\"number\" step=\"any\" id=\"length_in_minutes\" name=\"length_in_minutes\" value=\"$rowlength\"]></input></td></tr>";
            echo "<tr><td><span>Datum van uitkomst </span></td><td><input type=\"text\" id=\"released_at\" name=\"released_at\" value=\"$rowreleased_at\" ></input><td></tr>";
            echo "<tr><td><span>Land van uitkomst </span></td><td><input type=\"text\" id=\"country_of_origin\" name=\"country_of_origin\" value=\"$rowcountry\"></input></td></tr>";
            echo "<tr><td><spansum>Omschrijving </spansum></td><td><textarea id=\"summary\" name=\"summary\" rows=\"12\" cols=\"30\">$rowsummary</textarea></td></tr>";
            echo "<tr><td><span>Youtube trailer ID </span></td><td><input type=\"text\" id=\"youtube_trailer_id\" name=\"youtube_trailer_id\" value=\"$rowyoutube_trailer_id\">
            </input></td></tr></div>";
            echo "<tr><td><input type=\"submit\" value=\"Wijzigen\"></td></tr></div>";
            echo "</table>";
        echo "</form>";
        /* --- tabel rows lezen en updaten ... */
        if (!empty($_POST)) {
            $sqlupdate = "UPDATE movies SET title = :uptitle, length_in_minutes = :uplength_in_minutes, released_at = :upreleased_at, 
            country_of_origin = :upcountry_of_origin, summary = :upsummary, youtube_trailer_id = :upyoutube_trailer_id WHERE id = :idee";
            try {
                $stmt = $pdo->prepare($sqlupdate);
                $stmt->execute([":uptitle" => $_POST["title"], ":uplength_in_minutes" => $_POST["length_in_minutes"], ":upreleased_at" => $_POST["released_at"],
                ":upcountry_of_origin" => $_POST["country_of_origin"], ":upsummary" => $_POST["summary"], ":upyoutube_trailer_id" => $_POST["youtube_trailer_id"], "idee" => $rowi]);
            } catch (Exception $err) {
                echo $err->getMessage();
            } //catch
        } //if
        echo '<br><br> einde program <br>'
        ?>
    </body>
</html>