
<div class="content">
    <div class="container">
        <div class="row text-center pad-top ">
            <div class="col-md-12">
                <h2>Registration Page</h2>
            </div>
        </div>
         <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>Register Member</strong>  
                            </div>
                            <div class="panel-body">
                                 <?php echo form_open('web/cek_registrasi'); ?>
                                        <br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Nama" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Alamat" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Username" />
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Password" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Ulangi Password" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Nomer Handphone" />
                                        </div>
                                        <div class="form-group input-group">
                                             <label class="control-label">Gambar Profil</label>
                                            <input id="input-1" type="file" class="file">
                                        </div>
                                         <?php echo form_submit('submit', 'Register', ' class="btn btn-success"');?> 
                                    <hr />
                                    Already Registered ?  <a href="<?php echo base_url(); ?>web/log">Login here</a>
                                    <?php echo form_close(); ?>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/plugins/bootstrap.js"></script>
