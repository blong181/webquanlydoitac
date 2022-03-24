<div class="search_obj">
	<div class="col-xs-12 text-center">
		<br>
		<h3> KẾT QUẢ TÌM KIẾM 
			<br><h4>( <?php echo $str ?> )</h4>
		</h3>
		<br>
	</div>
	<table class="table  table-hover text-center"  style="width:60%;">
		<thead>
		<tr class="info" style="border-top: 1px solid lightgrey;border-right:1px solid lightgrey;border-left:1px solid lightgrey;">
			
			<th style="text-align:center;padding-right:50px ;"><strong>
				STT
				</strong>
			</th>
			<th style="text-align:center;padding-right:150px ;">
				<strong>
					TÊN ĐỐI TÁC
				</strong>
			</th>	
			<th></th>
			
		</tr>
		</thead>
		<?php
			$stt=1; 
				if(empty($data)){
		?>			
					
					<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4> 
		<?php
				}
				else
				{
					foreach ($data as $value) 
					{
		?>	
			<tr style="border-bottom:0.5px solid lightgrey;" >
				<td style="border-left:1px solid lightgrey;padding-right:50px ;"><?php echo $stt ?> </td>
				<td style="text-align: left;width: 60%;">
					<a href="index.php?controller=admin&action=detail&id=<?php echo $value['id_doitac']; ?>&category=<?php echo'default'?>">
						<?php echo $value['ten_doitac'] ?>
							
					</a>
				</td>
				<td style="text-align:left ;border-right: 1px solid lightgrey;width: 10%;">
					<a  onclick='return confirm("bạn muốn xóa ?")'href="index.php?controller=admin&action=delete&id=<?php echo $value['id_doitac']; ?>"><i class="bi bi-x-circle-fill"></i>
					</a>
				</td>
			</tr>


		<?php
			$stt++;
				}//foreach ($data as $value) 
			}//else

		
		?>
	</table>
</div>	

