<div class="jumbotron jumbotron-fluid bg-inverse" id="bg1">
	<div class="container">
		<h1 class="display-3">Nadawanie Uprawnień.</h1>
		<br />
	</div>
</div>
<div class="container">
	<?php
		$db = DataBase::getDB();

		if (!empty($_GET['s2']) && !empty($_GET['s3'])) {
		if ($_GET['s3'] == "user") {
			$sql = "UPDATE `user` SET `role` = '1' WHERE `id` = :id";
			$stmt = $db->prepare($sql);                                   
			$stmt->bindParam(':id', $_GET['s2'], PDO::PARAM_INT);   
			$stmt->execute(); 
		}
		if ($_GET['s3'] == "mod") {
			$sql = "UPDATE `user` SET `role` = '2' WHERE `id` = :id";
			$stmt = $db->prepare($sql);                                   
			$stmt->bindParam(':id', $_GET['s2'], PDO::PARAM_INT);   
			$stmt->execute(); 
		}
		if ($_GET['s3'] == "adm") {
			$sql = "UPDATE `user` SET `role` = '3' WHERE `id` = :id";
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
		if ($tab['role'] == 2) {
			echo "<a class='btn btn-danger mx-2' href='role/".$tab['id']."/mod'>Zmień na Moderatora</a>";
			echo "<a class='btn btn-success mx-2' href='role/".$tab['id']."/user'>Zmień na normalnego użytkownika</a>";
		}
		else {
			if ($tab['role'] == 1) {
				echo "<a class='btn btn-danger mx-2' href='role/".$tab['id']."/adm'>Nadaj Administratora</a>";
				echo "<a class='btn btn-success mx-2' href='role/".$tab['id']."/user'>Zmień na normalnego użytkownika</a>";
			}
			else {
				echo "<a class='btn btn-warning mx-2' href='role/".$tab['id']."/mod'>Nadaj Moderatora</a>
				<a class='btn btn-danger mx-2' href='role/".$tab['id']."/adm'>Nadaj Administratora</a>";
			}
		}
		echo "".$tab['name']." | role: ".$role." 
		<hr />";
	}
	?>
</div>