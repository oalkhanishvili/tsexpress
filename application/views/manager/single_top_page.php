  <div id="page-wrapper">

            <div class="container-fluid">
<?php if (!$this->session->flashdata('message') == null): ?>
    <div class="alert alert-success" role="alert">
        <a href="#" class="alert-link"><?php echo $_SESSION['message']; ?></a>
    </div>
<?php endif; ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ზედა გვერდები
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href=<?php echo site_url('manager');?>>მთავარი</a>
                            </li>
                            <li>
                                <i class="fa fa-table"></i><a href=<?php echo site_url('manager/top_page');?>> ზედა გვერდები</a>
                            </li>
                            <li class="active">
                             <i class="fa fa-table"></i> <?php echo $page['menu_name']; ?>
                            </li>
                        </ol>
                    </div>
               

                <div class="row">
                    <div class="col-lg-8">
                            <div class="form-group">
                                <label>სათაური</label>
                            <form action="<?php echo site_url('manager/update_top_page/'.$page['id']); ?>" method="post">
                                <input name="title" class="form-control" value="<?php echo $page['menu_name'];?>">
                                
                                <label>კონტენტი</label>
                                <p><textarea name="content" id="editor1" rows="10" cols="80">
                                <?php echo $page['content']; ?>
                                </textarea>
                                </p>
                                <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                                </script>
                                <p>
                                    <label>პოზიცია მენიუში</label>
                                    <input name="position" class="form-control" value="<?php echo $page['position'];?>">
                                </p>
                                <button type="submit">რედაქტირება</button>
                            </form>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->