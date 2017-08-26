<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie Kina.</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['name'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("INSERT INTO `cinema` (name, manager) VALUES (:name, :manager)");
    $zap->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $zap->bindValue(":manager", $_POST['manager'], PDO::PARAM_STR);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano Kino!
</div>';
}

function listAllUser(){
    $db = DataBase::getDB();
    $zap = $db->query("SELECT `id`, `name`, `surname` FROM `user`");
    while($tab = $zap->fetch()){
        echo "<option value='".$tab['id']."'>".$tab['name']." ".$tab['surname']."</option>";
    }
}
?>
<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="nazwa">Nazwa Kina</label>
            <div class="input-group Name">
                <input class="form-control" name="name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="sel1">Właściciel:</label>
            <select class="form-control" name="manager">
                <?php listAllUser() ?>
            </select>
        </div>

        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>