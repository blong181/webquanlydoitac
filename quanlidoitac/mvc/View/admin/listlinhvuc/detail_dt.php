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
<?php 	

//them lĩnh vục
	// ĐỐI VỚI TRANG THÔNG TIN CHI TIẾT  
	if(isset($_GET['id'])){
		if(isset($_POST['themlinhvuc_doitac'])){

			if(isset($_POST['name']))
			{
				$ten_linhvuc = $_POST['name'];
			
				#$db->Insertdata_ctLinhvuc($ten_linhvuc,0);
				# láy id linh vuc theo ten
				$id_linhvuc=$db->getIdlv($ten_linhvuc);
				
				foreach($id_linhvuc as $value){
					$id_lv=$value['id_linhvuc'];
					break;
				}	
				
				if(!$db->Insertdata_hoptac($_GET['id'],$id_lv)){
					
				
					echo '<script language="javascript">';
					echo 'alert("lĩnh vực đã tồn tại")';
					echo '</script>';
				}
				//tu load lai trang

				echo "<meta http-equiv='refresh' content='0'>"; 
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("chọn lại")';
				echo '</script>';	
						
			}				
		}				

	}	

 ?>		

<?php 
	if(isset($_GET['action'])){

			$action=$_GET['action'];
	}
	else{
		$action = 'detail';
	}

		$tble_2 = "chitiet_linhvuc";
		$data_2=$db->getAlldata($tble_2);	
?>

<div class="dslinhvuc_detail" >
	<table class="table table-bordered text-center"  style=" width:90%;"> 
	<tbody>	
		<tr style="border-bottom:1px solid lightgrey;" class="info">
			<td align="center" style="vertical-align:middle;padding-right: 50px;" width="60%">
				<h4 align="center"> LĨNH VỰC  </h4>
			</td>	
		<form  class="navbar-form navbar-right" action="" method="POST">
 			<td style="width: 60%;" >	
				<select  class="form-control" name="name">
			        <option value="" disabled selected>thêm mới</option>
			      <?php
			         foreach($data_2 as $value){
			        ?>
			      <option value="<?php echo $value['ten_linhvuc']; ?>">
			      	<?php echo $value['ten_linhvuc']; ?>
			      </option>
			      <?php }?>
			    </select>
				
			</td>
			<td align="left">
				<input class="btn btn-default" type="submit" name="themlinhvuc_doitac" value="thêm">
			</td>	
		</form>	
		</tr>
		<tr >
			<td colspan="3">
				<div style="overflow-y:scroll; height:100px;">
					<table class="table table borderless  table-hover text-center" >	
					
						<?php
								// lĩnh vực rỗng
								if(empty($data)){
									echo 'không có dữ liệu';
								}
								else{
								foreach ($data as $value) {
						?>	
						<tr style="border-bottom:1px solid lightgrey;border-top:1px solid lightgrey; ">
							<td align="left" style='border-right:none;width: 50%;' >
								<a href="index.php?controller=admin&action=<?php echo $action; ?>&id=<?php echo $_GET['id'];?>&category=<?php echo $value['id_linhvuc'];?> "> 
									<?php echo $value['ten_linhvuc'] ?> 
								</a>
							</td>
							<td style='border-left:none;'>
								 <a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_catg&id=<?php echo $_GET['id'];?>&id_catg=<?php echo $value['id_linhvuc'];?>">
								 	<i class="bi bi-x-circle-fill"></i>
								 </a>
							</td>
						</tr>
						<?php						
						}}
						?>
					</table>
				</div>
			</td>
		</tr>	
	</tbody>
	</table>
</div>
	
