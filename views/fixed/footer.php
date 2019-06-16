<footer class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <?php
            $queryAbout = "SELECT * FROM bloguser WHERE id_role = 1";
            $execAbout = executeQuery($queryAbout);
            foreach ($execAbout as $about):
            ?>
            <div class="col-md-4">
                <h3>About Us</h3>
                <p class="mb-4">
                    <img src="<?= $about->profile_pic ?>" alt="Image placeholder" class="img-fluid">
                </p>

                <p> <?= $about->about ?> <a href="?page=about">Read More</a></p>

            </div>
            <?php endforeach; ?>
            <div class="col-md-6 ml-auto">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Latest Post</h3>
                        <div class="post-entry-sidebar">
                            <ul id="latestFooter">

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-4">

                        <div class="mb-5">
                            <h3>Quick Links</h3>
                            <ul class="list-unstyled">
                                <?php
                                $queryNavigation = "SELECT * FROM nav_menu";
                                $execNav = executeQuery($queryNavigation);
                                foreach($execNav as $nav):
                                ?>
                                <li><a href="<?= $nav->nav_link ?>"><?= $nav->nav_title ?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3>Social</h3>
                            <ul class="list-unstyled footer-social">
                                <li><a href="https://www.facebook.com/althor10"><span class="fa fa-facebook"></span> Facebook</a></li>
                                <li><a href="https://www.instagram.com/patakcoda"><span class="fa fa-instagram"></span> Instagram</a></li>
                                <li><a href="https://www.linkedin.com/in/danilo-zdravkovi%C4%87-2ba717168/"><span class="fa fa-linkedin"></span> LinkedIn</a></li>
                                <li><a href="https://github.com/Althor10"><span  class="fa fa-github"></span> GitHub</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="small">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- END footer -->

</div>
<div class="errors">
    <?php
    if(isset($_SESSION['errors'])):
        $error = $_SESSION['errors'];
        ?>
        <input type="hiddent" value="<?= $error ?>" id="error">
        <script>
            var error = document.getElementById('error').value;
            alert(error);
        </script>
    <?php
    unset($_SESSION['errors']);
    endif; ?>
</div>