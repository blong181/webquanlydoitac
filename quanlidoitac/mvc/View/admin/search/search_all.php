<div class="search_all">
	<div class="col-xs-12 text-center">
	<br>

	<h3> KẾT QUẢ TÌM KIẾM 
		<br><h4>( <?php echo $str ?> )</h4>
	</h3>

	<br>
	</div>
	<table class="table  table-hover table-bordered text-center"  style="width:60%;" >
		<thead>
		<tr class="info">
			<th style="text-align:center;border-right: none;">
				ĐỐI TÁC
			</th>			
			<th style="text-align:center; border-left: none;border-right: none;"> 
			HOẠT ĐỘNG 
			</th>
			<th style="text-align:center; border-left: none;">
			LĨNH VỰC	
			</th>	

		</tr>
		</thead>
		<?php 
			if (empty($data))
			{
		?>
			<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4> 
		<?php 
			}
			else{
		?>
		<?php
				foreach($data as $value){ ?>
				
			<tr style="border-bottom:0.5px solid lightgrey;" >
				<td style="text-align: left;padding-left: 20px;">
				<a href="index.php?controller=admin&action=detail&id=<?php echo $value['id_doitac']; ?>&category=<?php echo'default'?>">	
					<?php echo $value['ten_doitac'];?>	
				</a>	
				</td>	
				<td style="text-align: left;padding-left: 20px;">
				<a href="index.php?controller=admin&action=dtl_srch_act&id=<?php echo $value['id_doitac']; ?>
				&id_hd=<?php echo $value['id_hd']; ?>">	
					<?php echo $value['td_hoptac']; ?>
					(<?php 
					$timestamp = strtotime($value ['thoigian']);
					echo date('d/m/Y', $timestamp);?>)				
				</td>
				<td width="20%" align="left" style="padding-left: 20px;">
					<?php echo $value ['ten_linhvuc']; ?>
				</td>	
			</tr>
				
			
	<?php	}//foreach
			}//eles
	 ?> 
	</table>
</div>