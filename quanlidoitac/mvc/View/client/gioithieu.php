<div class="gioithieu">
	<table align= "center" class="table table borderless" style="width:1200px ;">
		<?php 
		$stt=0;
		foreach ($data as $value) 
		{	
			// mục 0
			if($value['stt_tieude']=='0')
			{

		?>		
		<tr >
			<!-- rỗng -->
			<td>
			</td>	
			<td style="width: 50%;white-space: initial;text-align: center;">	
				<h3> <?php echo $value['gt_tieude'] ?></h3>
			</td>
			<!-- rỗng -->
			<td>
			</td>
		</tr>
		<?php 
			}
			else
			{
				
		?>
		<tr>
			<td style="padding-left:50px" colspan="3">
				<h3 > <?php echo $stt.'. '.$value['gt_tieude'];?></h3>
			</td>
		</tr>
		<tr>
			<td style="padding-left:50px" colspan="3">
				<h4 style=" margin: 3pt 3pt; padding-bottom: 3pt; text-align: justify;" >
					<?php echo nl2br($value['gt_noidung']);?>		
				</h4>	
			</td>
		</tr>
		<tr>
			<td align="center"  colspan="3">
	<?php 	
			}
			if(!empty($data_anh))
			{
				foreach($data_anh as $value_anh)
				{
					if($value_anh['img']!=NULL) 
					{ 
						if($value_anh['stt_tieude']==$value['stt_tieude'])
						{
			
						$path='../mvc/View/uploads/gioithieu/'.$value_anh['img'];
							
						$path = str_replace(chr(0), '', $path);								
	?>

						<br>
						<img src="<?php echo $path; ?>" width="623" height="469">
						<br>
						<?php if(!empty($value_anh['noi_dung'])) echo $value_anh['noi_dung']; ?>
						<br>
						<br> 
					<?php 
						}
					} 
										
				}
			}
			
		$stt++;		
		}
			
	?>
			</td>
		</tr>


	</table>
	
</div>
