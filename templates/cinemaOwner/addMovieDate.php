<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie daty seansów</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['movie'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO seance VALUE (null, :hours, :movie,  :room)");
    $zap->bindValue(":room", $_POST['room'], PDO::PARAM_INT);
    $zap->bindValue(":movie", $_POST['movie'], PDO::PARAM_INT);
    $zap->bindValue(":hours", $_POST['hours'], PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano godzinę wyświetlania filmu
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
                <select class="custom-select" name="room">
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
            <label for="example-date-input" class="col-2 col-form-label">Wybierz film:</label>
            <div class="col-10">
                <select class="custom-select" name="movie">
                    <?php
                    $db = DataBase::getDB();
                    $zap = $db->prepare("SELECT movie_showing.id, movie.movie_name FROM movie_showing INNER JOIN movie ON movie_showing.id = movie.id WHERE movie_showing.cinema_id = " . $User->getCinemaOwner());
                    $zap->execute();
                    while ($tab = $zap->fetch()) {
                        echo "<option value='" . $tab['id'] . "'>" . $tab['movie_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="example-date-input" class="col-2 col-form-label">Wyświetlane o:</label>
            <div class="col-2">
                <input class="form-control" name="hours">
            </div>
        </div>
        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>