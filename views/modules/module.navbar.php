<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:42
 */ ?>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsablePart" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">HacKriri</a>
    </div>

      <div class="collapse navbar-collapse" id="collapsablePart">

      <?php //Navbar if user is logged
        if(isLogged()) {
            ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile"> <?php echo user()->getUserName(); ?> <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
            <?php if (user()->isAdmin()){?><li><a href="admin"> Admin </a></li><?php } ?>
            <li><a href="logout.php">Log out <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
          </ul>
          <?php
        } else {
          ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
          </ul>
          <?php
        }
      ?>
      </div>
  </div>
</nav>