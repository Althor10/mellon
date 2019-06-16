<section class="site-section pt-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <?php
                if(isset($_GET['id'])):
                    $catId = $_GET['id'];
                    ?>
                    <input type="hidden" value="<?=$_GET['id']?>" id="catId" name="catId">
                    <?php $cats_name = getCategoryOne($catId);
                    foreach($cats_name as $cn):?>
                    <h2 class="mb-4">Category: <?= $cn->cat_name?></h2>
                <?php endforeach; ?>

                <?php
                    else:
                    ?>
                        <h2 class="mb-4">Category: All</h2>
                <?php endif; ?>

            </div>
        </div>
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
                <div class="row mb-5 mt-5">

                    <div class="col-md-12" id="postsCat">




                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>



            </div>

            <!-- END main-content -->
