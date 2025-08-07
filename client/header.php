<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/discuss"><img style="width:100px;" src="public/discuss-logo-73-6648.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/discuss">Home</a>
        </li>
        <?php if(!$_SESSION['user']['username']){?>
        <li class="nav-item">
          <a class="nav-link" href="?login=true">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?signup=true">SignUp</a>
        </li><?php }?>
        <?php if($_SESSION['user']['username']){?>
        <li class="nav-item">
          <a class="nav-link" href="./server/requests.php?logout=true">Logout<?php echo"(".ucfirst($_SESSION['user']['username']).")" ?></a>
          
        </li><?php }?>
         <?php if($_SESSION['user']['username']){?>
        <li class="nav-item">
          
          <a class="nav-link" href="?ask=true">Ask A Question</a>
        </li><?php }?>
       <?php if($_SESSION['user']['username']){?>
        <li class="nav-item">
          
          <a class="nav-link" href="?u_id=<?php echo$_SESSION['user']['user_id'];?>">My Questions</a>
        </li><?php }?>
        <li class="nav-item">
          <a class="nav-link" href="?latest=true">Lastest Questions</a>
        </li>

      <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1){?>
        
        <li class="nav-item">
          <a class="nav-link" href="/discuss/admin/admin-dashboard.php">Admin Dashboard</a>
        </li>

        <?php }?>

        <li class="nav-item">
          <a class="nav-link" href="?contact=true">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" name = "search"type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>