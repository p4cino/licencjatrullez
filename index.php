<?php
//Start bufora PHP
ob_start();
//Start benchmarka służącego do określenia w jakim czasie wykonują się skrypty
$bench = microtime(True);
//Ładowanie głównego pliku z ustawieniami i klasami
require_once('./var/ustawienia.php');
//Tablica ACL trzymająca kto gdzie może się dostać
$ACL = Array(
    'guest' => array(
        'home', 'logowanie', 'rejestracja', 'cinema', 'movie',
        'cinema', 'reservation', 'room'
    ),
    'user' => array('dashboard', 'ticket', 'logout'),
    'mod' => array('dashboard', 'akceptacja', 'uzytkownicy', 'logout'),
    'cinemaOwner' => array(
        'dashboard', 'ticket', 'addTicket', 'editTicket',
        'movie', 'addMovie', 'editMovie', 'seance', 'addSeanceDate',
        'addMovieDate',
        'addCinemaRoom', 'addRowSeat', 'editSeance', 'addEmployee', 'logout'
    ),
    'admin' => array('dashboard', 'addCinema', 'role', 'deleteUser', 'logout')
);

//tworzenie obiektu uzytkownik
isset($_SESSION['user']) ? $User = new User($_SESSION['user']) : $User = new User(null);

//Routing oraz sprawdzanie dostępów do podstron
$start = null;
switch ($User->getRole()) {
    //Gość


    case 1:
        //Zwykły użytkownik
        $access = $ACL['user'];
        $folder = './templates/user/';
        $start = 'dashboard';
        break;

    case 2:
        //Pracownik kina
        $access = $ACL['mod'];
        $folder = './templates/mod/';
        $start = 'dashboard';
        break;
    case 3:
        //Właściciel Kina
        $access = $ACL['cinemaOwner'];
        $folder = './templates/cinemaOwner/';
        $start = 'dashboard';
        break;
    case 4:
        //Moderator strony
        $access = $ACL['admin'];
        $folder = './templates/admin/';
        $start = 'dashboard';
        break;
    case 5:
        //Administrator strony
        $access = $ACL['admin'];
        $folder = './templates/admin/';
        $start = 'dashboard';
        break;
    default:
        $access = $ACL['guest'];
        $folder = './templates/guest/';
        $start = 'home';
        break;
}
//Jeśli jest pusta zmienna wysylamy do domyslnej strony
!empty($_GET['page']) ? $page = $_GET['page'] : $page = $start;
//Sprawdzanie czy jest dostep do zadanej strony
in_array($page, $access) ? $page = $page : $page = 'error';

//Ładowanie systemu szablonow
require_once($folder . 'header.php');
require_once($folder . '' . $page . '.php');
//Przybliżony czas wykonania strony o stronie serwera
$stop = microtime(True);
$time = $stop - $bench;
require_once($folder . 'footer.php');

ob_end_flush();
?>