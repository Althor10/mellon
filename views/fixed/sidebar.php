<div class="col-md-12 col-lg-4 sidebar">
    <div class="sidebar-box search-form-wrap">
        <form action="#" class="search-form">
            <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
            </div>
        </form>
    </div>
    <!-- END sidebar-box -->
    <div class="sidebar-box">
        <?php
        $bio = executeQuery(getBio());
        foreach($bio as $b):
            ?>
            <div class="bio text-center">
                <img src="<?= $b->profile_pic ?>" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">

                    <h2><?= $b->first_name." ".$b->last_name ?></h2>
                    <p><?= $b->about ?></p>
                    <p><a href="?page=about" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                    <p class="social">
                        <a href="https://www.facebook.com/althor10" class="p-2"><span class="fa fa-facebook"></span></a>
                        <a href="https://github.com/Althor10" class="p-2"><span class="fa fa-github"></span></a>
                        <a href="https://www.instagram.com/patakcoda" class="p-2"><span class="fa fa-instagram"></span></a>
                        <a href="https://www.linkedin.com/in/danilo-zdravkovi%C4%87-2ba717168/" class="p-2"><span class="fa fa-linkedin"></span></a>
                    </p>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- END sidebar-box -->
    <div class="sidebar-box">
        <h3 class="heading">Popular Posts</h3>
        <div class="post-entry-sidebar">
            <ul id="popPosts">

            </ul>
        </div>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Categories</h3>
        <ul class="categories" id="categories">
        </ul>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Tags</h3>
        <ul class="tags" id="tags">

        </ul>
    </div>
</div>
<!-- END sidebar -->

</div>
</div>
</section>