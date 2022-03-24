<div class="themdoitac">
	<div class="col-xs-12 text-center">
		<h3> SỬA ĐỐI TÁC
			<a href="index.php?controller=admin&action=detail&id=<?php echo $_GET['id']; ?>&category=default">
				<i class="bi bi-arrow-return-left"></i>
			</a>
		</h3>
		<br>
	</div>

	<form action="" method="POST">
		<table class="table table borderless  text-center" style="width:800px;">
			<tr>
				<td align="right" style="vertical-align:middle"><strong>TÊN ĐỐI TÁC: </strong></td>
				<td><input class="form-control" type="text" name="tendoitac" value="<?php echo $dataId['ten_doitac']; ?>" placeholder="nhap ten doi tac"></td>
			</tr>

			<tr>
				<td align="right" style="vertical-align:middle">
					<strong> GMAIL: </strong>
				</td>
				<td align="right" style="vertical-align:middle">
					<input class="form-control" type="text" name="email" value="<?php echo $dataId['email']; ?>" placeholder="nhap email">
				</td>
			</tr>
			<tr>
				<td align="right" style="vertical-align:middle">
					<strong>SỐ ĐIỆN THOẠI : </strong>
				</td>
				<td>
					<input class="form-control" type="text" name="sdt" value="<?php echo $dataId['sdt']; ?>" placeholder="nhap so dien thoai">
				</td>
			</tr>
			<tr>
				<td align="right" style="vertical-align:middle">
					<strong>ĐỊA CHỈ : </strong>
				</td>
				<td>
					<input class="form-control" type="text" name="diachi" value="<?php echo $dataId['diachi']; ?>" placeholder="nhap dia chi">
				</td>
			</tr>
			<tr>
				<td align="right" style="vertical-align:middle">
					<strong>WEBSITE : </strong>
				</td>
				<td>
					<input class="form-control" type="text" name="website" value="<?php echo $dataId['website']; ?>" placeholder="nhap dia chi">
				</td>
			</tr>			
			<tr>
				<td align="right" style="vertical-align:middle">
					<strong> GIỚI THIỆU: </strong>
				</td>
				<td>
					
					<textarea  wrap="hard" rows="6" cols="5" style="resize: none;width:500px;overflow: scroll;overflow-x:hidden;" class="form-control" type="text" name="gioithieu"><?php echo $dataId['gioithieu']; ?></textarea>
				</td>
			</tr>
			<tr>

				<td colspan="2">
					<input class="btn btn-default" onclick='return confirm("bạn muốn sửa ?")' type="submit" name="suadoitac" value="cập nhật">
				</td>
			</tr>
		</table>


	</form>


</div>