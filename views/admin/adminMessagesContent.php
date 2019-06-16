<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mellon | Messages management
            <small>Messages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">Messages Manage</li>
        </ol>
    </section>


    <section class="content container-fluid">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Messages</h3>

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
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Email</th>
                            </tr>
                            <tbody>
                            <?php
                            $queryMess = "SELECT * FROM contact";
                            $executeMess = executeQuery($queryMess);
                            foreach ($executeMess as $m):
                            ?>
                            <tr>
                                <td><?= $m->name ?></td>
                                <td><?= $m->phone ?></td>
                                <td><?= $m->message ?></td>
                                <td><?= $m->email ?></td>
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


</div>
<!-- /.content-wrapper -->
