<div class="wrap">
<header role="banner">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-9 social">
                    <a href="https://github.com/Althor10"><span class="fa fa-github"></span></a>
                    <a href="https://www.facebook.com/althor10"><span class="fa fa-facebook"></span></a>
                    <a href="https://www.instagram.com/patakcoda"><span class="fa fa-instagram"></span></a>
                    <a href="https://www.linkedin.com/in/danilo-zdravkovi%C4%87-2ba717168/"><span class="fa fa-linkedin"></span></a>
                </div>
                <div class="col-3 search-top">
                    <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                    <form action="#" class="search-top-form">
                        <span class="icon fa fa-search"></span>
                        <input type="text" id="s" placeholder="Type keyword to search...">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container logo-wrap">
        <div class="row pt-5">
            <div class="col-12 text-center">
                <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
                <h1 class="site-logo"><a href="?page=home">Mellon <img src="assets/images/mellon.png" alt="friend"></a></h1>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container">


            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto">
                    <?php
                    $nav = executeQuery(getNav());
                    foreach($nav as $n ):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $n->nav_link ?>"><?= $n->nav_title ?> </a>
                    </li>
                    <?php endforeach; ?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->role_name == 'blogger(admin)'): ?>
                    <li class="nav-item"> <a class="nav-link" href="?page=admin">Admin Panel</a></li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php
                        if(isset($_SESSION['user'])):
                        ?>
                        <a class="nav-link" href="models/login/logout.php">Logout</a>
                        <?php else: ?>
                        <a class="nav-link" href="?page=login">Login</a>
                        <?php endif; ?>
                    </li>
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle" href="?page=category" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Travel</a>-->
<!--                        <div class="dropdown-menu" aria-labelledby="dropdown04">-->
<!--                            <a class="dropdown-item" href="?page=category">Asia</a>-->
<!--                            <a class="dropdown-item" href="?page=category">Europe</a>-->
<!--                            <a class="dropdown-item" href="?page=category">Dubai</a>-->
<!--                            <a class="dropdown-item" href="?page=category">Africa</a>-->
<!--                            <a class="dropdown-item" href="?page=category">South America</a>-->
<!--                        </div>-->
<!---->
<!--                    </li>-->

                </ul>

            </div>
        </div>
    </nav>
</header>
<!-- END header -->