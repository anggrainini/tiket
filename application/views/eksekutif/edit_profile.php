<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>User Profile Page - eksekutif</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>



<?php echo form_open_multipart("eksekutif/edit_profile");?>


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">
											<div class="well well-sm">

												<?php
		foreach($data_eksekutif->result_array() as $op)
		{
		?>
		<?php
			if(!empty($op['img']))
				$img=$op['img'];
			else
				$img='avatar.jpg';
												
		;?>
	
											
											
							<?php if(!empty($error)){
									echo '<div class="alert alert-danger" type="hidden">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
									<strong>
												<i class="ace-icon fa fa-times"></i>
												Oh Snap!
											</strong>';
												echo $error; 
												echo validation_errors();
											
										echo	'<br />
										</div>';
							}
							else {
									echo $error;
									echo validation_errors();
							};?>
											

												<!-- -
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		&nbsp; -->
				
											<div class="space"></div>
												
											
												<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																Basic Info
															</a>
														</li>
													</ul>
													<div class="tab-content profile-edit-tab-content">
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller">General</h4>

															<div class="row">	
																<div class="col-xs-12 col-sm-8">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Username</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" name="username" id="username" placeholder="Username" disabled="disabled" value="<?php echo $op['id_eksekutif'] ?>" />
																		</div>
																	</div>
																	
																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Password</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" id="password" name="password" placeholder="Password" value="<?php echo $op['password'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>
																		<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Nama</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" name="nama" id="nama" placeholder="Nama" value="<?php echo $op['nama'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>
																		<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Alamat</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $op['alamat'] ?>" />
																		</div>
																	</div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Image</label>
																		<span class="profile-picture">
																		<img id="avatar" class="editable img-responsive" alt="Profile Picture" height="200" width="300" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />
																		</span>
																		<div class="col-sm-8">
																			<input type="file" class="form-control" id="id-input-file-2" name="userfile">
																		</div>
																	</div>
																	<div class="space"></div>
																	<br />
															<h4 class="header blue bolder smaller">Contact</h4>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Phone</label>

																<div class="col-sm-8">
																	<span class="input-icon input-icon-right">
																		<input class="input-medium input-mask-phone" type="text" name="phone" id="phone" value="<?php echo $op['no_hp'] ?>" />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>
														</div>
														</div>															
														</div>
													</div>
												</div>
												</div><!-- /.span -->

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Save
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
													<?php echo form_close(); ?>
												</div>
										
									</div><!-- /.user-profile -->
								</div>
<?php }?>
		<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

		
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-editable.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace-editable.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

	</body>
</html>
