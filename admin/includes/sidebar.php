<?php 
  include_once('../config/dbconnection.php');

  $user_id = $_SESSION['tmsc_id'];
  
  $ret=mysqli_query($con,"SELECT role_id from users where id ='$user_id'");
  $row=mysqli_fetch_array($ret);
  
  $role = $row['role_id'];

  echo '<pre>';
  var_dump($role);
  echo '</pre>';
?>



<!-- Sidebar -->
<nav class="navbar navbar-dark bg-dark fixed-top sidebar">

  <div class="container-fluid sidebar__container container">
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <div class="sidebar__logo-container offcanvas-title" id="offcanvasDarkNavbarLabel">
            <!-- Logo/ Title -->
            <img src="../assets/images/logo.png" alt="" class="sidebar__logo">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Transporte San Cristóbal</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      </div>
      
      
      <!-- Links -->
      <div class="offcanvas-body sidebar__links">
        
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

          <?php if(in_array($role, [1])): ?>
            <li class="nav-item sidebar_links-items">
              <a class="nav-link" aria-current="page" href="usuarios.php">
                <?php include('../assets/icons/person-circle.svg');?> Usuarios
              </a>
            </li>
          <?php endif; ?>
          
          <?php if(in_array($role, [1, 3])): ?>
            <li class="nav-item sidebar_links-items">
              <a class="nav-link" href="rutas.php">
                <?php include('../assets/icons/car-front.svg');?> Rutas
              </a>
            </li>
          <?php endif; ?>
          
          <?php if(in_array($role, [1, 3])): ?>
            <li class="nav-item sidebar_links-items">
              <a class="nav-link" href="paradas.php">
                <?php include('../assets/icons/sign-stop.svg');?> Paradas
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array($role, [1, 3])): ?>
            <li class="nav-item sidebar_links-items">
              <a class="nav-link" href="companias.php">
                <?php include('../assets/icons/building.svg');?> Compañias
              </a>
            </li>
          <?php endif; ?>
          
          <?php if(in_array($role, [1, 3, 2])): ?>
            <li class="nav-item sidebar_links-items">
              <a class="nav-link" href="comentarios.php">
                <?php include('../assets/icons/chat-dots.svg');?> Comentarios
              </a>
            </li>
            <?php endif; ?>
            
          <li class="nav-item sidebar_links-items">
            <a class="nav-link" href="logout.php">
              <?php include('../assets/icons/person-circle.svg');?> Logout
            </a>
          </li>
        </ul>

      </div>

    </div>

  </div>
</nav>
<!-- End sidebar -->