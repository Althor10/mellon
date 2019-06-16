<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="mainContent">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mellon | Editing a blog
            <small>Edit Blog</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">Edit Blog</li>
        </ol>
    </section>
    <?php
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $query = "SELECT * FROM post p WHERE p.post_id = ?";
    $editPost = $conn->prepare($query);
    $rezEditPost = $editPost->execute([$id]);
    $rezEditPost = $editPost->fetchAll();
    foreach ($rezEditPost as $rep):
    ?>

    <section class="content container-fluid">
    <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Post</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="models/admin/editPost.php" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="postTitle">Title</label>
                            <input type="text" name="title" class="form-control" id="postTitle" value="<?= $rep->title ?>" placeholder="Enter the post's title...">
                        </div>
                        <div class="form-group">
                            <label for="postSubtitle">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" id="postSubtitle" value="<?= $rep->subtitle ?>" placeholder="Subtitle">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="0">Choose a category...</option>
                                <?php
                                $categoryQuery = "SELECT * FROM categories";
                                $rezultatCategory = executeQuery($categoryQuery);
                                foreach ($rezultatCategory as $cat):
                                    ?>
                                    <option value="<?= $cat->category_id ?>"><?= $cat->cat_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" id="thumbnail" name="thumbnail">

                            <p class="help-block">Post a thumbnail for the picture that will be shown on the posts section.</p>
                        </div>
                        <div class="form-group">
                            <label for="firstPicture">First Picture</label>
                            <input type="file" id="firstPicture" name="firstPic">

                            <p class="help-block">Post a picture of the post.</p>
                        </div>
                        <div class="form-group">
                            <label for="secondPicture">Second Picture</label>
                            <input type="file" id="secondPicture" name="secondPic">

                            <p class="help-block">Post a second picture for the post.</p>
                        </div>
                        <div class="form-group">
                            <label for="thirdPicture">Third Picture</label>
                            <input type="file" id="thirdPicture" name="thirdPic">

                            <p class="help-block">Post a third picture for the post.</p>
                        </div>
                        <div class="form-group">
                            <label>Textarea</label>
                            <textarea class="form-control" rows="3" id="text" placeholder="Enter your website text..." name="text"><?= $rep->text ?> </textarea>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $id ?>" name="id" id="id">
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary center-block">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->



        </div>
    </div>
    <!-- /.row -->
</section>
    </section>
</div>
<?php endforeach; ?>