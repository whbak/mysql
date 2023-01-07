<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland beheer</title>
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
            /* mysql queries --------------------------------- */
            $sertit = "SELECT * FROM series ORDER BY title ASC";
            $serrat = "SELECT * FROM series ORDER BY rating DESC";
            $filtit = "SELECT * FROM movies ORDER BY title ASC";
            $fillen = "SELECT * FROM movies ORDER BY length_in_minutes DESC";
            ?>
    <!-- query series en film query order ---------------->
    <body>
        <div class="kop">Welkom op het netland beheerders paneel</div>
        <div class="kopje">Series</div>
        <!-- get series titel of rating ----->
        <?php
        if (isset($_GET["series"])) {
            $series = $_GET["series"];
            if ($_GET["series"] == "rating") {
                $sqls = $serrat;
            } else {
                $sqls = $sertit;
            }
        } else {
            $sqls = $sertit;
            $series = "titel";
        }
        /* -- get films titel of duur ----- */
        if (isset($_GET["films"])) {
            $films = $_GET["films"];
            if ($_GET["films"] == "duur") {
                $sqlf = $fillen;
            } else {
                $sqlf = $filtit;
            }
        } else {
            $sqlf = $filtit;
            $films = "titel";
        }
        ?>
        <!-- query series titel en rating keuze --------------->
        <table class="backcol">
            <form action="index.php" method="get"><br>
                <tr><th><a href="index.php?series=titel&films=<?php echo $films ?>">Titel</a></th>
                <th><a href="index.php?series=rating&films=<?php echo $films ?>">Rating</a></th</tr>
            </form>
            <!-- query - fetch series --------->
            <?php
            $result = $pdo->query($sqls);
            while ($row = $result->fetch()) {
                $rowname = "Bekijk details";
                $rownameedit = "Wijzigen";
                $rowid = $row["id"];
                $link = "series.php?id=" . $rowid;
                $linkedit = "edit_serie.php?id=" . $rowid;
                echo "<tr><td>" . $row["title"] . "</td><td>" . $row["rating"] . "</td><td>";
                echo "<a href=\"$link\" target=\"_blank\">" . $rowname . "</a></td><td>";
                echo "<a href=\"$linkedit\" target=\"_blank\">" . $rownameedit . "</a></td></tr>";
            }
            echo "<tr><td>Nieuwe serie</td><td></td><td></td><td><a href=\"add_serie.php\" target=\"_blank\">Toevoegen</a></td></tr>";
            if (isset($_GET["series"])) {
                echo "<tr><td><span2>Active sorting: " . $series . "</span2></td></tr>";
            }
            ?> 
        </table>
        <!-- query films titel en duur keuze --------------->
        <div class="kopje">Films</div>
        <table class="backcol">
            <form action="index.php" method="get"><br>
                <tr><th><a href="index.php?films=titel&series=<?php echo $series ?>">Titel</a></th>
                <th><a href="index.php?films=duur&series=<?php echo $series ?>">Duur</a></th></tr>
            </form>              
            <?php
            /* query - fetch films - - - - - - - */
            $result2 = $pdo->query($sqlf);
            while ($row2 = $result2->fetch()) {
                $rowname2 = "Bekijk details";
                $rowname2edit = "Wijzigen";
                $rowid2 = $row2["id"];
                $link2 = "films.php?id=" . $rowid2;
                $link2edit = "edit_film.php?id=" . $rowid2;
                echo "<tr><td>" . $row2["title"] . "</td><td>" . $row2["length_in_minutes"] . "</td><td>";
                echo "<a href=\"$link2\" target=\"_blank\">" . $rowname2 . "</a></td><td>";
                echo "<a href=\"$link2edit\" target=\"_blank\">" . $rowname2edit . "</a></td></tr>";
            }
            echo "<tr><td>Nieuwe film</td><td></td><td></td><td><a href=\"add_film.php\" target=\"_blank\">Toevoegen</a></td></tr>";
            if (isset($_GET["films"])) {
                echo "<tr><td><span2>Active sorting: " . $films . "</span2></td></tr>";
            }
            ?>
        </table>
    </body>
</html>