<div class="suahoatdong">
	<div class="col-xs-12 text-center">
		<table>
			<tr>
				<h3> SỬA HOẠT ĐỘNG &nbsp;
					<a href="index.php?controller=admin&action=detail&id=<?php echo $_GET['id']; ?>&category=<?php echo $_GET['category'] ?>"> <i class="bi bi-arrow-return-left"></i>
					</a>
				</h3>
				<br>
			</tr>
		</table>
		<br>
		<h4>
			LĨNH VỰC:
			<?php
			echo $get_namelv[$_GET['category']];
			?>
		</h4>

	</div>


	<?php

	if (isset($thanhcong_act) && in_array('add_sucess', $thanhcong_act)) {

		echo "<p style='color: green;text-align:center'> sửa thành công</p>";
	}
	?>

	<?php

	if (empty($data_hd)) {
	?>
		<h4 align="center">
			<?php echo "<p style='color: red;text-align:center'> không có hoạt động để sửa</p>" ?>
		</h4>

		<?php
	} else {
		foreach ($data_hd as $value) {

		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="table table borderless" style="width:1000px;">
				<br>
				<br>
				<tr>
					<input type="hidden" name="idhd" value="<?php echo $value['id_hd']; ?>" readonly='true'>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>TIÊU ĐỀ: </strong>
					</td>
					<td>
						<input class="form-control" type="text" name="tdhd" value="<?php echo $value['td_hoptac']; ?>" placeholder="nhập nội dung">
					</td>
					<td width="20%">
						<input class="btn btn-default" onclick='return confirm("bạn muốn sửa ?")' type="submit" name="suahoatdong" value="cập nhật">
					</td>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>PHỤ TRÁCH :</strong>
					</td>
					<td colspan="2"><input class="form-control" type="text" name="phutrach" value="<?php echo $value['phutrach']; ?>" placeholder="nhập tên  "></td>
				</tr>

				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>THỜI GIAN:</strong>
					</td>
					<td colspan="2">
						<input class="form-control" type="date" name="tg" value="<?php echo date('Y-m-d', strtotime($value["thoigian"])) ?>" placeholder="nhập thời gian">
					</td>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle;width:13%" >
						<strong>NỘI DUNG:</strong>
					</td>
	
					<td style="text-align: center;" align="center" colspan="2" width="800px">
						<textarea wrap="hard" rows="9" style="resize: none;" class="form-control" type="text" name="noidung"><?php echo $value['nd_hoptac']; ?></textarea>
					</td>

				</tr>
				<tr>

					<td align="right">
						<br>
						<strong> FILE:</strong>
					</td>
					<td colspan="2" align="left" style="vertical-align:bottom;">
						<input type="file" name="hinhanh[]" multiple="multiple">
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<!-- nếu không có ảnh height==0 -->
						<div style="overflow-y:scroll; height:<?php if ($data_anh == 0) echo 0;else echo '350px'; ?>;">
							<table class="table table-bordered" align="right" style="width:80%;">
								<?php
								if ($data_anh != 0) {
									$stt = 0;

									foreach ($data_anh as $value_anh) {

								?>

								<tr style="border-bottom:0.5px solid lightgrey;" align="center">
									<td>

										<?php
										if ($value_anh['img'] != NULL) {



										?>
											<br>
											<?php
											if (strpos($value_anh['img'], '.pdf')) {
												$path = '../mvc/View/uploads/doitac/pdf/' . $value_anh['img'];
												$path = str_replace(chr(0), '', $path);
												echo $path;
											} else {
												$path = '../mvc/View/uploads/doitac/pic/' . $value_anh['img'];
												$path = str_replace(chr(0), '', $path);												
											?>

												<img src="<?php echo $path ?>" width="400"> <?php } ?>

											&nbsp;
											&nbsp;
											<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_img&id_hd=<?php echo $value['id_hd']; ?>&name_img=<?php echo $value_anh['img'] ?> "> 
												<i class="bi bi-x-circle-fill"></i>
											 </a>
											<br>
											<br>


											nội dung:

											<input type="text" name="noidung_anh[<?php echo $stt ?>][nd]" value="<?php echo $value_anh['noi_dung'] ?>">
											<input type="hidden" name="noidung_anh[<?php echo $stt ?>][img]" value="<?php echo $value_anh['img']; ?>">
											<input type="hidden" name="noidung_anh[<?php echo $stt ?>][id_hd]" value="<?php echo $value_anh['id_hd']; ?>">

											<br>
											<br>

										<?php
											$stt++;
										}
										?>
									</td>
								</tr>

								<?php

									}
								} ?>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</form>
		<br>
		<br>


	<?php  } //foreach 
	} // else 
	?>
</div>