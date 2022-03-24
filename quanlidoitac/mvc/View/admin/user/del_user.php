<style>
  
 tr {
	border-bottom:1px solid lightgrey;
	border-left:1px solid lightgrey;
	border-right:1px solid lightgrey;
	border-top: 1px solid lightgrey;
 }
/* setting the text-align property to center*/

</style>

<div class="add_user">
<div class="col-xs-12 text-center">
		<h3> XÓA TÀI KHOẢN </h3>
		<br>
</div>
<table class="table  table-hover text-center"  style="width:40%;">
	<thead>
	<tr class="info" >
		
			<th style="text-align:center;">
				<strong>STT</strong>
			</th>
			<th style="text-align: left;padding-left: 100px;">
				<strong>HỌ TÊN</strong>
			</th>
			<th style="text-align: left;padding-left: 100px;">
				<strong>TÀI KHOẢN</strong>
			</th>
			<th>
			</th>	
			
	</tr>
	</thead>
	<?php
				$stt=1; 
			foreach ($list_user as $value) { ?>
	<tr  >
		<td>
			<?php echo $stt; ?>
		</td>	
		<td style="text-align: left;padding-left: 100px;">
			<?php	echo $value['hoten']; ?>   
		</td>	
		<td style="text-align: left;padding-left: 100px;">
			
			<?php	echo $value['username']; ?>    

		</td>
		<td>
				<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_user&name=<?php echo $value['username'];?>">
				 <i class="bi bi-x-circle-fill"></i>
			</a>	
		</td>	
	</tr>
	   <?php $stt++; }?>
</table>

					








</div>						

