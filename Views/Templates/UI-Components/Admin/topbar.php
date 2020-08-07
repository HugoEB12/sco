  <nav class="topnav">
    <ul class="topnav-list bg-default-theme">

      <li class="topnav-item">
        <div class="topnav-link">
          <span class="badge">Inicio</span> <?php echo $currentSatus; ?>
        </div>
      </li>

      <li class="topnav-item right">
        <div class="dropdown">
          <button class="dropbtn topnav-link dropdown-toggle" onclick="dropdown('dropdown1')">
            Bienvenido(a): <?php echo $_SESSION["name_admin"]." ".$_SESSION["lname_admin"]; ?>
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content" id="dropdown1">
            <a href="#" class="link link-outline-default img">
              Perfil
              <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/profile.png">
            </a>
            <a href="" class="link link-outline-default img" data-toggle="modal" data-target="#modalSession">
              Cerrar Sesión
              <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/logout.png">
            </a>
          </div>
        </div>
      </li>
    </ul>
  </nav>

  <div class="modal fade" id="modalSession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-default" id="exampleModalLabel">
            Cerrar Sesión <img src="<?php echo(Assets)."/images/icons/multi/24x24/question.png" ?>">
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="link link-outline-default" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro(a) que deseas Cerrar Sesión?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="link link-outline-danger" data-dismiss="modal">
            Cancelar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/cancel.png">
          </button>
          <a href="../<?php echo $sessionPath; ?>Controllers/SessionController.php?from=admin&destroy=yes&csrf=<?php echo htmlspecialchars($_SESSION["token_admin"]);?>" class="link link-outline-default">
            Confirmar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/confirm.png">
          </a>
        </div>
      </div>
    </div>
  </div>
