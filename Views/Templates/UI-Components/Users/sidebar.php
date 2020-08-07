  <nav class="sidenav">
    <ul class="sidenav-list bg-default-theme text-default">
      <li>
        <div class="sidenav-logo text-default text-center">
          <img class="img-thumbnail rounded border border-light" src="<?php echo Assets;?>/images/sco/sjr-logo.png">
          <p>
            Sistema de Control de Oficios.
          </p>
        </div>
      </li>
      <hr class="bg-light">
      <li>
        <a class="sidenav-link <?php echo $active1; ?>" href="<?php echo($link1); ?>">
          Inicio
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/inicio.png">
        </a>
      </li>
      <li>
        <a class="sidenav-link <?php echo $active2; ?>" href="<?php echo($link2); ?>">
          Registro
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/clipboard.png">
        </a>
      </li>
      <!--
      <li>
        <div class="dropdown">
          <button class="dropbtn sidenav-link dropdown-toggle <?php echo $active3; ?>" onclick="dropdown('dropdown2')">
            Seguimiento
            <i class="fa fa-caret-down"></i>
            <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/seguimiento.png">
          </button>
          <div class="dropdown-content-sidenav" id="dropdown2">
            <a href="<?php echo($link3); ?>">
              Fuera de Tiempo
              <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/profile.png">
            </a>
            <a href="<?php echo($link3); ?>">
              En proceso
              <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/logout.png">
            </a>
            <a href="<?php echo($link3); ?>">
              Finalizados
              <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/logout.png">
            </a>
          </div>
        </div>
      </li>
      -->
      <li>
        <a class="sidenav-link <?php echo $active3; ?>" href="<?php echo $link3; ?>">
          Búsqueda
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/busqueda.png">
        </a>
      </li>
      <hr class="bg-light">
      <span class="text-center badge badge-light">Novedades</span>
      <hr class="bg-light">
      <li>
        <a class="sidenav-link <?php echo $active4; ?>" href="<?php echo $link4; ?>">
          Turnos
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/turn.png">
        </a>
      </li>
      <hr class="bg-light">
      <span class="badge badge-light">Soporte e Información</span>
      <hr class="bg-light">
      <li>
        <a class="sidenav-link <?php echo $active5; ?>" href="<?php echo $link5;?>">
          Política de Privacidad
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/policy.png">
        </a>
      </li>
      <li>
        <a class="sidenav-link <?php echo $active6; ?>" href="<?php echo $link6;?>">
          ¡Ayuda!
          <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/information.png">
        </a>
      </li>
      <br><br><br><br>
    </ul>
  </nav>
