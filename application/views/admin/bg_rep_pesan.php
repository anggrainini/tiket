
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />

		<meta name="description" content="overview &amp; stats" />
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
<a onclick="myFunction()"><i class="ace-icon fa fa-print"></i> Print</a>

<script>
function myFunction() {
    window.print();
}
</script>
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="center">
															No
													</th>
												
													<th>ID Member</th>
													<th>Nama Member</th>
													<th>Jadwal Pertandingan</th>
													<th>Tanggal Pemesanan</th>
													<th class="center">Total Pemesanan</th>
													
												</tr>
											</thead>
     	<?php ;
  $slno_start = 1;
		foreach($report->result_array() as $op)
		{
		?>		
											<tbody>
												<tr>
													<td class="center">
														<label class="pos-rel">
														<?php echo $slno_start++ ;?>
															<span class="lbl"></span>
														</label>
													</td>
													<td><?php echo $op['id_member'];?></td>
													<td>
													<?php $id_member=$op['id_member'];
													foreach ($data_member ->result_array()  as $op2) {
															if($op2['id_member']==$id_member){
																echo $op2['nama'];
															}
													}
													?>
													</td>

													<td>
													<?php $jadwal=$this->football_model-> getDetailjadwal($op['id_jadwal']);
															foreach ($jadwal->result_array() as $op3) {
																foreach ($data_tim ->result_array()  as $op4) {
																	if($op4['id_tim']==$op3['id_tim1']){
																		echo $op4['kode_tim']; 
																		echo " VS ";
																	}
																
																	if($op4['id_tim']==$op3['id_tim2']){
																		echo $op4['kode_tim'];
																	}


																}

															}

													?>
													</td>

													<td><?php echo $op['tgl_pemesanan']; ?></td>
													<td align="right">Rp <?php echo number_format($op	['grand_total'] , 2, ',', '.').'<br>';  ?> </td>
													
													
												</tr>

	<?php
		}
	?>												
											
											</td>
												</tr>
											</tbody>
										</table>
<?php $query = $this->db->query("Select sum(grand_total) as total from tb_pemesanan");

foreach ($query->result() as $row)
{;?>
        

										<div class="hr hr8 hr-double hr-dotted"></div>

													<div class="row">
														<div class="col-sm-4 pull-right">
															<h4 class="pull-right">
																Total TopUp :
																<span class="red">Rp <?php 
																	echo number_format($row->total, 2, ',', '.').'';
																						
																	 ?></span>
															</h4>
															
														</div>
 <?php };?>					
    </div>
					</div><!-- /.span -->
								</div><!-- /.row -->
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
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
			
			})
		</script>
	</body>
</html>
