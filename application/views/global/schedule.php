<!DOCTYPE html>


		
<head>

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

	</head>
		
<body>

									
									
												<div>
													<h1 class="center block green">JADWAL PERTANDINGAN</h1>
												</div>		
					<p class="col-lg-3"></p>								

					<img class="col-lg-5" src="<?php echo base_url(); ?>assets2/images/stadion.jpg" class="img-responsive">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-8-offset-2">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th class="center">
															No
													</th>
													<th class="detail-col">Details</th>
													<th align="center">TIM Home </th>
													<th align="center">TIM Away</th>
													<th>Tanggal</th>
													<th>Waktu</th>
													<th></th>
												</tr>
											</thead>
 <?php ;
  $currentffset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
  $slno_start = (($currentffset / $per_page) * $per_page) + 1;
		foreach($data_jadwal->result_array() as $op)
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

													<td class="center">
														<div class="action-buttons">
															<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
																<i class="ace-icon fa fa-angle-double-down"></i>
																<span class="sr-only">Details</span>
															</a>
														</div>
													</td>

													<td>
														<?php $tim1=$op['id_tim1'];
															foreach ($data_tim ->result_array()  as $op2) {
																if($op2['id_tim']==$tim1){
																	echo $op2['kode_tim'];
																}
															}
														 ?>
													</td>
													<td><?php $tim2=$op['id_tim2'];
															foreach ($data_tim ->result_array()  as $op3) {
																if($op3['id_tim']==$tim2){
																	echo $op3['kode_tim'];
																}
															}
														 ?>
														 	
													</td>
					<?php	$oridate=$op['tanggal'];
					$date= date("d-M-Y",strtotime($oridate));
												
					;?> 
													<td><?php echo $date; ?></td>
									
													<td align="left"><?php echo $op['jam']; ?></td>

													<td>
														<div class="hidden-sm hidden-xs btn-group">
															
															<?php
			echo '<a href="'.base_url().'web/operjadwal/'.$op['id_jadwal'].'" rel="example_group"  class="btn btn-xs btn-danger" role="button" <span>BUY NOW <i class="fa fa-shopping-cart" aria-hidden="true"></i></i><span></a>';
			?>

												

															
														</div>

														<div class="hidden-md hidden-lg">
															<div class="inline pos-rel">
																<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
																	<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
																</button>

																<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																	<li>
																		<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
																		</a>
																	</li>

																	<li>
																		<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</td>
												</tr>

		

												<tr class="detail-row">
													<td colspan="8">
														<div class="table-detail">
															<div class="row">
															<div class="col-xs-12 col-sm-2">
																	<div class="text-center">
												<?php
												$tim1=$op['id_tim1'];
															foreach ($data_tim ->result_array()  as $op2) {
																if($op2['id_tim']==$tim1){
																	if(!empty($op2['img']))
																	$img=$op2['img'];
																	else
																	$img='avatar.jpg';
																}
															}
												 ;?> 
													
																		<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />
																		<br />
																		<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																			<div class="inline position-relative">
																				<a class="user-title-label" href="#">
																					<i class="ace-icon fa fa-circle light-green"></i>
																					&nbsp;
																					<span class="white"><?php $tim1=$op['id_tim1'];
																					foreach ($data_tim ->result_array()  as $op2) {
																					if($op2['id_tim']==$tim1){
																						echo $op2['kode_tim'];
																						}
																						}
																					 ?></span>
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-xs-12 col-sm-3">
																
																		<div class="profile-info-row">
																			<div class="profile-info-name">Pertandingan </div>

																			<div class="profile-info-value">
																				<span><?php $tim1=$op['id_tim1'];
																					foreach ($data_tim ->result_array()  as $op2) {
																					if($op2['id_tim']==$tim1){
																						echo $op2['kode_tim'];
																						}
																						}
																					 ?> VS <?php $tim2=$op['id_tim2'];
																					foreach ($data_tim ->result_array()  as $op2) {
																					if($op2['id_tim']==$tim2){
																						echo $op2['kode_tim'];
																						}
																						}
																					 ?></span>
																			</div>
																		</div>

																			<?php
																				$oridate=$op['tanggal'];
																				$tanggal= date("d-M-Y",strtotime($oridate));
												
																			;?> 
												

																		<div class="profile-info-row">
																			<div class="profile-info-name">Tanggal</div>

																			<div class="profile-info-value">
																				<span><?php echo $tanggal; ?></span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name">Jam</div>

																			<div class="profile-info-value">
																				<span><?php echo $op['jam']; ?></span>
																			</div>
																		</div>
																		</div>
																		<div class="col-xs-12 col-sm-2">
																	<div class="text-center">
												<?php
												$tim2=$op['id_tim2'];
															foreach ($data_tim ->result_array()  as $op2) {
																if($op2['id_tim']==$tim2){
																	if(!empty($op2['img']))
																	$img=$op2['img'];
																	else
																	$img='avatar.jpg';
																}
															}
												 ;?> 
													
																		<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url(); ?>uploads/<?php echo $img; ?>" />
																		<br />
																		<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																			<div class="inline position-relative">
																				<a class="user-title-label" href="#">
																					<i class="ace-icon fa fa-circle light-green"></i>
																					&nbsp;
																					<span class="white"><?php $tim2=$op['id_tim2'];
																					foreach ($data_tim ->result_array()  as $op2) {
																					if($op2['id_tim']==$tim2){
																						echo $op2['kode_tim'];
																						}
																						}
																					 ?></span>
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
																		
																
																</div>

																
															</div>
														</div>
													</td>
												</tr>

	<?php
		}
	?>												
														</div>
											</td>
												</tr>
											</tbody>
										</table>
<div class="dataTables_paginate paging_simple_numbers">
            					<?php echo $paginator; ?>
            					</div>
        								
    
															
										

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
