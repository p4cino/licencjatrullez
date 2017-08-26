<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Właściciel Kina</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<?php 
	echo "<base href='".WWW."'>";
		//pod tym ładowanie cssów w headzie bo inaczej przez "ładne adresy" /plik/zmienna/zmienna skrypty nie będą wiedzieć w jakim są katalogu
	?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel='stylesheet prefetch' href='./layout/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css'>
	<script src='./layout/js/tether.min.js'></script>
	<!--Ikonki glyphicons-->
	<link rel="stylesheet" href="./layout/fonts/font-awesome.min.css">
	<!--Style modyfikujące-->
	<link rel="stylesheet" href="./layout/css/style.css">
</head>

<body>
	<nav class="navbar navbar-inverse navbar-toggleable-md bg-inverse">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#rozwin" aria-controls="rozwin" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="#"><i class="fa fa-bullseye"></i>Cinema</a>

		<div class="collapse navbar-collapse" id="rozwin">

			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="dashboard">Panel Właściciela</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ticket">Bilety</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="addTicket">Dodaj Bilet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="movie">Filmy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addMovie">Dodaj film</a>
                </li>
				<li class="nav-item">
					<a class="nav-link" href="addSeanceDate">Dodawanie daty seansów</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="addCinemaRoom">Dodawanie Sal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addRowSeat">Dodawanie rzędów</a>
                </li>
			</ul>

			<form class="form-inline my-2 my-lg-0">
				<a href="logout" class="btn btn-outline-danger mx-2">Wyloguj <i class="fa fa-sign-out" aria-hidden="true"></i></a>
			</form>
		</div>
	</nav>