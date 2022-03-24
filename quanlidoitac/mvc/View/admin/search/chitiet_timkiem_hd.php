<div class="search_act">
<div class="col-xs-12 text-center">
	<?php
	foreach ($data_doitac as $value) {
	?>	
	<h3> ĐƠN VỊ HỢP TÁC: <?php echo $value ['ten_doitac']?></h3>
	<br>
	<h4><br></h4>
	</div>		
	<table class="table table borderless text-center" style="width:1200px;">
		<tr>
			<td style="width: 60%;">
				<p>
					<h4>
					<ul type ="circle" align="left">
					<li> <strong> Giới thiệu:<br> </strong>
						<h4  style=" margin: 3pt 3pt; padding-bottom: 3pt; text-align: justify;">
						<?php echo nl2br($value ['gioithieu'])?>
						</h4>
					</li>
					</ul>
					</h4>
				</p>
			</td>		
			<td>	
				<p>
					<h4 >
					<ul type ="circle" align="left">
					<li> <strong> Gmail: </strong>  <?php echo $value ['email']?></li>
					<li> <strong>Số điện thoại: </strong>  <?php echo $value ['sdt']?> </li>
					<li> <strong>Địa chỉ: </strong>  <?php echo $value ['diachi']?> </li>
					<li> <strong>Website: </strong>
						<a href="<?php echo $value['website']; ?>" target="_blank">
					 		<?php echo $value['website'] ?>
						</a>
					</li>					
					</ul>
					</h4>		
				</p>						
			</td>	
		</tr>					
	<?php

		} 	

	?>
	</table>
	<h4> <br> </h4>
		
	<table class="table  table-bordered text-center"  style="width:1000px" >

	<?php 
	foreach($data as $value){ ?>
		
		<tr class="active">
			<td>
				<strong>
				<?php echo $value['td_hoptac']; ?> 
				(<?php 
				$timestamp = strtotime($value ['thoigian']);
				echo date('d/m/Y', $timestamp);
				?>)
				</strong>				
			</td>		
		</tr>	
		<tr>							
			<td >							
				PHỤ TRÁCH :	<?php echo $value ['phutrach']?>   							
			</td> 				
		</tr>		
		<tr style="border-bottom:none;" >
			<td align="left" style="border-bottom: none;">
				<br>			
				<p style="margin-left: 100px;"><?php echo nl2br($value ['nd_hoptac'])?>
				</p>  
				<br>
				<p style="margin-left: 100px;"> 
				<?php 
						if($data_anh!=0)
						{
							foreach($data_anh as $value_anh)
							{
								if($value_anh['img']!=NULL) 
								{

									if(strpos($value_anh['img'], '.pdf')) 
									{
										$path='../mvc/View/uploads/doitac/pdf/'.$value_anh['img'];
										$path = str_replace(chr(0), '', $path);												 
				?>							
										<?php 
										if($value_anh['noi_dung']!=NULL)
										{
										// in ra tieu def anh 
											echo $value_anh['noi_dung'].":";
										}	
										?>
										&nbsp;
										<a href="<?php echo $path ?>" target="_blank"><?php echo $value_anh['img'];?></a>
																					
				<br>
												
				<?php 					
									}
								}
							}
				?>
				</p>
				</td>
			</tr>
			<tr >
				<td style="border-top: none;">
				<br>	
				<?php
							foreach($data_anh as $value_anh)
							{
								if($value_anh['img']!=NULL) 
								{

									if(strpos($value_anh['img'], '.pdf')==false)  
									{ 
										$path='../mvc/View/uploads/doitac/pic/'.$value_anh['img'];
										$path = str_replace(chr(0), '', $path);												
				?>

										<img src="<?php echo $path ?>" width="400">

									<br>
									<br>

									<?php if($value_anh['noi_dung']!='NULL')
									// in ra tieu def anh 
										echo $value_anh['noi_dung']
									?>
									<br>
									<br>
									<br>

				<?php 
									}

					 			} 
					 		} 
					 	}
				?>						

			</td>
		</tr>			
		
				<?php	} ?> 
	</table>
</div>	
