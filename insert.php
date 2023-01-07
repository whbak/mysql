<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="style.css">
        <title>netland media insert</title>
    </head>
        <?php
        /* pdo connect to mysql phpmyadmin database */
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=netland;charset=latin1", "phpmyadmin", "Welkom01");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        /* mysql queries - - - - - - - - - - - - - */
        ?>
    <!- echo - - - - - - - - - - - - - - - - - ->
    <body>
        <div class="kop">Media Toevoegen</div>
        <?php
        $rowlink = "/index.php";  
        $rowname = "* Terug";
        ?>
        <!--------- wijzigen data ---------------------------->      
        <form method="post" action="">
            <table class="backcol">
                <tr><th><spanfont><a href="<?php echo $rowlink ?>"><?php echo $rowname ?></a></spanfont></th></tr>
                <div class="sum"><tr><td><span>Titel: </span></td><td><input type="text" id="title" name="title" value=""></input></td></tr>
                <tr><td><span>Rating: </span></td><td><input type="number" step="any" id="rating" name="rating" value=""></input></td></tr>
                <tr><td><span>Omschrijving: </span></td><td><textarea id="summary" name="summary" rows="6" cols="70"></textarea></td></tr>
                <tr><td><span>Aantal awards: </span></td><td><input type="number" id="awards" name="awards" value=""></input></td></tr>
                <tr><td><span>Lengte in minuten: </span></td><td><input type="number" id="length_in_minutes" name="length_in_minutes" value=""></input></td></tr>
                <tr><td><span>Release datum (mm-dd-yyyy): </span></td><td><input type="date" id="released_at" name="released_at" value=""></input></td></tr>
                <tr><td><span>Seizoenen: </span></td><td><input type="number" id="seasons" name="seasons" value=""></input></td></tr>
                <tr><td><span>Land: </span></td><td><input type="text" id="country" name="country" value=""></input></td></tr>
                <tr><td><span>Type media: </span></td><td><spanbackground><input type="text" id="media" name="media" value=""></input></spanbackground></td></tr>
                <tr><td><span>YT trailer ID: </span></td><td><input type="text" id="youtube_trailer_id" name="youtube_trailer_id" value="">
                </input></td></tr></div>
                <tr><td><span>Type media: </span></td><td><label for="mediatype"> </label>
                <select id="mediatype" name="mediatype">
                    <option value="">Kies</option>
                    <option value="series">Series</option>
                    <option value="movies">Movies</option></td></tr>
                </select>
                <tr><th><label for="submit"><br></label></th></tr>
                <tr><th><input type="submit" value="Aanmaken"></input></th></tr>
                <tr><th><br></th></tr>
                <tr><th><spanfont><background><a href="<?php echo $rowlink ?>"><?php echo $rowname ?></a></background></spanfont></th></tr>    
            </table>
        </form>
        <!-- tabel rows lezen en updaten ... - - - -->
        <?php
        /*--- als er iets in ingevuld op het formulier ---*/
        if (!empty($_POST)) {
            /*---- formulier invul fouten ----*/
            $_POST["title"];
            if (empty($_POST["title"])) {
                echo "<br><br>" . ' titel is een verplicht veld ' . "<br>";
            }
            if (empty($_POST["media"])) {
                echo ' media is een verplicht veld' . "<br>";
            } else {
                if ($_POST["media"] <> $_POST["mediatype"]) {
                     echo ' type media en \'Kies\' type media moet gelijk zijn ' . "<br>";
                }
            }
            $_POST["summary"];
            if (empty($_POST["summary"])) {
                echo ' summary is een verplicht veld ' . "<br>";
            }
            $_POST["country"];
            if (empty($_POST["country"])) {
                echo ' country is een verplicht veld ' . "<br>";
            }
            /*------ toevoegen aan sql  database --------*/
            /* UPDATE media SET media = 'movies' WHERE id = 15; */
            /* DELETE FROM media WHERE id = 12; */
            if ($_POST["media"] == "series") {
                $sqlinsertseries = "INSERT INTO `media` (`media`, `title`, `rating`, `summary`, `awards`, `seasons`, `country`, `youtube_trailer_id`)
                VALUES (:upmedia, :uptitle, :uprating, :upsummary, :upawards, :upseasons, :upcountry, :upyoutube_trailer_id)";
                try {
                    $stmt = $pdo->prepare($sqlinsertseries);
                    $stmt->execute([":upmedia" => $_POST["media"], ":uptitle" => $_POST["title"], ":uprating" => $_POST["rating"], "upsummary" => $_POST["summary"], ":upawards" => $_POST["awards"], 
                    ":upseasons" => $_POST["seasons"], ":upcountry" => $_POST["country"], ":upyoutube_trailer_id" => $_POST["youtube_trailer_id"]]);
                } catch (Exception $err) {
                    echo $err->getMessage();
                } //try
            } // if media series
            if ($_POST["media"] == "movies") {
                $sqlinsertmovies = "INSERT INTO `media` (`media`, `title`, `summary`,`length_in_minutes`, `released_at`, `country`, `youtube_trailer_id`)
                VALUES (:upmedia, :uptitle, :upsummary, :uplength_in_minutes, :upreleased_at, :upcountry, :upyoutube_trailer_id)";
                try {
                    $stmt = $pdo->prepare($sqlinsertmovies);
                    $stmt->execute([":upmedia" => $_POST["media"], ":uptitle" => $_POST["title"], ":upsummary" => $_POST["summary"], ":uplength_in_minutes" => $_POST["length_in_minutes"], 
                    ":upreleased_at" => $_POST["released_at"], ":upcountry" => $_POST["country"], ":upyoutube_trailer_id" => $_POST["youtube_trailer_id"]]);
                } catch (Exception $err) {
                    echo $err->getMessage();
                } //try
            } // if media movies
        } // if empty
        ?>
    </body>
</html>