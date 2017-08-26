<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Edytowanie Biletu.</h1>
        <br/>
    </div>
</div>
<?php
$db = DataBase::getDB();


$zap = $db->prepare("SELECT * FROM ticket WHERE id = :id AND cinema_id = " . $User->getCinemaOwner() . " ");
$zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
$zap->execute();
$zap->execute();
$baza = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
if (count($baza) == 1) {
    if (!empty($_POST)) {
        $zap = $db->prepare("UPDATE ticket SET type = :type, value = :value WHERE id = :id");
        $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
        $zap->bindValue(":type", $_POST['type'], PDO::PARAM_INT);
        $zap->bindValue(":value", $_POST['value'], PDO::PARAM_STR);
        $zap->execute();
        $zap->closeCursor();
        echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Zaktualizowano bilet
</div>';
    }
    $zap = $db->prepare("SELECT type, value FROM ticket WHERE id = :id");
    $zap->bindValue(":id", $_GET['s2'], PDO::PARAM_INT);
    $zap->execute();
    $tab = $zap->fetch(PDO::FETCH_ASSOC);
    $zap->closeCursor();
}
else {
    echo '<div class="alert alert-warning m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Błąd!</strong> Nie masz takiego biletu
</div>';
}
?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Typ biletu</label>
            <div class="input-group Name">
                <input class="form-control" id="name" name="type" value="<?php echo $tab['type']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="value">Wartość:</label>
            <div class="input-group Name">
                <input class="form-control" id="value" name="value" value="<?php echo $tab['value']; ?>" required>
            </div>
        </div>

        <button class="btn btn-primary">Aktualizuj</button>
    </form>
</div>