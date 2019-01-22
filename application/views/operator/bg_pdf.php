<style type="text/css">
#table{
	width:300px;
	border:1px solid #666;
	text-align:center;
	
	
}
</style>
<h3 align="center">DATA PESERTA YANG BERHAK MENDAPATKAN KARTU BEROBAT GRATIS</h3>
<table width="800" align="center" cellpadding="1" cellspacing="1" border="1">
<tr align="center"><td height="30" colspan="4"><strong>DATA PESERTA</strong></td></tr>
<tr align="center" >
<td width="43" height="30">No</td>
<td width="294">Nama</td>
<td width="300">Alamat</td>
<td width="60">Ranking</td>
</tr>
	
				

<?php $no = 1;
 foreach($data ->result_array() as $dt){;?>
				<tr>
						<td><?php echo $no ;?></td>
						<td><?php echo $dt['nama'];?></td>
						<td><?php echo $dt['username'];?></td>
						<td><?php echo $dt['password'];?></td>
				</tr>
				
				<?php $no++;};?> 
				</table>	
			