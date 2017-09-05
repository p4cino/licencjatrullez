<div class="container">
    <?php
    $db = DataBase::getDB();;
    if(empty($_GET['s3'])) {
        echo "<h2>Sale w których można obejrzeć film</h2>";
        $zap = $db->prepare("SELECT cinema_room.name, cinema_room.id FROM seance INNER JOIN cinema_room ON seance.cinema_room = cinema_room.id WHERE seance.movie_showing_id = :id GROUP BY id");
        $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
        $zap->execute();
        while ($tab = $zap->fetch()) {
            echo "<a href='reservation/".$_GET['s2']."/" . $tab['id'] . "'>" . $tab['name'] . "</a><br />";
        }
    }
    else {
        echo "<h2>Godziny projekcji</h2>";
        $zap = $db->prepare("SELECT * FROM `seance` WHERE `cinema_room` = :id AND movie_showing_id = :movie");
        $zap->bindValue(":id", $_GET['s3'], PDO::PARAM_INT);
        $zap->bindValue(":movie", $_GET['s2'], PDO::PARAM_INT);
        $zap->execute();

        $array = array();
        $i = 0;
        while ($tab = $zap->fetch()) {
            echo ''.$tab['seance_hours'].'  <a href="room/'.$tab['id'].'/'.$_GET['s3'].'" class="btn btn-outline-info">Rezerwacja</a><br /><br />';
        }
    }
    ?>
</div>
