<!-- Content -->
<script type="text/javascript">
		function show_confirm(act,gotoid)
		{
		if(act=="delete")
			var r=confirm("Do you really want to delete?");
		else if(act=="Hide")
			var r=confirm("Do you want to hide the message?");
		else
			var r=confirm("Do you want to show the message?");

		if (r==true)
			{
				window.location="<?php echo base_url();?>admin/"+act+"/"+gotoid;
			}
		}
	</script>
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;">GUESTBOOK</div>
<div style="float:right;">
</div>



<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels">
		<thead>
			<tr>
				<th>Name</th>
				<th>E-Mail</th>
				<th>Message</th>
				<th>Date Created</th>
				<th>Status</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($gbook_list as $row){ ?></td>
		
		<?php if($row->status=='1'){
			$view ="Enable";
			$show="Hide";
		}else{
			$view = "Disable";
			$show="Show";
		}
		?>
			<tr>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->email; ?></td>
				<td><?php echo $row->comment; ?></td>
				<td><?php echo $row->datetime; ?></td>
				<td><?php echo $view;?></td>
				<td width="40" align="left" ><a href="#" onClick="show_confirm('<?php echo $show; ?>',<?php echo $row->id_guest;?>)"><?php echo $show;?></a></td>
				<td width="40" align="left" ><a href="#" onClick="show_confirm('delete',<?php echo $row->id_guest;?>)">Delete </a></td>
			
			</tr>
		</tbody>
		
			<?php }?>
	</table>

	<br />
	 <div style="font-size:15px; color: black; padding-bottom: 15px; float:right;">Page : <?php echo $halaman;?></div>

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

		
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
