<div class="dsdoitac" >
	<table class="table  table-hover text-center"  style="width:60%;"> 
	<thead>	
	<tr >
		<td colspan="3" >

		<?php 
			if($_GET['action']=='sort')
			{
				foreach($data_lv_all as $value)
				{
					if($value['id_linhvuc']==$_GET['id_catg'])
					{
						$name_lv=$value['ten_linhvuc'];
						break;
					}
				}

			}

		?>	


			<h3> DANH SÁCH HỢP TÁC 
		<?php if(!empty($name_lv)) 
				{
		?>		 		
			<h4>( <?php  echo $name_lv ?> )</h4>
		<?php 
				} 
		?>			
			</h3> 
			<br>
		</td>
	</tr>
	

	<tr class="info">
		<th style="text-align:center;width:20%;border-left: 1px solid lightgrey;">
			<strong>STT </strong> 
		</th>
		<th   style="text-align:center;width:60%;">
			<strong>ĐỐI TÁC</strong>  
		</th>
		<th style="text-align:left;width:20%;border-right: 1px solid lightgrey;padding-left: 50px;">
			<strong>HỢP TÁC</strong> 
		</th>

	</tr>
	
	</thead>
	<tbody>	
		<?php

			$stt=1;
				if(empty($data))
				{
		?>			
					<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4> 
					
		<?php	
				} 
				else{
					foreach ($data as $value) 
						{
		?>	

			<tr  style="border-bottom:0.5px solid lightgrey;">
				<td style="vertical-align:middle;border-left: 1px solid lightgrey;" ><?php echo $stt ?> </td>
				<td style="vertical-align:middle;text-align: left;width:60%;">
					<a href="index.php?controller=client&action=detail&id=<?php echo $value['id_doitac']; ?>&category=default">
						<?php echo $value['ten_doitac'] ?>		
					</a>
				</td>
				<td style="text-align:left;border-right: 1px solid lightgrey;"> 
		<?php		
				if(isset($value['id_doitac']))
				{
					// lấy danh sách lĩnh vực của 1 đối tác
					$data_lv=$db->getAlldataLinhvucId('doitac','hoptac','chitiet_linhvuc',$value['id_doitac']);
				}
				if(!empty($data_lv))
				{
					foreach($data_lv as $value)
					{
		?>			
					 <?php echo "- ".$value['ten_linhvuc']."<br>"; ?> 
		<?php
					} //foreach
				}//if
		?>	

				</td>

			</tr>


		<?php
			$stt++;
						}//foreach ($data as $value) {
					}//else{

		
		?>

	</tbody>


	</table>	
</div>			

