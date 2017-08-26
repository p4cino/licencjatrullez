<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie daty seansów</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['movie'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO movie_showing VALUE (null, ".$User->getCinemaOwner().", :movie,  :from_date, :to_date)");
    $zap->bindValue(":movie", $_POST['movie'], PDO::PARAM_INT);
    $zap->bindValue(":from_date", $_POST['showing_from_date'], PDO::PARAM_STR);
    $zap->bindValue(":to_date", $_POST['showing_to_date'], PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano daty seansów
</div>';
}

$today = new DateTime();
$tomorrow = new DateTime('tomorrow');
?>
<div class="container">
    <form method="POST">
        <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Wybierz film:</label>
            <div class="col-10">
                <select class="custom-select" name="movie">
                    <?php
                    $db = DataBase::getDB();
                    $zap = $db->prepare("SELECT * FROM movie WHERE cinema_id = " . $User->getCinemaOwner());
                    $zap->execute();
                    while ($tab = $zap->fetch()) {
                        echo "<option value='" . $tab['id'] . "'>" . $tab['movie_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Prezentowany od:</label>
            <div class="col-10">
                <input class="form-control" type="date" value="<?php echo $today->format("Y-m-d") ?>"
                       min="<?php echo $today->format("Y-m-d") ?>" name="showing_from_date">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Prezentowany do:</label>
            <div class="col-10">
                <input class="form-control" type="date" value="<?php echo $tomorrow->format("Y-m-d") ?>"
                       min="<?php echo $tomorrow->format("Y-m-d") ?>" name="showing_to_date">
            </div>
        </div>
        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>