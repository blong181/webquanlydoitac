

<style>
  
.table {
   margin: auto;

}

/* setting the text-align property to center*/
.borderless tr td {
    border: none !important;
    
}
</style>
<div class="themnguoidung">
	<div class="col-xs-12 text-center">
		<h3> THÊM TÀI KHOẢN </h3>
		<br>
	</div>
	<form  action="" method="POST">
			<div class="wrapper">
		    <div class="input-box">
		<table class="table  table borderless text-center"  style="width:600px;">
			<tr>
				<td align="right" style="vertical-align:middle;width: 20%;" > 
					<strong>HỌ TÊN:</strong> 
				</td>
				<td style="width: 50%;" >
					<input class="form-control"  type="text" name="user_name" placeholder="nhap ten nguoi dung">
				</td> 
			</tr>

			<tr>
				<td align="right" style="vertical-align:middle">
					<strong>TÀI KHOẢN:</strong> 
				</td>
				<td>
					<input class="form-control"  type="text" name="account" placeholder="nhap tai khoan">
				</td> 
			</tr>
			<tr>
				<td align="right" style="vertical-align:middle">
					<strong>MẬT KHẨU:</strong> 
				</td>
				<td>
					<input class="form-control"  type="text" name="pass" placeholder="nhap mat khau">
				</td> 
			</tr>
			<tr>
				<td colspan="2">
						<input type="submit" class="btn btn-default" name="add_user" value="thêm mới">
				</td>	
			</tr>	
			</table>
		</div>
	</div>
	<br>
	<br>

	</form>
</div>						

