<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Form Wizard - Ace Admin</title>

		<meta name="description" content="and Validation" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" />

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

		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<div class="row">

							<div class="col-xs-12">

								<?php if(!empty($error)){
									echo '	<div class="alert alert-danger" type="hidden">
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

							<?php if($this->session->flashdata('error')){
									echo '	<div class="alert alert-danger" type="hidden">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
									<strong>
												<i class="ace-icon fa fa-times"></i>
												Oh Snap!
											</strong>';
												echo $this->session->flashdata('error');
												
											
										echo	'<br />
										</div>';
								};?>
	

<?php
			foreach($data_jadwal->result_array() as $xx)
			{
				;?>
			

								<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">
										

										<div class="widget-toolbar">
											<label>
												<small class="green">
													
												</small>

												<input id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4" />
												<span class=""></span>
											</label>
										</div>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div id="fuelux-wizard-container">
												<div>
													<ul class="steps">
														<li data-step="1" class="active">
															<span class="step">1</span>
															<span class="title">Detail Pertandingan</span>
														</li>

														<li data-step="2">
															<span class="step">2</span>
															<span class="title">Jumlah Tiket</span>
														</li>

														<li data-step="3">
															<span class="step">3</span>
															<span class="title">Informasi</span>
														</li>

														<li data-step="4">
															<span class="step">4</span>
															<span class="title">Konfirmasi</span>
														</li>
													</ul>
												</div>

												<hr />

												<div class="step-content pos-rel">

												<!--step 1-->
													<div class="step-pane active" data-step="1">
														
														<h3 class="col-sm-1"></h3>
														<h3 class="center col-sm-11 lighter block green">The Match</h3>
																												
														<div class="center col-sm-12">
														<h3 class="col-sm-3"></h3>
																
																<?php
															$tim1=$xx['id_tim1'];
															foreach ($data_tim ->result_array()  as $t1)
															{
																if($t1['id_tim']==$tim1)
																{
																	if(!empty($t1['img']))
																	$img=$t1['img'];
																	else
																	$img='avatar.jpg';
																}
															}
															 ;?> 	

															 <img height="150" class="center col-sm-2" alt="Domain Owner's Avatar" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />

															<h2 class="center col-sm-1">

																<?php $tim1=$xx['id_tim1'];
															foreach ($data_tim ->result_array()  as $aa) 
															{
																if($aa['id_tim']==$tim1)
																{
																	echo $aa['kode_tim'];
																}
															}
																?>
															</h2>

															<h2 class="center col-sm-1">vs</h2>

															<h2 class="center col-sm-1">
														 <?php $tim2=$xx['id_tim2'];
															foreach ($data_tim ->result_array()  as $bb) {
																if($bb['id_tim']==$tim2){
																	echo $bb['kode_tim'];
																}
															}
														?>
															</h2>
																		

																<?php
															$tim2=$xx['id_tim2'];
															foreach ($data_tim ->result_array()  as $t2)
															{
																if($t2['id_tim']==$tim2)
																{
																	if(!empty($t2['img']))
																	$img=$t2['img'];
																	else
																	$img='avatar.jpg';
																}
															}
																 ;?>

															<img height="150" class="center col-sm-2" alt="Domain Owner's Avatar" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />
																		<br />

														</div>


													</div>	
					
				



				
													<!--step 2-->
													<div class="step-pane" data-step="2">
													
													 <img height="350" width="500"  class="center col-sm-6-offset-6" alt="Domain Owner's Avatar" src="<?php echo base_url(); ?>/assets/images/seating.jpg" />

													<h3 class="lighter block green">Pilih Kelas</h3>
														<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>member/simpan_pemesanan/<?php echo $xx['id_jadwal']; ?>" role="form">
															<table id="simple-table" class="table  table-bordered table-hover">


				<?php
				}
				?>
											<thead>
												<tr>
													<th class="center">
															Kelas
													</th>
													<th class="center">Harga</th>
													<th class="center">Sisa Stock</th>
													<th class="center">Jumlah Pembelian</th>
													
												</tr>
											</thead>


			
<?php
			foreach($data_jd_kelas->result_array() as $kls)
			{
				;?>					

											<tbody>
												<tr>
							

													<td class="center">
													     <?php
											
															foreach ($data_kelas ->result_array()  as $t1)
															{
																if($t1['id_kelas']==$kls['id_kelas'])
																{
																	echo $t1['nama_kelas'];

																}
															}
															 ;?> 	
															 <input class="col-xs-12 col-sm-10" type="hidden" name="kelas[]" value="<?php echo $kls['id_kelas'];?>" />
													</td>

													<td>
														<?php echo $kls['harga'];?>
														<input class="col-xs-12 col-sm-10" type="hidden" name="harga_satuan[]" value="<?php echo $kls['harga'];?>" />
													</td>
													<td>
														<?php echo $kls['stock_akhir'];?>
													</td>
					
													<td> <input class="col-xs-12 col-sm-10" type="text" name="jumlah[<?php echo $kls['id_kelas'];	?>]" placeholder="jumlah tiket" /></td>
									
								
			<?php
				}
				?>	

												</tr>
											</tbody>
										</table>
									
													</div>


													<!--step 3-->
													<div class="step-pane" data-step="3">

													<div class="center">
															<h3 class="blue lighter">KONFIRMASI</h3>
														</div>


											<div class="row">
       											 <div class="center col-lg-4">
	       											<p><font size = "4 px">SALDO ANDA</font>
	       	<?php
			foreach($data_member->result_array() as $op)
			{
				;?> 
          										 
          											</br><font size = "3 px">Rp <?php echo number_format($op	['saldo'] , 2, ',', '.').'<br>';  ?> </font>
          		<?php
				}
				?>
          		          		
          											<p></p>
        									</div>
        									<!-- /.col-lg-4 -->

       											 <div class="center col-lg-4">
	       											<p><font size = "4 px">BOOKING INFO</font>
	       											</br><font size = "2 px"><?php $tim1=$xx['id_tim1'];
															foreach ($data_tim ->result_array()  as $aa) {
																if($aa['id_tim']==$tim1){
																	echo $aa['kode_tim'];
																}
															}
														?>
														 vs 
														 <?php $tim2=$xx['id_tim2'];
															foreach ($data_tim ->result_array()  as $bb) {
																if($bb['id_tim']==$tim2){
																	echo $bb['kode_tim'];
																}
															}
														?></font>
	       											</br><font size = "2 px"> <?php $oridate=$xx['tanggal']; $date= date("d-M-Y",strtotime($oridate)); ;?><td><?php echo $date; ?></td></font>
	       											</br><font size = "2 px"><?php echo $xx['jam']; ?></font>
          							
          											<p></p>
        									</div><!-- /.col-lg-4 -->

        									<div class="center col-lg-4">
	       											<p><font size = "4 px">Syarat dan Ketentuan</font>
	       											</br><font size = "2 px">Pastikan jumlah tiket sudah benar.</font>
	       											</br><font size = "2 px">Tiket yang sudah dibeli tidak dapat dikembalikan dengan alasan apa pun.</font>
	       											</br><font size = "2 px">Klik </font><font size = "4 px"> NEXT </font><font size = "2 px">jika anda setuju untuk melakukan pembayaran.</font>

	       									</div>

       											 

        									</div>

       

														
													</div>

													<!--step 4-->
													<div class="step-pane" data-step="4">
														<div class="center">
															<h3 class="green">Congrats!</h3>
															Your product is ready to ship! Click finish to continue!
															<div class="row">
																<button class="btn btn-success" data-last="Finish" type="submit">
																	Syarat dan Ketentuan
																</button>

																</div>
														</div>
													</div>
												</div>
											</div>
											</form>


											<hr />
											<div class="wizard-actions">
												<button class="btn btn-prev">
													<i class="ace-icon fa fa-arrow-left"></i>
													Prev
												</button>

												<button class="btn btn-success btn-next" data-last="Finish">
													Next
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>

								<div id="modal-wizard" class="modal">
									<div class="modal-dialog">
										<div class="modal-content">
											<div id="modal-wizard-container">
												<div class="modal-header">
													<ul class="steps">
														<li data-step="1" class="active">
															<span class="step">1</span>
															<span class="title">Validation states</span>
														</li>

														<li data-step="2">
															<span class="step">2</span>
															<span class="title">Alerts</span>
														</li>

														<li data-step="3">
															<span class="step">3</span>
															<span class="title">Payment Info</span>
														</li>

														<li data-step="4">
															<span class="step">4</span>
															<span class="title">Other Info</span>
														</li>
													</ul>
												</div>

												<div class="modal-body step-content">
													<div class="step-pane active" data-step="1">
														<div class="center">
															<h4 class="blue">Step 1</h4>
														</div>
													</div>

													<div class="step-pane" data-step="2">
														<div class="center">
															<h4 class="blue">Step 2</h4>
														</div>
													</div>

													<div class="step-pane" data-step="3">
														<div class="center">
															<h4 class="blue">Step 3</h4>
														</div>
													</div>

													<div class="step-pane" data-step="4">
														<div class="center">
															<h4 class="blue">Step 4</h4>
														</div>
													</div>
												</div>
											</div>

											<div class="modal-footer wizard-actions">
												<button class="btn btn-sm btn-prev">
													<i class="ace-icon fa fa-arrow-left"></i>
													Prev
												</button>

												<button class="btn btn-success btn-sm btn-next" data-last="Finish">
													Next
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>

												<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancel
												</button>
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

						&nbsp; &nbsp;
						
					</div>
				</div>
			</div>

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
		<script src="<?php echo base_url(); ?>assets/js/wizard.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-additional-methods.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

		<!-- page specific plugin scripts tabel-->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/autosize.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-tag.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				$('[data-rel=tooltip]').tooltip();
			
				$('.select2').css('width','200px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				}); 
			
			
				var $validation = false;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 && $validation) {
						if(!$('#validation-form').valid()) e.preventDefault();
					}
				})
				//.on('changed.fu.wizard', function() {
				//})
				.on('finished.fu.wizard', function(e) {
					bootbox.dialog({
						message: "Informasi : Harap melakukan print Invoice Sebagai bukti untuk Pentukaran Tiket. <br />  ", 
						buttons: {
							"success" : {
								"label" : "OK",
								"className" : "btn-sm btn-primary"
							}
						}
					});
				}).on('stepclick.fu.wizard', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});

				
			
				
			
			
				//jump to a step
				/**
				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
				wizard.currentStep = 3;
				wizard.setState();
				*/
			
				//determine selected step
				//wizard.selectedItem().step
			
			
			
				//hide or show the other form which requires validation
				//this is for demo only, you usullay want just one form in your application
				$('#skip-validation').removeAttr('checked').on('click', function(){
					$validation = this.checked;
					if(this.checked) {
						$('#sample-form').hide();
						$('#validation-form').removeClass('hide');
					}
					else {
						$('#validation-form').addClass('hide');
						$('#sample-form').show();
					}
				})
			
			
			
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
			
				$.mask.definitions['~']='[+-]';
				$('#phone').mask('(999) 999-9999');
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
			
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						email: {
							required: true,
							email:true
						},
						password: {
							required: true,
							minlength: 5
						},
						password2: {
							required: true,
							minlength: 5,
							equalTo: "#password"
						},
						name: {
							required: true
						},
						phone: {
							required: true,
							phone: 'required'
						},
						url: {
							required: true,
							url: true
						},
						comment: {
							required: true
						},
						state: {
							required: true
						},
						platform: {
							required: true
						},
						subscription: {
							required: true
						},
						gender: {
							required: true,
						},
						agree: {
							required: true,
						}
					},
			
					messages: {
						email: {
							required: "Please provide a valid email.",
							email: "Please provide a valid email."
						},
						password: {
							required: "Please specify a password.",
							minlength: "Please specify a secure password."
						},
						state: "Please choose state",
						subscription: "Please choose at least one option",
						gender: "Please choose gender",
						agree: "Please accept our policy"
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
					},
					invalidHandler: function (form) {
					}
				});
			
				
				
				
				$('#modal-wizard-container').ace_wizard();
				$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
				
				
				/**
				$('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				
				$('#mychosen').chosen().on('change', function(ev) {
					$(this).closest('form').validate().element($(this));
				});
				*/
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
			})
		</script>
	</body>
</html>
