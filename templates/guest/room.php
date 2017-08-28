<div class="container">
    <div class="screen">
        Ekran
    </div>
    <div class="rows">
        <form action="" method="POST">
            <?php
            $db = DataBase::getDB();
            if (isset($_GET['s2'])) {
                $zap = $db->prepare("SELECT * FROM seance WHERE id = :id");
                $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_STR);
                $zap->execute();
                $baza = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
                if (count($baza) <= 0) {
                    echo "Nie ma takiego seansu! <br />";
                } else {
                    $zap = $db->prepare("SELECT * FROM `row_seat` WHERE `room_id` = 1");
                    $zap->execute();

                    $array = array();
                    $r = 1;
                    while ($tab = $zap->fetch()) {
                        $i = $tab['seat_count'];
                        echo "<strong>" . $r . "</strong> ";
                        for ($j = 1; $j <= $tab['seat_count']; $j++) {
                            echo '<div class="seat">
                        <div class="squaredOne">
                            <input type="checkbox" value="' . $r . ',' . $j . '" id="squaredOne' . $r . ',' . $j . '" name="box_tablica[]"  />
                            <label for="squaredOne' . $r . ',' . $j . '"></label>
                        </div> ' . $j . '
                      </div>';
                        }
                        echo "<br/>";
                        $r++;
                    }
                }
            }
            print_r($_POST);
            ?>
            <button class="btn btn-primary">Dalej</button>
        </form>
    </div>
</div>