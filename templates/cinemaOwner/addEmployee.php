<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Dodawanie daty seansów</h1>
        <br/>
    </div>
</div>
<?php
if (!empty($_POST['id'])) {
    $db = DataBase::getDB();
    $zap = $db->prepare("UPDATE `user` SET `role` = '2', employer = ".$User->getId()." WHERE `id` = :id  ");
    $zap->bindValue(":id", $_POST['id'], PDO::PARAM_INT);
    $zap->execute();
    echo '<div class="alert alert-success m-0" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Sukces!</strong> Dodano pracownika
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
                <select class="custom-select" name="id">
                    <?php
                    $db = DataBase::getDB();
                    $zap = $db->prepare("SELECT * FROM user WHERE role = 1 AND employer IS NULL");
                    $zap->execute();
                    while ($tab = $zap->fetch()) {
                        echo "<option value='" . $tab['id'] . "'>" . $tab['email'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button class="btn btn-primary">Dodaj</button>
    </form>
</div>