<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

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

		<style type="text/css" media="print">
@media print {
  body {-webkit-print-color-adjust: exact;}
  a:link:after, a:visited:after {
    content: "";
}
}
@page {
    size:A4 landscape;
    margin-left: 0px;
    margin-right: 0px;
    margin-top: 0px;
    margin-bottom: 0px;
    margin: 0;
    -webkit-print-color-adjust: exact;
}
</style>
	</head>
	<?php
		foreach($data_topup->result_array() as $op)
		{
		?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="space-6"></div>

								<div class="row">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-large">
												<h3 class="widget-title grey lighter">
													<i class="ace-icon fa fa-leaf green"></i>
													Invoice
												</h3>

												<div class="widget-toolbar no-border invoice-info">
													<span class="invoice-info-label">Invoice:</span>
													<span class="red"></span>

													<br />
													<span class="invoice-info-label">Date:</span>
													<span class="blue"><?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo $op2	['tanggal'];
																							}
																											}
																	 ?></span>
												</div>	

												<div class="widget-toolbar hidden-480">
													<a onclick="myFunction()"><i class="ace-icon fa fa-print"></i></a>

<script>
function myFunction() {
    window.print();
}
</script>
														
				
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-6">
															<div class="row">
																<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
																	<b>Maguwoharjo International Stadium</b>
																</div>
															</div>

															<div>
																<ul class="list-unstyled spaced">
																	<li>
																		Jl.Raya Stadion Maguwogarjo No. 1, Maguwoharjo, Depok, Sleman, Yogyakarta, Indonesia - 55283
																		<br>Phone : +62 274 888777
																		<br>Email : support@maguwoharjo-stadium.com
																		<br>Web   : www.maguwoharjo-stadium.com
																	</li>


																	<li class="divider"></li>

																</ul>
															</div>
														</div><!-- /.col -->

														<div class="col-sm-6">
															<div class="row">
																<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
																	<b>

																	<?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['nama'];
																							}
																											}
																	 ?>
																	 </b>
																</div>
															</div>

															<div>
																<ul class="list-unstyled  spaced">
																	<li>
																		<?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['alamat'];
																							}
																											}
																	 ?>
																	 	<br>
																	 	<?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['no_hp'];
																							}
																											}
																	 ?>
																	 	<br>
																	 	<?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['email'];
																							}
																											}
																	 ?>

		<?php
		foreach($data_topupnota->result_array() as $no)
		{
		?>
																		<br>Saldo Sebelum : Rp <?php $no1=$no['id_nota'];
															foreach ($data_topupnota ->result_array()  as $no2) {
																if($no2['id_nota']==$no1){
																	echo number_format($no2	['saldo_sebelum'] , 2, ',', '.').'';
																							}
																											}
																	 ?>
																		<br>Saldo Sesudah : Rp <?php $no1=$no['id_nota'];
															foreach ($data_topupnota ->result_array()  as $no2) {
																if($no2['id_nota']==$no1){
																	echo number_format($no2	['saldo_akhir'] , 2, ',', '.').'';
																							}
																											}
																	 ?>
																	</li>
<?php
	}
	?>
																	<li class="divider"></li>

																	
																</ul>
															</div>
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space"></div>

													<div>
														<table class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th class="center">No</th>
																	<th>Jumlah Top Up</th>
																	<th>Total</th>
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="center">1</td>

																	<td>Rp <?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo number_format($op2	['jumlah_topup'] , 2, ',', '.').'';
																							}
																											}
																	 ?></td>
																	<td>Rp <?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo number_format($op2	['jumlah_topup'] , 2, ',', '.').'';
																							}
																											}
																	 ?></td>
																</tr>
															</tbody>
														</table>
													</div>

													<div class="hr hr8 hr-double hr-dotted"></div>

													<div class="row">
														<div class="col-sm-5 pull-right">
															<h4 class="pull-right">
																Total Bayar :
																<span class="red">Rp <?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo number_format($op2	['jumlah_topup'] , 2, ',', '.').'';
																							}
																											}
																	 ?></span>
															</h4>
															
														</div>
														<div class="col-sm-7 pull-left"> Extra Information </div>
													</div>

													<div class="space-6"></div>
													<div class="well center">
														Terima Kasih Telah Melakukan Top Up.
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
<?php
	}
	?>

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

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>
