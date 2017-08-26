<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
    <div class="container">
        <h1 class="display-3">Bilety</h1>
        <br/>
    </div>
</div>
<div class="container">
    <?php
    $db = DataBase::getDB();
    $zap = $db->prepare("SELECT * FROM ticket WHERE cinema_id = " . $User->getCinemaOwner());
    $zap->execute();
        while($tab = $zap->fetch()){
            echo "".$tab['type']."(".$tab['value'].") <i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> <a href='editTicket/".$tab['id']."'>Edycja</a><br />";
        }
    ?>
</div>
