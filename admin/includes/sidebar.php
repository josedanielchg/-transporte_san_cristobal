
<!-- Sidebar -->
<nav class="navbar navbar-dark bg-dark fixed-top sidebar">
  <div class="container-fluid sidebar__container container">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <div class="sidebar__logo-container offcanvas-title" id="offcanvasDarkNavbarLabel">
            <!-- Logo/ Title -->
            <img src="../img/logo.png" alt="" class="sidebar__logo">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Transporte San Cristóbal</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar__container container">

        <!-- Logo -->
        <div class="sidebar__logo-container">
            <!-- TODO: Add Alcaldia Logo -->
            <img src="" alt="" class="sidebar__logo">
            [Logo]
            <strong>Transporte San Cristóbal</strong>
        </div>

        <!-- Links -->
        <ul class="sidebar__links">
            <!-- TODO: Add icon to each link item -->
            <li class="sidebar_links-items">
                <a href="usuarios.php">
                    [icon]
                    <span>Usuarios</span>
                </a>
            </li>

            <li class="sidebar_links-items">
                <a href="rutas.php">
                    [icon]
                    <span>Rutas</span>
                </a>
            </li>

            <li class="sidebar_links-items">
                <a href="paradas.php">
                    [icon]
                    <span>Paradas</span>
                </a>
            </li>

            <li class="sidebar_links-items">
                <a href="comentarios.php">
                    [icon]
                    <span>Comentarios</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar_background"></div>
</nav>
<!-- End sidebar -->