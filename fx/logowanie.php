<?php
/**
 * @param $email
 * @param $password
 * @return bool
 */
function logowanie($email, $password)
{
	$db = DataBase::getDB();
 	$zap = $db->prepare("SELECT id FROM `user` WHERE email = :email AND password = :password");
    $zap->bindValue(":email", $email, PDO::PARAM_STR);
    $zap->bindValue(":password", sha1($password), PDO::PARAM_STR);
	$zap->execute();
	$user = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
	$ile = count($user);
	if($ile == 1) {
		$_SESSION['user'] = $user[0];
		return true;
	}
	return false;
}