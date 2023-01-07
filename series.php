<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland series</title>
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
        $sql = "SELECT * FROM series";
        ?>
    <!- echo - - - - - - - - - - - - - - - - - ->
    <body>
        <?php    
        $rowlink = "/index.php";  
        $rowname = "Terug";
        echo "<a href=\"$rowlink\">" . $rowname . "</a><br>";
        $rowi = $_GET["id"];
        $sql = "SELECT * FROM series WHERE id = $rowi";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        if ($row["has_won_awards"] > 0) {
            $award = "ja"; 
        } else {
            $award = "nee";
        }
        echo "<div class=\"kop\">" . $row["title"] . " - ";
        echo $row["rating"] . "<br>";
        echo "</div><div class=\"sum\"><span>Awards? </span>" . $award . "<br>";
        echo "<span>Seasons </span>" . $row["seasons"] . "<br>";
        echo "<span>Country </span>" . $row["country"] . "<br>";
        echo "<span>Language </span>" . $row["spoken_in_language"] . "<br><br>";
        echo $row["summary"] . "</div><br>";
        ?>
    </body>
</html>