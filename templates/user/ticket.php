<div class="jumbotron jumbotron-fluid bg-inverse" id="bg2">
  <div class="container">
    <h1 class="display-3">Twoje Bilety</h1>
    <p class="lead">Życzymy miłych seansów :)</p>
    <br />
  </div>
</div>

<div class="container">

  <?php
//  function czyIstniejeRezerwacja($rezerwacja, $User){
//    $db = DataBase::getDB();
//    $zap = $db->prepare("SELECT id FROM `rezerwacje` WHERE `id` = :id AND `id_uzytkownika` = :uzytkownik AND `data` >= NOW()");
//    $zap->bindValue(":id", $rezerwacja, PDO::PARAM_INT);
//    $zap->bindValue(":uzytkownik", $User, PDO::PARAM_INT);
//    $zap->execute();
//    $user = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
//    $ile = count($user);
//    if($ile == 1) {
//      $zap = $db->prepare("DELETE FROM `rezerwacje` WHERE `id` = :id LIMIT 1");
//      $zap->bindValue(":id", $rezerwacja, PDO::PARAM_INT);
//      $zap->execute();
//      return true;
//    }
//    return false;
//  }
//
//  if (!empty($_GET['s2'])) {
//    if (czyIstniejeRezerwacja($_GET['s2'], $User->getId())) {
//      echo '<p class="alert-success">Pomyślnie usunięto rezerwację :)</p>';
//    }
//    else {
//      echo '<p class="alert-danger">Brak takiej rezerwacji!</p>';
//    }
//  }
  function allTicket($var){

  }
  ?>
  <div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="card">
      <div class="card-header" role="tab" id="headingOne">
        <h5 class="mb-0">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-unsorted" aria-hidden="true"></i> Aktywne rezerwacje
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
        <div class="card-block">
          <ul class="list-group">
            <?php
            $db = DataBase::getDB();
            $aktualna = new DateTime();
            $zap = $db->query("SELECT reservation.id, reservation_seat.reservation_date FROM reservation INNER JOIN reservation_seat ON reservation.id = reservation_seat.seat_number WHERE reservation_seat.reservation_date >= '".$aktualna->format("Y-m-d")."' AND  reservation.user_id = ".$User->getId());
            $ile = false;
            while($tab = $zap->fetch()){
              $ile = true;
              echo '
              <li class="list-group-item">
                '.$tab['reservation_date'].'
                <a href="rezerwacje/'.$tab['id'].'" class="btn btn-sm btn-outline-danger mx-2">Anuluj <i class="fa fa-times"></i></a>
              </li>';
            }
            if (!$ile) {
              echo '
              <li class="list-group-item">
                <strong>Brak aktywnych rezerwacji</strong>
              </li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" role="tab" id="headingTwo">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-unsorted" aria-hidden="true"></i> Nieaktywne Rezerwacje
          </a>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="card-block">
          <ul class="list-group">
              <?php
              $db = DataBase::getDB();
              $aktualna = new DateTime();
              $zap = $db->query("SELECT reservation.id, reservation_seat.reservation_date FROM reservation INNER JOIN reservation_seat ON reservation.id = reservation_seat.seat_number WHERE reservation_seat.reservation_date < '".$aktualna->format("Y-m-d")."' AND  reservation.user_id = ".$User->getId());
              $ile = false;
              while($tab = $zap->fetch()){
                  $ile = true;
                  echo '
              <li class="list-group-item">
                '.$tab['reservation_date'].'
                <a href="rezerwacje/'.$tab['id'].'" class="btn btn-sm btn-outline-danger mx-2">Anuluj <i class="fa fa-times"></i></a>
              </li>';
              }
              if (!$ile) {
                  echo '
              <li class="list-group-item">
                <strong>Brak aktywnych rezerwacji</strong>
              </li>';
              }
              ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" role="tab" id="headingThree">
        <h5 class="mb-0">
          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-unsorted" aria-hidden="true"></i> Historia rezerwacji
          </a>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="card-block">
          <ul class="list-group">
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>