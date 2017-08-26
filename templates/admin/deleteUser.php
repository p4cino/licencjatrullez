<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
	<div class="container">
		<h1 class="display-3">Usuwanie użytkowników.</h1>
		<br />
	</div>
</div>
<div class="container">
	<?php
	$db = DataBase::getDB();

	if (!empty($_GET['s2']) && !empty($_GET['s3'])) {
		if ($_GET['s3'] == "delete") {
			$sql = "DELETE FROM `user` WHERE `user`.`id` = :id";
			$stmt = $db->prepare($sql);                                   
			$stmt->bindParam(':id', $_GET['s2'], PDO::PARAM_INT);   
			$stmt->execute(); 
		}
	}

	$zap = $db->query("SELECT `id`, `name`, `role` FROM `user`");
	while($tab = $zap->fetch()){

		switch ($tab['role']) {
			case 1:
			$role = "Uzytkownik";
			break;
			case 2:
			$role = "Moderator";
			break;
			case 3:
			$role = "Administrator";
			break;
			default:
			$role = "Uzytkownik";
			break;
		}

		echo "".$tab['name']." | role: ".$role." <a class='btn btn-outline-danger' href='user/".$tab['id']."/delete'>Usuń</a><hr />";
	}
	?>
</div>