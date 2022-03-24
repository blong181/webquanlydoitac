<?php
// lấy dữ liệu lĩnh vực tùy theo trang 
$tble = "chitiet_linhvuc";
$tble_2 = "hoptac";
if (isset($_GET['id'])) {
	$data = $db->getAlldataLinhvucId('doitac', 'hoptac', 'chitiet_linhvuc', $_GET['id']);
} else {
	$tble = "chitiet_linhvuc";
	$data = $db->getAlldata($tble);
}

?>
<div class=ct_tt>
	<div class="col-xs-12 text-center">
		<?php

		foreach ($data_doitac as $value) {

		?>
			<br>
			<h3 style="display:inline;">ĐƠN VỊ HỢP TÁC : </h3>
			<h3 style="display:inline;"> <?php echo $value['ten_doitac'] ?> </h3>
			<br>
			<br>
			<br>
			<table class="table table borderless text-center" style=" width:1200px;">
				<tr>
					<td style="vertical-align:top;width: 60%;">
						
					<h4>
						<ul type="circle" align="left">
							<li> <strong> Giới thiệu: <br></strong>
								<h4 style=" margin: 3pt 3pt; padding-bottom: 3pt; text-align: justify;">
									<?php echo nl2br($value['gioithieu']) ?>
								</h4>
							</li>
						</ul>
					</h4>
					</td>					
					<td>	
					<h4>
						<ul type="circle" align="left">
							<li> <strong> Gmail: </strong> <?php echo $value['email'] ?></li>
							<li> <strong>Số điện thoại: </strong> <?php echo $value['sdt'] ?> </li>
							<li> <strong>Địa chỉ: </strong> <?php echo $value['diachi'] ?> </li>
							<li> <strong>Website: </strong>
								<a href="<?php echo $value['website']; ?>" target="_blank">
							 		<?php echo $value['website'] ?>
								</a>
							</li>							
						</ul>
					</h4>
						
					</td>
				</tr>
			</table>

		<?php

		}

		?>
		<?php
		if (!empty($data_lv)) {

			foreach ($data_lv as $value) {

				//lay ten linh vuc
				$get_namelv[$value['id_linhvuc']] = $value['ten_linhvuc'];
			}
		?>

			<h4><br></h4>
			<table class="table table borderless text-center">
				<tr>
					<td>
						<h4 align="center" style="display:inline;"> LĨNH VỰC : </h4>
						<h4 align="center" style="display:inline;"> <?php echo $get_namelv[$_GET['category']] ?></h4>

					</td>
				</tr>
				<tr>
					<td align="center">
						<select style="width: 200px" class="form-control" name="name" onchange="location = this.value;">
							<option value="" disabled selected>Choose option</option>
							<?php
							foreach ($data as $value) {

							?>
								<option value="index.php?controller=client&action=<?php echo $action; ?>&id=<?php echo $_GET['id']; ?>&category=<?php echo $value['id_linhvuc'] ?>">
									<?php echo $value['ten_linhvuc']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>



			<br>
	</div>
	<table class="table table-bordered   text-center" style="width:1000px">

		<?php
			if ($_GET['category'] != '#') {
				$stt = 1;
				if (empty($data_hd)) {
		?>

		<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4>
		<?php
		} else {
			foreach ($data_hd as $value) {
				if ($value['trangthai'] == 1) {

		?>

		<tr class="info">

			<td width="5%" style="border-right: none;">
				<strong>
					<?php echo $stt; ?>)
				</strong>
			</td>
			<td align="center" style="border-left: none;">
				<strong>
					<?php echo $value['td_hoptac'] ?>
					(<?php
						$timestamp = strtotime($value['thoigian']);
						echo date('d/m/Y', $timestamp);
						?>)
				</strong>
			</td>
		</tr>
		<tbody>
			<tr>
				<td colspan="2">
					PHỤ TRÁCH : <?php echo $value['phutrach'] ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left" style="border-bottom: none;">
					<br>
					<!-- nội dung hợp tác -->
					<p style="margin-left: 100px;">
						<?php echo nl2br($value['nd_hoptac']); ?>
					</p>
					<br>
					<p style="margin-left: 100px;">
						<?php

						$data_anh = $db->getDataAnh($value['id_hd'],'hoatdong');
						if ($data_anh != 0) {

							foreach ($data_anh as $value_anh) {
								if ($value_anh['img'] != NULL) {

									## file pdf
									if (strpos($value_anh['img'], '.pdf')) {
										$path = '../mvc/View/uploads/doitac/pdf/' . $value_anh['img'];
										$path = str_replace(chr(0), '', $path);						
										if ($value_anh['noi_dung'] != NULL)
											// in ra tieu def anh 
											echo $value_anh['noi_dung'] . ":";
						?>
										&nbsp;
										<a href="<?php echo $path ?>" target="_blank">
											<?php echo $value_anh['img']; ?> 
										</a>
										<br>

							<?php
									}
								}
							}
							?>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border-top: none;">
					<br>
					<?php
						foreach ($data_anh as $value_anh) {
							if ($value_anh['img'] != NULL) {

								# file anh
								if (strpos($value_anh['img'], '.pdf') == false) {
									$path = '../mvc/View/uploads/doitac/pic/' . $value_anh['img'];
									$path = str_replace(chr(0), '', $path);									
					?>

							<img src="<?php echo $path ?>" width="400">

							<br>
							<br>

							<?php if ($value_anh['noi_dung'] != 'NULL')
										// in ra tieu def anh 
										echo $value_anh['noi_dung'];
							?>
							<br>
							<br>

				<?php
				 			}
						} //if($value_anh['img']!=NULL) {
					} //foreach 
				} //if($data_anh!=0)
				?>

				</td>
			</tr>

		<?php

							$stt++;
						} //if($value['trangthai']==1)
					} //foreach ($data_hd as $value)
				} //else
			} //if($_GET['category']!='#')
		} //else
		?>
		</tbody>
	</table>


</div>