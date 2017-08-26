<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie Filmu</h1>
        <br/>
    </div>
</div>
<?php
$db = DataBase::getDB();
if (!empty($_POST['name'])) {
    $zap = $db->prepare("INSERT INTO movie VALUE (NULL, :name, :director, :duration_min, :description, :cast, :distributor, :music, :trailer, :cinema_id)");
    $zap->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $zap->bindValue(":director", $_POST['director'], PDO::PARAM_STR);
    $zap->bindValue(":duration_min", $_POST['duration'], PDO::PARAM_INT);
    $zap->bindValue(":description", $_POST['description'], PDO::PARAM_STR);
    $zap->bindValue(":cast", $_POST['cast'], PDO::PARAM_STR);
    $zap->bindValue(":distributor", $_POST['distributor'], PDO::PARAM_STR);
    $zap->bindValue(":music", $_POST['music'], PDO::PARAM_STR);
    $zap->bindValue(":trailer", $_POST['trailer'], PDO::PARAM_STR);
    $zap->bindValue(":cinema_id", $User->getCinemaOwner(), PDO::PARAM_INT);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano Film
</div>';
}
?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Tytuł filmu:</label>
            <div class="input-group Name">
                <input class="form-control" id="name" name="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="director">Reżyseria:</label>
            <div class="input-group Name">
                <input class="form-control" id="director" name="director" required>
            </div>
        </div>

        <div class="form-group">
            <label for="duration">Czas trwania:</label>
            <div class="input-group Name">
                <input class="form-control" id="duration" name="duration" min="1" max="666" title="Wprowadź czas 1-666" required>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Opis filmu:</label>
            <div class="input-group Name">
                <textarea maxlength="255" class="form-control" rows="3" id="description" name="description" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="cast">Obsada:</label>
            <div class="input-group Name">
                <textarea maxlength="255" class="form-control" rows="2" id="cast" name="cast" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="distributor">Dystrybutor:</label>
            <div class="input-group Name">
                <textarea maxlength="255" class="form-control" rows="1" id="distributor" name="distributor" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="music">Muzyka:</label>
            <div class="input-group Name">
                <textarea maxlength="255" class="form-control" rows="1" id="music" name="music" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="trailer">Trailer (<small>Link z Youtube</small>):</label>
            <div class="input-group Name">
                <textarea maxlength="255" class="form-control" rows="1" id="trailer" name="trailer"></textarea>
            </div>
        </div>

        <button class="btn btn-primary">Dodaj Film</button>
    </form>
</div>