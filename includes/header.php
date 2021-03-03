<?php
include_once './language.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <link rel="stylesheet" href="assets/css/style.css">

</head>

<!-- Navbar section below -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php"><?php echo $lang['SITE_NAME']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php echo $currentPage == 'index.php' ? 'active' : ''?>">
          <a class="nav-link" href="index.php"><?php echo $lang['MENU_HOME']; ?></a>
        </li>
        <li class="nav-item <?php echo $currentPage == 'register.php' ? 'active' : ''?>">
          <a class="nav-link" href="register.php"><?php echo $lang['MENU_ABOUT_US']; ?></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $currentPage.'?lang=hi'?>" class="nav-link">हिन्दी</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $currentPage.'?lang=en'?>" class="nav-link">English</a>
        </li>
      </ul>
    </div>
  </nav>