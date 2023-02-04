<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">VRGenerator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        
        if(isset($_SESSION['login_user_level']) || isset($_SESSION['login_user'])){
                    if($_SESSION['login_user_level'] != "" || $_SESSION['login_user'] != ""){
                        ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                    <a class="nav-link" href="user_profile.php">My Profile
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Logout
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
                    }
             else {
            ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Welcome Guest
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
        }
        }
        else {
            ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Welcome Guest
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
        <?php
        }
        
        ?>
    </div>
</nav>
