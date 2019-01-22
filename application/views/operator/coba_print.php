<!DOCTYPE html>
<html lang="en">
	<head>
	<h1>Laporan iki</h1>
	</head>
	<?php
		foreach($data_topup->result_array() as $op)
		{
		?>
			
												<h3>
													<i></i>
													Invoice
												</h3>


													<span>Invoice:</span>

													<br />
													<span>Date:</span>
													<span><?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo $op2	['tanggal'];
																							}
																											}
																	 ?></span>
										

											


																		<br>Maguwoharjo International Stadium
																		<br>Jl.Raya Stadion Maguwogarjo No. 1, Maguwoharjo, Depok, Sleman, Yogyakarta, Indonesia - 55283
																		<br>Phone : +62 274 888777
																		<br>Email : support@maguwoharjo-stadium.com
																		<br>Web   : www.maguwoharjo-stadium.com
																	</li>


																<br>

																	<?php $me1=$op['id_member'];
															foreach ($data_member ->result_array()  as $op2) {
																if($op2['id_member']==$me1){
																	echo $op2['nama'];
																							}
																											}
																	 ?>
																	 <br>
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
																
<?php
	}
	?>
																
														<table>
															<thead>
																<tr>
																	<th>No</th>
																	<th>Jumlah Top Up</th>
																	<th>Total</th>
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td>1</td>

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
													

											
<br>
																Total Bayar :
																<span class="red">Rp <?php $me1=$op['id_topup'];
															foreach ($data_topup ->result_array()  as $op2) {
																if($op2['id_topup']==$me1){
																	echo number_format($op2	['jumlah_topup'] , 2, ',', '.').'';
																							}
																											}
																	 ?></span>
															
															
														
													
<?php
	}
	?>
	</body>
</html>
