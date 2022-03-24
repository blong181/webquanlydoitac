<div class=ct_tt>
	<div class="col-xs-12 text-center">
		<?php

		foreach ($data_doitac as $value) {

		?>
		<br>
		<table class="table table borderless" align="center" style=" width:1200px;">
			<tr>
				<td colspan="3">
					<h3 style="display:inline;">ĐƠN VỊ HỢP TÁC : </h3>
					<h3 style="display:inline;"> <?php echo $value['ten_doitac'] ?> </h3>
					<a href="index.php?controller=admin&action=edit&id=<?php echo $value['id_doitac']; ?>">
						<i class="bi bi-pencil"></i></a>
					<br><br><br><br>
				</td>

			</tr>


			<tr>
				<td align="left" style="vertical-align:top;" >
					<h4>
						<ul type="circle" align="left">

							<li> <strong> Giới thiệu: <br></strong>
								<h4 style=" margin: 3pt 3pt; padding-bottom: 3pt; text-align: justify;">
									<?php echo  nl2br($value['gioithieu']) ?>
								</h4>
							</li>

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
				<!-- căn giữa -->
				<td width="50px">

				</td>
				<td style="vertical-align:top;" width="450px">

					<?php include_once('listlinhvuc/detail_dt.php'); ?>

				</td>
			</tr>
		</table>
		<?php

		}

		?>


		<?php
		if (empty($data_lv)) {
			echo "không có hoạt động hợp tác nào";
		} else {
			foreach ($data_lv as $value) {

				//lay ten linh vuc
				$get_namelv[$value['id_linhvuc']] = $value['ten_linhvuc'];
		?>


			<?php
			}
			?>

			<h4> <br><br><br> </h4>
			<h4 align="center" style="display:inline;"> LĨNH VỰC : </h4>
			<h4 align="center" style="display:inline;"><?php echo $get_namelv[$_GET['category']] ?> </h4>
			&nbsp;


			<a href="index.php?controller=admin&action=add_act&id=<?php echo $_GET['id']; ?>&category=<?php echo $_GET['category']; ?> ">
				<i class="bi bi-plus-square"></i>
			</a>


		<?php } ?>


		<h4><br></h4>
	</div>

	<br>

	<?php if (empty($data_lv)) {
	?>

		<h4 align="center"> <?php echo ' thêm lĩnh vực để tiếp tục '; ?> </h4>
	<?php
	} else {
	?>

		<table class="table table-bordered  text-center" style="width:1000px">

			<?php
			if ($_GET['category'] != 'default') {
				$stt = 1;
				if (empty($data_hd)) {
			?>
					<h4 align="center"> <?php echo ' chưa có hoạt động '; ?> </h4>

					<?php } else {
					foreach ($data_hd as $value) {


					?>

			<tr class="info">

				<td style="border-right: none;" width="10%">
					<strong><?php echo $stt; ?>)</strong>
				</td>
				<td style="border-left: none;border-right: none;" width="80%">
					<strong>
						<?php echo $value['td_hoptac'] ?>
						(<?php
							$timestamp = strtotime($value['thoigian']);
							echo date('d/m/Y', $timestamp);
							?>)


						<?php if ($value['trangthai'] == 0) {
							echo '( đã ẩn )';
						}
						?>
					</strong>
				</td>
				<td style="border-right: none;border-left: none;">
					<a href="index.php?controller=admin&action=edit_act&id=<?php echo $_GET['id']; ?>&category=<?php echo $_GET['category']; ?>&id_hd=<?php echo $value['id_hd']; ?>">
						<i class="bi bi-pencil"></i>
					</a>

				</td>
				<td style="border-left: none;border-right: none;">
					<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_act&id_hd=<?php echo $value['id_hd']; ?>&id=<?php echo $value['id_doitac']; ?>&id_catg=<?php echo $value['id_linhvuc']; ?>
						"><i class="bi bi-x-circle-fill"></i></i>
					</a>

				</td>

				<td style="border-right: none;border-left: none;">
					<a onclick='return confirm("bạn muốn ẩn thông tin ?")' href="index.php?controller=admin&action=hid_act&id=<?php echo $value['id_doitac']; ?>&id_hd=<?php echo $value['id_hd']; ?>&id_catg=<?php echo $value['id_linhvuc']; ?>&act_1=hide
						"><i class="bi bi-circle-fill"></i>
					</a>

				</td>
				<td style="border-left: none;">
					<a onclick='return confirm("bạn muốn hiện thông tin ?")' href="index.php?controller=admin&action=hid_act&id=<?php echo $value['id_doitac']; ?>&id_hd=<?php echo $value['id_hd']; ?>&id_catg=<?php echo $value['id_linhvuc']; ?>&act_1=show
						"><i class="bi bi-circle"></i>
					</a>

				</td>


			</tr>

			<tbody>
				<tr>
					<td colspan="6">

						PHỤ TRÁCH : <?php echo $value['phutrach'] ?>

					</td>
				</tr>
				<tr style="border-bottom:none;">
					<td colspan="6" align="left" style="border-bottom:none;width: 800px;" >
						<br>
						<!-- nội dung hợp tác -->
						<p style="padding-left: 100px;"> 
						<?php echo nl2br($value['nd_hoptac']);?>
						</p>

						<?php
						$data_anh = $db->getDataAnh($value['id_hd'],'hoatdong');
						if ($data_anh != 0) {
						?>
							<br>

							<p style="margin-left: 100px;">
								<?php
								// in ra danh sách file pdf	 								
								foreach ($data_anh as $value_anh) {
									if ($value_anh['img'] != NULL) {

										if (strpos($value_anh['img'], '.pdf')) {
											$path = '../mvc/View/uploads/doitac/pdf/' . $value_anh['img'];
											$path = str_replace(chr(0), '', $path);											
								?>

											<?php 
											if ($value_anh['noi_dung'] != null)
											{
												// in ra tieu def anh 
												echo $value_anh['noi_dung'] . ':';
											}	
											?>
											&nbsp;
											<a href="<?php echo $path ?>" target="_blank">
												<?php echo $value_anh['img']; ?> 
											</a>

											<br>

								<?php
										} //if($value_anh['img']!=NULL)
									} //foreach($data_anh as $value_anh)
								} //if($data_anh!=0)
								?>
							</p>
					</td>
				</tr>

				<tr style="border-top: none;">
					<td colspan="6" style="border-top: none;">
						<br>
						<?php
							// in danh sách hình
							foreach ($data_anh as $value_anh) {
								if ($value_anh['img'] != NULL) {
									// không phải là file pdf
									if (strpos($value_anh['img'], '.pdf') == false) {
										$path = '../mvc/View/uploads/doitac/pic/' . $value_anh['img'];
										$path = str_replace(chr(0), '', $path);										
						?>

									<img src="<?php echo $path ?>" width="400">

									<br>
									<br>

									<?php if ($value_anh['noi_dung'] != 'NULL')
											// in ra tieu def anh 
											echo $value_anh['noi_dung']
									?>
									<br>
									<br>

					<?php 	}
								} //if($value_anh['img']!=NULL)
							} //foreach($data_anh as $value_anh)
						} //if($data_anh!=0)
					?>

					</td>
				</tr>


				<?php

						$stt++;
					} //foreach ($data_hd as $value)
				} //else
			} //if($_GET['category']!='default')
				?>

			</tbody>
		</table>

	<?php } //else
	?>

	<br>
	<br>
</div>