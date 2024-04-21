<div class="container-fluid d-flex justify-content-center">
<nav class="navbar navbar-expand-lg bg-transparent">
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">


          <?php 
              if(isset($_SESSION["level"]) && $_SESSION["level"] !== 0) {
          ?>
        <li class="nav-item">
          <a class="nav-link" href="?p=read">Lire les Articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?p=carte">Voir La Carte</a>
        </li> 
        <?php } ?>
        <li class="nav-item">
          <?php 
              if(isset($_SESSION["level"]) && $_SESSION["level"] > 1) {
          ?>
          <a class="nav-link" href="?p=add_art">Ajouter un Article</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <?php 
              if(isset($_SESSION["level"]) && $_SESSION["level"] > 2) {
          ?>
          <a class="nav-link" href="?p=cont_arts">Contrôler les Articles</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <?php 
              if(isset($_SESSION["level"]) && $_SESSION["level"] > 6) {
          ?>
          <a class="nav-link" href="?p=cont_user" aria-disabled="true">Contrôler les Utilisateurs</a>
        </li>
        <?php
        }
        ?>
               
        <li class="nav-item">
          <?php 
          
              if(isset($_SESSION['monID']) && $_SESSION['monID'] === session_id()) {
          ?>
          <a class="nav-link" href="?p=home&sect=logout" aria-disabled="true">Déconnexion</a>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </nav>
</div>



