<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Filmy w bibliotece twojego kina</h1>
        <br/>
    </div>
</div>
<div class="container">
    <?php
    $db = DataBase::getDB();
    $zap = $db->prepare("SELECT * FROM movie WHERE cinema_id = " . $User->getCinemaOwner());
    $zap->execute();
    while($tab = $zap->fetch()){
        echo "".$tab['movie_name']." <a href='editMovie/".$tab['id']."'>Edycja</a><br />";
    }
    ?>
</div>
