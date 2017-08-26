<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie rzędów do sal</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['seat_count']) && !empty($_POST['row_number'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO row_seat VALUE (null, :row_number, :seat_count, :room_id)");
    $zap->bindValue(":row_number", $_POST['row_number'], PDO::PARAM_INT);
    $zap->bindValue(":seat_count", $_POST['seat_count'], PDO::PARAM_STR);
    $zap->bindValue(":room_id", $_POST['room_id'], PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano rząd
</div>';
}

$today = new DateTime();
$tomorrow = new DateTime('tomorrow');
?>
<div class="container">
    <form method="POST">
        <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Wybierz salę:</label>
            <div class="col-10">
                <select class="custom-select" name="room_id">
                    <?php
                    $db = DataBase::getDB();
                    $zap = $db->prepare("SELECT * FROM cinema_room WHERE cinema_id = " . $User->getCinemaOwner());
                    $zap->execute();
                    while ($tab = $zap->fetch()) {
                        echo "<option value='" . $tab['id'] . "'>" . $tab['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="row_number" class="col-2 col-form-label">Numer rzędu:</label>
            <div class="col-10">
                <input class="form-control" id="row_number" name="row_number" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="seat_count" class="col-2 col-form-label">Ilość miejsc:</label>
            <div class="col-10">
                <input class="form-control" id="seat_count" name="seat_count" required>
            </div>
        </div>
        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>