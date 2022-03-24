<div class="search_act">	
	<div class="col-xs-12 text-center">
		<br>
		<h3> KẾT QUẢ TÌM KIẾM 
			<br><h4>( <?php echo $str ?> )</h4>
		</h3>
		<br>
	</div>
	<table class="table table-bordered table-hover  text-center"  style="width:60%;" >
	<thead>
		<tr class="info">
			<th style="text-align:center;border-right: none;">
				ĐỐI TÁC
			</th>			
			<th style="text-align:center; border-left: none;"> 
			HOẠT ĐỘNG 
			</th>	
		</tr>
	</thead>	
		<?php 
		if (empty($data)){
		?>	
			<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4> 
		<?php
		}
		else
		{
			foreach($data as $value)
			{      
				#chỉ hiện những hoạt động đc hiện 
				if($value['trangthai']==1)
				{

		?>
			
			<tr>
				<td style="text-align: left;padding-left: 20px;">
					<a href="index.php?controller=client&action=detail&id=<?php echo $value['id_doitac']; ?>&category=<?php echo'default'?>">
						<?php echo $value['ten_doitac'];?>	
					</a>
				</td>			
				<td style="text-align: left;padding-left: 20px;">
				<a href="index.php?controller=client&action=dtl_srch_act&id=<?php echo $value['id_doitac']; ?>&id_hd=<?php echo $value['id_hd']; ?>">	
					<?php echo $value['td_hoptac']; ?> 
					(<?php 
					$timestamp = strtotime($value ['thoigian']);
					echo date('d/m/Y', $timestamp);?>)				
				</td>
			</tr>
				
			
		<?php	}//if
			}//foreach
		}//else 

		?> 
	</table>
</div>	