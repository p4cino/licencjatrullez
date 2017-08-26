<div class="container">
<?php
$db = DataBase::getDB();
$zap = $db->prepare("SELECT * FROM cinema");
$zap->execute();
while($tab = $zap->fetch()){
    echo "".$tab['name']."<a href='editTicket/".$tab['id']."'>Edycja</a><br />";
}
?>
</div>
