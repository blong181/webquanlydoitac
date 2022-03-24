<div class="themhoatdong">
	<div class="col-xs-12 text-center">
		<table>
			<tr>
				<h3> THÊM HOẠT ĐỘNG &nbsp;
					<a href="index.php?controller=admin&action=detail&id=<?php echo $_GET['id']; ?>&category=<?php echo $_GET['category'] ?>"> <i class="bi bi-arrow-return-left"></i>
					</a>
				</h3>
			</tr>
		</table>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="table table borderless text-center" style="width:1000px;">
				<tr>
					<td colspan="2">
						<h4> LĨNH VỰC:
							<?php
							if ($_GET['category'] == 'default') {
								foreach ($data_lv as $value) {
									$nhap = $value['id_linhvuc'];
									break;
								}


								echo $get_namelv[$nhap];
							} else {
								echo $get_namelv[$_GET['category']];
							}
							?>
							<?php include_once('listlinhvuc/addandedit_hd.php'); ?>
							<!--gọi danh sách lĩnh vực để chọn -->
						</h4>


					</td>
				</tr>
				<br>
				<tr>
					<td align="right" style="vertical-align:middle;width:13%" >
						<strong>TIÊU ĐỀ:</strong>
					</td>
					<td><input class="form-control" type="text" name="tdhd" placeholder="nhập nội dung"></td>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>PHỤ TRÁCH : </strong>
					</td>
					<td><input class="form-control" type="text" name="phutrach" placeholder="nhập tên  "></td>
				</tr>

				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>THỜI GIAN: </strong>
					</td>
					<td><input class="form-control" type="date" name="tg" placeholder="nhập thời gian"></td>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle" >
						<strong>NỘI DUNG: </strong>
					</td>
					<td width="800px">
						<textarea wrap="hard" rows="7" style="resize: none;" class="form-control" type="text" name="noidung" placeholder="nhap nội dung" ></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" style="vertical-align:middle">
						<strong>ẢNH:</strong>
					</td>
					<td><input type="file" name="hinhanh[]" multiple="multiple"></td>

				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" class="btn btn-default" name="themhoatdong" value="them moi">
					</td>
				</tr>
			</table>

			<br>
			<br>

		</form>

	</div>
</div>