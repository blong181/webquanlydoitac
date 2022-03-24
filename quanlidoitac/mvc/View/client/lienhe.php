<div class="lienhe">
<br>
<h3  align="center">THÔNG TIN LIÊN HỆ </h3>
<br>
	<table class="table  table-striped table-bordered text-center"  style="width:60%;" cellpadding="5">
		<?php 
		foreach($data as $value){
		?>	
		<tr>
			<td align="left" style="padding-left: 20px;" width="50%">
				  <?php echo $value['lh_ten']; ?>
			</td>
			<td    align="left" style="padding-left: 20px;" width="25%">
				<u>
					<?php echo $value['lh_gmail']; ?>
				</u>
			</td>
			<td align="left" style="padding-left: 20px;" width="25%">
				<?php echo $value['lh_sdt']; ?>
			</td>	
		</tr>
		<?php } ?>		
	</table>
	
</div>
