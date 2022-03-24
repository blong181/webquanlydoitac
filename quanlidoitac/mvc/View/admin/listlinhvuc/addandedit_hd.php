<?php
// lấy dữ liệu lĩnh vực tùy theo trang 
	$tble = "chitiet_linhvuc";
	$tble_2="hoptac";
	if(isset($_GET['id'])){
		$data=$db->getAlldataLinhvucId('doitac','hoptac','chitiet_linhvuc',$_GET['id']);
	
}
	else{
		$tble = "chitiet_linhvuc";
		$data=$db->getAlldata($tble);

	}	

?>
<style type="text/css">
	.borderless tr td {
    border: none !important;
    
}
</style>
<table  class='table table borderless  text-center'>		
	<div class="btn-group">	
		<tr>
			<td width="20%" align="right">	
			</td>
			<td width="30%" align="left">
				<div class="nav navbar-nav navbar-left">
					<select  class="form-control" name="name"  onchange="location = this.value;">
				        <option value="" disabled selected>Choose option</option>
				      <?php
				         foreach($data as $value){

				        ?>
				      <option value="index.php?controller=admin&action=<?php echo $_GET['action']; ?>&id=<?php echo $_GET['id'];?>&category=<?php echo $value['id_linhvuc']?>">
				      	<?php echo $value['ten_linhvuc']; ?></option>
				      <?php }?>
				   </select> 
				</div>   
			</td>
		</tr>
	</div>
</table>
	