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
		foreach($data_pemesanan->result_array() as $op)
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
													<span class="blue"><?php echo $op['tgl_pemesanan'];?>
													</span>
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
																		Alamat : <?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['alamat'];
																							}
																											}
																	 ?>
																	 	<br>
																	 	No HP : <?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['no_hp'];
																							}
																											}
																	 ?>
																	 	<br>
																	 	E-Mail : <?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['email'];
																							}
																											}
																	 ?>

																	</li>



																	<li class="divider"></li>
																		<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
																	<b>
																		Jadwal Pertandingan
																	 </b>
																</div>
																<br>
<?php 
		foreach($data_jadwal->result_array() as $op4)
		{
		?>													Pertandingan :	
															<?php $tim1=$op4['id_tim1'];
																foreach ($data_tim ->result_array()  as $op5) {
																	if($op5['id_tim']==$tim1){
																		echo $op5['kode_tim'];
																	}
																}?>  VS  

																<?php $tim2=$op4['id_tim2'];
																foreach ($data_tim ->result_array()  as $op5) {
																	if($op5['id_tim']==$tim2){
																		echo $op5['kode_tim'];
																	}
																}?>
																<br>

																Tanggal : <?php echo $op4['tanggal'];?>
																<br>
																Jam : <?php echo $op4['jam'];?>

																	
<?php };?>
																	
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
																	<th>Nama Kelas</th>
																	<th class="center">Jumlah Tiket</th>
																	<th class="center">Harga Satuan</th>
																	<th>Subtotal</th>
																</tr>
															</thead>

															<tbody>
															<?php ;
 $slno_start=1;
		foreach($detail_pesan->result_array() as $op2)
		{
		?>
																<tr>

																	<td class="center"><?php echo $slno_start++ ;?></td>
																	<td><?php $me1=$op2['id_kelas'];
																foreach ($data_kelas ->result_array()  as $op3) {
																if($op3['id_kelas']==$me1){
																	echo $op3['nama_kelas'];}}?></td>
																	<td class="center"><?php echo $op2['jumlah'];?></td>
																	<td align="right">Rp <?php 
																	echo number_format($op2	['harga_satuan'] , 2, ',', '.').'';
																						
																	 ?></td>
																	 <td align="right">Rp <?php 
																	echo number_format($op2	['total_harga'] , 2, ',', '.').'';
																						
																	 ?></td>

																
																</tr>

		<?php
		}
	?>	
															</tbody>
														</table>
													</div>


													<div class="hr hr8 hr-double hr-dotted"></div>

													<div class="row">
														<div class="col-sm-5 pull-right">
															<h4 class="pull-right">
																Total Bayar :
																<span class="red">Rp <?php 
																	echo number_format($op	['grand_total'] , 2, ',', '.').'';
																						
																	 ?></span>
															</h4>
															
														</div>
														<div class="col-sm-7 pull-left"> Extra Information </div>
													</div>

													<div class="space-6"></div>
													<div class="well center">
														Terima Kasih Telah Melakukan Pemesanan Tiket. 
														<br>
														Tiket dapat diambil H-3 sebelum pertandingan di Konter penukaran tiket dengan menunjukan Invoice ini. 
														<br>
														*)Print Invoice dengan Klik Logo Printer diatas 

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
