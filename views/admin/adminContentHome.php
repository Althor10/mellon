<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="mainContent">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mellon | Posting a blog
            <small>New Blog</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">New Blog</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <?php
        $file = file(LOG_FILE);

        $smth = "";
        $array = [];

        foreach($file as $f){
            $data = explode("\n",trim($f));
            for($i = 0; $i<count($data);$i++){
                $smth .= $data[$i];
                array_push($array,$data[$i]);
            }
        }

        ?>
        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Tracking </h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>IP</th>
                                    <th>Log Date</th>
                                    <th>Log Time</th>
                                    <th>Page</th>
                                </tr>

                                <tbody>
                                <?php
                                foreach ($array as $a):
                                $exploded = explode(" ",$a);
                                $pageDateFull = explode(" ",$exploded[0]);

                                $pageDate = explode(".",$pageDateFull[0]);
                                //var_dump($pageDate);
                                $page = $pageDate[0].".php";
                                $date = substr($pageDate[1],3);

                                $timeIpFull = explode(" ",$exploded[1]);

                                $timeIp = explode(":",$timeIpFull[0]);
                               // var_dump($timeIp);
                                $time = $timeIp[0].":".$timeIp[1].":".substr($timeIp[2],0,2);
                                $ip = substr($timeIp[2],2);
                                ?>
                                <tr>
                                    <td><?= $ip ?></td>
                                    <td><?= $date ?></td>
                                    <td><?= $time ?></td>
                                    <td><?= $page ?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->


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
                        <form role="form" method="post" action="models/admin/newPost.php" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="postTitle">Title</label>
                                    <input type="text" name="title" class="form-control" id="postTitle" placeholder="Enter the post's title...">
                                </div>
                                <div class="form-group">
                                    <label for="postSubtitle">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" id="postSubtitle" placeholder="Subtitle">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="0">Choose a ctegory...</option>
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
                                    <textarea class="form-control" rows="3" id="text" placeholder="Enter your website text..." name="text"></textarea>
                                </div>
                            </div>
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


        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Posts</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Post Title</th>
                                <th>Description</th>
                                <th>Comments (Number)</th>
                                <th>Category</th>
                                <th>Post Date</th>
                            </tr>
                            <tbody id="daBody">

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

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
        <?php endif; ?>
</div>