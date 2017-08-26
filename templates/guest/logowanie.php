<?php
fx('logowanie');
if(!empty($_POST['email'])){
	$user = logowanie($_POST['email'], $_POST['password']);
	//true/false z funkcji
	if($user){
		reload('');
	}
	else {
		echo "Podano niepoprawne dane";
	}
}
else {
	echo '
<form id="login_form" action="" method="POST">
				<fieldset>
					<legend>Panel logowania</legend>
					<div>
						<label for="login">Email: </label>
						<input name="email"/>
					</div>
					<div>
						<label for="password">Hasło: </label>
						<input type="password" name="password"/>
					</div>
					<input type="submit" value="Zaloguj" />
				</fieldset>
			</form>
	';
}

?>