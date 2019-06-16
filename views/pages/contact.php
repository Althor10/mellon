<section class="site-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Contact Me</h1>
            </div>
        </div>
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">

                <form action="models/contact/contactMe.php" method="post">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="name">Name</label>
                            <input type="text" id="contactName" class="form-control " name="cName">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="contactPhone" class="form-control " name="cPhone">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="contactEmail" class="form-control " name="cEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="message">Write Message</label>
                            <textarea name="cMess" id="contactMessage" class="form-control " cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if(isset($_SESSION['user'])):
                            $user_id = $_SESSION['user']->user_id;
                        ?>
                        <input type="hidden" value="<?= $user_id ?>" id="userId" name="userId">
                        <?php endif; ?>
                        <div class="col-md-6 form-group">
                            <input type="submit" value="Send Message" id="btnSubmitMessage" name="btnSubmit" class="btn btn-primary">
                        </div>
                    </div>
                </form>


            </div>

            <!-- END main-content -->
