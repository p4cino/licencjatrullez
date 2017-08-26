<?php
function rejestracja($email, $password, $password2, $imie, $nazwisko, $telefon) {
	$db = DataBase::getDB();
	//usuwanie 'białych' znaków z przesłanych danych
	$email = trim($email);
	$password = trim($password);
	$password2 = trim($password2);
	//Zmienna errors trzyma błędy
	$errors = NULL;
	//1.Walidacja podanych danych
	if (strlen($password) < 6) {
		$errors .= "Hasło powinno zawierać co najmniej 6 znaków! <br />";
	}
	if ($password !== $password2) {
		$errors .= "Hasła nie są takie same! <br />";
	}
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === False) {
		$errors .= "Adres email jest niepoprawny! <br />";
	}

	//2.Sprawdzanie danych w bazie email
	$zap = $db->prepare("SELECT email FROM `user` WHERE email=:email");
	$zap->bindValue(":email", $email, PDO::PARAM_STR);
	$zap->execute();
	$baza = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
	if(count($baza)>0) {
		$errors .= "Podany adres email jest już w bazie! <br />";
	}

	if (empty($errors)) {
		$zap = $db->prepare("INSERT INTO `user` (name, surname, email, telephone, password) VALUES (:name, :surname, :email, :telephone, :password)");
		$zap->bindValue(":email", $email, PDO::PARAM_STR);
		$zap->bindValue(":password", sha1($password), PDO::PARAM_STR);
		$zap->bindValue(":name", $imie, PDO::PARAM_STR);
		$zap->bindValue(":surname", $nazwisko, PDO::PARAM_STR);
		$zap->bindValue(":telephone", $telefon, PDO::PARAM_STR);
		$zap->execute();

		//id ostatnio dodanego rekordu do bazy z danego zapytania
		//$id_uzytkownika = $db->lastInsertId();

		return "";
	}
	return $errors;
}
?>