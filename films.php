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
        $sql2 = "SELECT * FROM movies";
        ?>
        <!- echo - - - - - - - - - - - - - - - - - ->
    <body>
        <?php    
        $rowlink = "/index.php";  
        $rowname = "Terug";
        echo "<a href=\"$rowlink\">" . $rowname . "</a><br>";
        $rowi = $_GET["id"];
        $sql = "SELECT * FROM movies WHERE id = $rowi";
        $result = $pdo->query($sql);
        $row = $result->fetch();
            echo "<div class=\"kop\">" . $row["title"] . " - ";
            echo $row["length_in_minutes"] . " minuten <br>";
            echo "</div><div class=\"sum\"><span>Datum van uitkomst </span>" . $row["released_at"] . "<br>";
            echo "<span>Land van uitkomst </span>" . $row["country_of_origin"] . "<br><br>";
            echo $row["summary"] . "</div><br>";
            echo "<div class=\"movie\">";
        switch ($rowi) {
            case "1":
                echo "<iframe class=\"kop\" width=\"676\" height=\"380\" src=\"https://www.youtube.com/embed/xjDjIWPwcPU\" title=\"YouTube video player\" frameborder=\"0\"
                        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                break;
            case "2":
                echo "<iframe width=\"676\" height=\"380\" src=\"https://www.youtube.com/embed/4S8_1PIolnY?list=PLZbXA4lyCtqrQap5U70hgk-s6rcxZOYRK\" title=\"YouTube video player\"
                    frameborder\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                break;
            case "3":
                echo "<iframe width=\"676\" height=\"301\" src=\"https://www.youtube.com/embed/TbQm5doF_Uc\" title=\"YouTube video player\" frameborder=\"0\"
                        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                break;
            case "4":
                echo "<iframe width=\"676\" height=\"380\" src=\"https://www.youtube.com/embed/LKFuXETZUsI\" title=\"YouTube video player\" frameborder=\"0\"
                        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                break;
            case "5":
                echo "<iframe width=\"676\" height=\"380\" src=\"https://www.youtube.com/embed/Xv3G70mm18k\" title=\"YouTube video player\" frameborder=\"0\"
                        allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
                break;
            default:
                echo " geen joetoebe film ";
        }
        echo "</div>";
        ?>
    </body>
</html>