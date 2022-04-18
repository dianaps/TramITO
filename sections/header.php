
<style>
  nav {
    position: fixed !important;
    display: flex;
    align-items: center;
    /* height: 62px; */
    width: 100%;
    white-space: nowrap;
    flex-shrink: 0;
    font-weight: 600;
    font-size: 15px;
    border-bottom: 1px solid rgba(44, 45, 42, 0.25);
    top: 0;
    left: 0;
    background-color: var(--beach-bg);
    z-index: 6;
  }
  .hamburguer{
    background-color: transparent;
    border: none;
    outline: none;
    cursor: pointer;
  }

  .hamburguer .line{
    display:block;
    width: 28px;
    height: 3px;
    background-color: #ecf0f1;
    margin-block: 7px;
    border-radius: 4px;
    transition: transform .5s;
    opacity: .25s;
  }

  .hamburguer.active .line:nth-child(1){
    transform: translateY(10px)
    rotate(45deg);
  }

  .hamburguer.active .line:nth-child(2){
    opacity: 0;
  }

  .hamburguer.active .line:nth-child(3) {
    transform: translateY(-10px)
    rotate(-45deg);
  }
</style>

<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <button
        class="navbar-toggler hamburguer"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#menu"
        aria-controls="menu"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-scroll">
          <li class="nav-item logo-image-buho">
              <img src="img/logo-buho.png" class="img-fluid">
          </li>
          <li class="nav-item logo-image-nombre">
              <img src="img/logo-nombre.png" class="img-fluid">
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Chatbot</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="departamentos.php">Departamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
          <!-- <li class="nav-item">
            <img src="uploads/<?//$user['p_p']?>"
    			         class="w-25 rounded-circle" alt="">
             <a class="nav-link" href="#">Contacto</a>
          </li> -->
          <li>
            </li>
          </ul>
          <a href="logout.php"
          class="btn btn-light">Cerrar sesión</a>
      </div>
    </div>
  </nav>
  <!-- Navbar -->
</header>

<script>
  const hamburguerMenu = document.querySelector('.hamburguer');
  const menuIsActive = () => {
    hamburguerMenu.classList.toggle('active');
  };
  hamburguerMenu.addEventListener('click', menuIsActive);
</script>
