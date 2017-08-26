<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie Biletu.</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['name'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO cinema_room VALUE (NULL, :name, " . $User->getCinemaOwner() . ")");
    $zap->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano Salę
</div>';
}
?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Nazwa Sali</label>
            <div class="input-group Name">
                <input class="form-control" id="name" name="name" required>
            </div>
        </div>

        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>