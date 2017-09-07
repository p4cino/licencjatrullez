<div class="container">
    <div class="row">
        <?php
        function bilety($id) {
            $db = DataBase::getDB();
            $zap = $db->prepare("SELECT * FROM ticket WHERE cinema_id = ". $id);
            $zap->execute();
            echo '<select class="custom-select" name="ticket[]">';
            while($tab = $zap->fetch()){
                echo "<option value='".$tab['id']."'>".$tab['value']." ".$tab['type']."</option>";
            }
            echo '</select>';
        }

        if(!empty($_POST['date']) && !empty($_POST['seance']) && !empty($_POST['room']) && !empty($_POST['box_tablica']) && empty($_POST['ticket']))
        {
            echo '<form method="POST" action="" style="width: 50vh">';
            foreach ($_POST['box_tablica'] as $value) {
                $seats = explode(",", $value);
                echo "<div class='col-10'>Rząd: ".$seats[0]." Miejsce: ".$seats[1]."";
                echo '<input type="hidden" name="m[]" value="'.$seats[0].','.$seats[1].'">';
                bilety(1);
                echo "</div>";
            }
            echo '
                        <input type="hidden" name="date" value="'.$_POST['date'].'">
                        <input type="hidden" name="seance" value="'.$_POST['seance'].'">
                        <input type="hidden" name="room" value="'.$_POST['room'].'">';
            echo "<button class=\"btn btn-primary\">Zatwierdź</button></form>";

            print_r($_POST);
        }
        else
        {
            $i = 0;
        foreach ($_POST['m'] as $value) {
            print_r($_POST);
            $db = DataBase::getDB();
            $array = explode(",", $value);
            $zap = $db->prepare("INSERT INTO `reservation` (user_id, reservation_made_date) VALUES (:id, NOW())");
            $zap->bindValue(":id", $User->getId(), PDO::PARAM_INT);
            $zap->execute();
            $reservationId = $db->lastInsertId();
            $row = $array[0];
            $seat = $array[1];

            $zap = $db->prepare("SELECT * FROM seance WHERE id = :id");
            $zap->bindValue(":id", $_POST['seance'], PDO::PARAM_INT);
            $zap->execute();
            $tab = $zap->fetch(PDO::FETCH_ASSOC);

            $zap = $db->prepare("INSERT INTO `reservation_seat` (row_number, seat_number, movie_showing_id, seance_id, reservation_id, cinema_room_id, reservation_date) VALUES (:row, :seat, :movie, :seance, :reservation, :room, :date)");
            $zap->bindValue(":row",  $row, PDO::PARAM_STR);
            $zap->bindValue(":seat", $seat, PDO::PARAM_STR);
            $zap->bindValue(":movie", $tab['movie_showing_id'], PDO::PARAM_INT);
            $zap->bindValue(":seance", $_POST['seance'], PDO::PARAM_STR);
            $zap->bindValue(":reservation", $reservationId, PDO::PARAM_STR);
            $zap->bindValue(":room", $_POST['room'], PDO::PARAM_INT);
            $zap->bindValue(":date", $_POST['date'], PDO::PARAM_STR);
            $zap->execute();

            $reservationSeat = $db->lastInsertId();
            //id rezerwacji miejsca
            $zap = $db->prepare("INSERT INTO `reservation_ticket` (ticket_type, reservation_seat, ticket_value) VALUES (:id, :reservation, 22)");
            $zap->bindValue(":id", $_POST['ticket'][$i], PDO::PARAM_INT);
            $zap->bindValue(":reservation", $reservationSeat, PDO::PARAM_INT);
            $zap->execute();

            $i++;


        }
        }
        ?>
    </div>
</div>