<div class="search_obj">
	<div class="col-xs-12 text-center">
		<br>
		<h3> KẾT QUẢ TÌM KIẾM 
			<br><h4>( <?php echo $str ?> )</h4>
		</h3>
		<br>
	</div>

	<table class="table table-hover  text-center"  style="width:60%;" >
		<thead>	
		<tr class="info" style="border-top:  1px solid lightgrey;">
			
			<th style="text-align:center;border-left: 1px solid lightgrey;padding-right:50px ;">
				STT
			</th>	
			<th style="text-align:center;border-right:  1px solid lightgrey;">
				TÊN ĐỐI TÁC
			</th>
		
		</tr>
		</thead>	
			<?php

				$stt=1;
					if(empty($data))
					{
			?>			
						<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4> 
			<?php	
					} 
					else{
					foreach ($data as $value) {
			?>	
			<tr  style="border-bottom:0.5px solid lightgrey;border-left:  1px solid lightgrey;border-right:  1px solid lightgrey;">
				<td style="padding-right:50px ;" ><?php echo $stt ?> </td>
				<td style="padding-left:100px ;text-align: left;width: 80%"><a href="index.php?controller=client&action=detail&id=<?php echo $value['id_doitac']; ?>&category=default">
						<?php echo $value['ten_doitac'] ?></a>
				</td>

			</tr>


			<?php
				$stt++;
			}}
	
			?>
		</table>
</div>	

