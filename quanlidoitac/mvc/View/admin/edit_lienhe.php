<style type="text/css">
	td,tr {
		border-right: 1px solid lightgrey;
		border-left:1px solid lightgrey;
	}
</style>
<div class="sualienhe">
	<div class="col-xs-12 text-center">
		<h3>CHỈNH SỬA LIÊN HỆ

		</h3>
		<br>
	</div>

	<form action="" method="POST">
		<div class="wrapper">
			<div class="input-box">
				<table class="table table borderless text-center" style="width:400px">
					<tr style="border-left: none;border-right: none;" >
						<td align="right">
							<h4> số lượng liên hệ :&nbsp; </h4>
						</td>
						<td width="100px">
							<input class="form-control" type="text" name="soluong">
						</td>
						<td colspan="2">
							&nbsp;
							<input type="submit" class="btn btn-default" name="themsoluonlh" value="them moi">
						</td>
					</tr>
				</table>
				<br>
				<table class="table table borderless text-center" style="width:800px;">
				<?php
				$stt = 0;
				foreach ($data_lh as $value) {
				?>	
					<tr>
						<th class="info" style="text-align:center;" colspan="3">
							<strong>LIÊN HỆ &nbsp;<?php echo $stt+1; ?></strong>
						</th>	
					</tr>
					<tr style="border-top:1px solid lightgrey;">
						<td align="right" style="vertical-align:middle">
							<strong>TÊN LIÊN HỆ &nbsp;:</strong>

						</td>
						<td>
							<input class="form-control" type="text" name="tenlh<?php echo $stt; ?>"
							value="<?php echo $value['lh_ten'] ?>">
						</td>
						<td>
							<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_contact&id=<?php echo $stt; ?>">
								<i class="bi bi-x-circle-fill"></i></i>
							</a>									
						</td>	
					</tr>
					<tr>
						<td align="right" style="vertical-align:middle">
							<strong>GMAIL &nbsp;: </strong>
						</td>
						<td>
							<input class="form-control" type="text" name="gmail<?php echo $stt; ?>"
							value="<?php echo $value['lh_gmail'] ?>">
						
						</td>
					</tr>							
					<tr style="border-bottom:1px solid lightgrey;">
						<td align="right" style="vertical-align:middle">
							<strong>SDT &nbsp;: </strong>
						</td>
						<td >
							<input class="form-control" type="text" name="sdt<?php echo $stt; ?>"
							value="<?php echo $value['lh_sdt'] ?>">
						
						</td>
					</tr>
					
					<?php
					 $stt++;
					 }
					 ?>	
	
				</table>
				<table  class="table table borderless text-center" width="30%"> 
					<tr>
						<td colspan="2">
							<input type="submit" class="btn btn-default" name="capnhatlienhe" value="cập nhật">
						</td>
					</tr>						
				</table>		
			</div>
		</div>
	</form>	
</div>