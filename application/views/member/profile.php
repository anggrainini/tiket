<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>User Profile Page - Ace Member</title>

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


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								 <?php
		foreach($data_member->result_array() as $op)
		{
		?>
		<?php
			if(!empty($op['img']))
				$img=$op['img'];
			else
				$img='avatar.jpg';
												
		;?> 
								<div class="clearfix">
								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white"><?php echo $op['nama']; ?></span>
														</a>

														
													</div>
												</div>
											</div>

											

											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											<div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> M </span>

													<br />
													<span class="line-height-1 smaller-90"> --- </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> E </span>

													<br />
													<span class="line-height-1 smaller-90"> --- </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"> M </span>

													<br />
													<span class="line-height-1 smaller-90"> --- </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> B </span>

													<br />
													<span class="line-height-1 smaller-90"> --- </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> E </span>

													<br />
													<span class="line-height-1 smaller-90">---</span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> R </span>

													<br />
													<span class="line-height-1 smaller-90">---</span>
												</span>

												
											</div>

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Username </div>

													<div class="profile-info-value">
														<span><?php echo $op['id_member']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Password</div>

													<div class="profile-info-value">
														<span  id="password"><?php echo $op['password']; ?></span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name">Nama</div>
													<div class="profile-info-value">
														<span  id="nama"><?php echo $op['nama']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Alamat</div>

													<div class="profile-info-value">	
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span id="alamat"><?php echo $op['alamat']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">Email</div>

													<div class="profile-info-value">
														<span id="alamat"><?php echo $op['email']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> No HP</div>

													<div class="profile-info-value">
														<span id="no_hp"><?php echo $op['no_hp']; ?></span>
													</div>
												</div>
											</div>
												<?php
		}
	?>
											
												
											</div>

											<div class="space-6"></div>

									</div>
								</div>

							

						

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
