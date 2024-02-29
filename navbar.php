<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


    <ul class="nav justify-content-center nav-fill bg-dark text-dark nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="ajout.php">ajoutés une idées</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="ajout_tache.php">ajoutés une tache</a>
      </li>

      <li class="nav-item">
        Dalal jam <?php echo $_SESSION['username']; 
        echo $_SESSION['id']; 
        ?>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-primary position-relative" href="auth/logout.php"">Déconnexion</a>
      </li>
    </ul>
</body>
</html>
