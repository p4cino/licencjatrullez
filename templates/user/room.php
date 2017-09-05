<?php
function czyZajete($r, $j, $seance, $room) //$data dodać przy połączeniu tabeli reservation
{
    $db = DataBase::getDB();
    $zap = $db->prepare("SELECT id FROM reservation_seat WHERE seance_id = ".$seance." AND cinema_room_id = ".$room." AND row_number = " . $r . " AND seat_number = " . $j);
    $zap->execute();
    $user = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
    if (count($user) == 1) {
        return true;
    }
    return false;
}

?>
<div class="container">
    <div class="rows">
        <form action="" method="POST">
            <?php
            $db = DataBase::getDB();
            $aktualna = new DateTime();
            if (isset($_POST['date']) && !empty($_POST['date'])) {
                echo '<div class="screen">Ekran</div>';
                if (isset($_GET['s2'])) {
                    $zap = $db->prepare("SELECT * FROM seance WHERE id = :id");
                    $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_STR);
                    $zap->execute();
                    $baza = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
                    if (count($baza) <= 0) {
                        echo "Nie ma takiego seansu! <br />";
                    } else {
                        $zap = $db->prepare("SELECT * FROM `row_seat` WHERE `room_id` = ".$_GET['s3']);
                        $zap->execute();
                        $r = 1;
                        while ($tab = $zap->fetch()) {
                            $i = $tab['seat_count'];
                            echo "<strong>" . $r . "</strong> ";
                            for ($j = 1; $j <= $tab['seat_count']; $j++) {
                                if (czyZajete($r, $j, $_GET['s2'], $_GET['s3'])) {
                                    echo '<div class="seat">
                        <div class="squaredOne">
                            <input type="checkbox" value="" id="squaredOne' . $r . ',' . $j . '" name="box_tablica[]"  disabled>
                            <label for="squaredOne' . $r . ',' . $j . '"></label>
                        </div> ' . $j . '
                      </div>';
                                } else {
                                    echo '<div class="seat">
                        <div class="squaredOne">
                            <input type="checkbox" value="' . $r . ',' . $j . '" id="squaredOne' . $r . ',' . $j . '" name="box_tablica[]" >
                            <label for="squaredOne' . $r . ',' . $j . '"></label>
                        </div> ' . $j . '
                      </div>';
                                }
                            }
                            echo "<br/>";
                            $r++;
                        }
                    }
                }
                echo '<button class="btn btn-primary">Dalej</button>
        </form>';
            } else {
                $zap = $db->prepare("SELECT showing_to_date FROM movie_showing WHERE movie_id = (SELECT `movie_showing_id` from seance where id = :id) ");
                $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
                $zap->execute();
                $tab = $zap->fetch(PDO::FETCH_ASSOC);

                echo '
	<form method="POST" action="">
		<div class="form-group row">
			<label for="example-date-input" class="col-2 col-form-label">Wybierz datę rezerwacji</label>
			<div class="col-10">
				<input class="form-control" type="date" min="' . $aktualna->format("Y-m-d") . '" max="' . $tab['showing_to_date'] . '" value="' . $aktualna->format("Y-m-d") . '" name="date">
			</div>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-danger" onclick="window.history.back()">Cofnij</button>
			<button type="submit" class="btn btn-success" >Dalej</button>
		</div>
	</form>';
            }
            print_r($_POST);
            ?>
    </div>
</div>