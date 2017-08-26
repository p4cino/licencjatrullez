<div class="container">
    <?php
    $db = DataBase::getDB();
    if (empty($_GET['s2'])) {
        $zap = $db->prepare("SELECT * FROM cinema");
        $zap->execute();
        while ($tab = $zap->fetch()) {
            echo '
<div class="card" style="width: 20rem;">
  <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_15e1ee930d5%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_15e1ee930d5%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22118.0859375%22%20y%3D%2297.2%22%3E318x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">'. $tab['name'] .'</h4>
    <p class="card-text">'. $tab['adress'] .'</p>
    <a href="cinema/'. $tab['id'] .'" class="btn btn-primary">Zobacz</a>
  </div>
</div>';
        }
    } else {
        if (true) {
            $zap = $db->prepare("SELECT * FROM cinema WHERE id = :id");
            $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
            $zap->execute();
            $tab = $zap->fetch(PDO::FETCH_ASSOC);
            $zap->closeCursor();
            echo "
Kino<h2>" . $tab['name'] . "</h2>
Adres<h4>" . $tab['adress'] . "</h4>
Telefon<h4>" . $tab['phone'] . "</h4>
";
            echo "Aktualnie wyświetlane seanse: <br/>";
            $zap = $db->prepare("SELECT * FROM movie_showing INNER JOIN movie ON movie_showing.id = movie.id WHERE movie_showing.cinema_id = :id");
            $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
            $zap->execute();
            while ($tab = $zap->fetch()) {
                echo "<a href='reservation/" . $tab['id'] . "'>" . $tab['movie_name'] . "</a> Do: " . $tab['showing_from_date'] . "<br />";
            }
        }
    }
    ?>
</div>
