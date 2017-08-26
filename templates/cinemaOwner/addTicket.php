<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie Biletu.</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['name'])) {
    $convert = new NumberFormatter('pl_PL', NumberFormatter::DECIMAL);
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO ticket VALUE (NULL, :name, " . $User->getCinemaOwner() . ", :value)");
    $zap->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $zap->bindValue(":value", $convert->parse($_POST['value']), PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano Bilet
</div>';
}
?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Typ biletu</label>
            <div class="input-group Name">
                <input class="form-control" id="name" name="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="value">Wartość:</label>
            <div class="input-group Name">
                <input class="form-control" id="value" name="value" required>
            </div>
        </div>

        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>