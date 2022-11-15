<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Badminton</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="/../if3a/index.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/../if3a/search.php?list=users">Utilisateurs</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/../if3a/search.php?list=terrains">Terrains</a>
	      </li>
            <li class="nav-item">
                <a class="nav-link" href="/../if3a/match.php">Match</a>
            </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0" action="/../if3a/search.php?list=users">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
            <input type="hidden" name="list" value="users">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form>
	    <?php 
	          if (isset($_SESSION['id'])) {

              ?>
	            <div class="dropdown ml-2 ml-sm-2">
	              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compte</button>
	              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                <a class="dropdown-item" href="/../if3a/user.php?id=<?php print($_SESSION['id']); ?>">Profile</a>
                  <?php 
                  
                  $nav_admin_test_req = $bdd->prepare("SELECT role FROM utilisateur WHERE id = ?");
                  $nav_admin_test_req->execute([$_SESSION['id']]);
                  if($nav_admin_test_req->fetch()['role'] == 2){

                  ?>
                  <a class="dropdown-item" href="/../if3a/admin/">Admin panel</a>
                  <?php } ?>
	                <a class="dropdown-item text-danger" href="logout.php">Déconnexion</a>
	              </div>
	            </div>
            <?php        
	          }else{
	            echo '<a class="btn btn-outline-primary ml-2 ml-sm-2" href="login.php">Log in</a></br><a class="btn btn-outline-primary ml-2 ml-sm-2" href="signin.php">Sign in</a>';
	          }
	      ?>
	  </div>
</nav>