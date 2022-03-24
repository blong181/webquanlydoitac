<div class="suagioithieu">

	<div class="col-xs-12 text-center">
		<h3> CHỈNH SỬA GIỚI THIỆU </h3>
		<br>
	</div>

	<form action="" method="POST" enctype="multipart/form-data">
		<div class="wrapper">
			<div class="input-box">
				<table align="center" width="700px">
					<tr >
						<td align="right">
							<h4>số lượng mục :&nbsp;</h4>
						</td>
						<td width="50px">
							<input class="form-control" type="text" name="soluong">
						</td>
						<td align="right">
							vị trí :&nbsp;
						</td>	
						<td>
							<select  class="form-control" name="position">

						      <?php
						         foreach($data_gt as $value){
						        ?>
						      <option value="<?php echo $value['stt_tieude']; ?>">
						      	<?php
						      		if($value['stt_tieude']==0)
						      		{
						      			echo 'vị trí đầu tiên';
						      		}
						      		else
						      		{	
								       echo 'sau mục '.$value['stt_tieude'];
								    }   
						      	?>
						      </option>
						      <?php }?>
						    </select>							
						</td>
						<td >
							&nbsp;
							<input type="submit" class="btn btn-default" name="themsoluongmuc" value="them moi">
						</td>
					</tr>
				</table>
				<table class="table  table borderless text-center" style="width:1200px ;">
					<?php
					$stt = 0;
					foreach ($data_gt as $value) {
						if ($stt == '0') {
					?>
							<!-- mặc định là id td đầu tiên -->
							<tr>
								<td align="left" style="vertical-align:middle"> <strong>TIÊU ĐỀ:</strong> </td>

							</tr>
							<tr>
								<td><input style="font-size: 20px;" class="form-control" type="text" name="nd0" placeholder="nhap ten doi tac" value="<?php echo $value['gt_tieude'] ?>">
								</td>
							</tr>
						<?php
						}
						?>
						<?php

						if ($value['stt_tieude'] != '0') {

						?>
							<tr>
								<td align="left" style="vertical-align:middle">
									<strong>MỤC&nbsp;<?php echo $stt; ?> :</strong>
									<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_intro&id=<?php echo $stt; ?>">
										<i class="bi bi-x-circle-fill"></i></i>
									</a>
								</td>

							</tr>
							<tr>
								<td><input style="font-size: 20px;" class="form-control" type="text" name="td<?php echo $stt; ?>" placeholder="nhap tieu de" value="<?php echo $value['gt_tieude'] ?>">
								</td>
							</tr>
							<tr>
								<td align="left" style="vertical-align:middle"><strong>NỘI DUNG: </strong></td>

							</tr>
							<tr>
								<td colspan="2">
									<textarea style=" font-size: 20px;resize: none;" rows="6" cols="5" class="form-control" type="text" name="nd<?php echo $stt; ?>" placeholder="nhap noi dung"><?php echo ($value['gt_noidung']); ?>
									</textarea>
								</td>
							</tr>
							<tr>
								<td align="left" style="vertical-align:bottom;">
									<input type="file" name="hinhanhgt<?php echo $stt; ?>[]" multiple="multiple">

								</td>
							</tr>
							<tr>
								<?php
								// lấy dữ liệu ảnh của các mục giới thiệu
								$data_anh = $db->getDataAnhGT($stt);
								?>
								<td colspan="4" align="center">
									<div style="overflow-y:scroll; height:
									<?php if ($data_anh == 0) echo 0;else echo '350px'; ?>;">

										<table class="table table-bordered" align="center" style="width:60%;">
											<?php
											if ($data_anh != 0) {
												$stt_anh = 1;

												foreach ($data_anh as $value_anh) {

											?>
											<tr style="border-bottom:0.5px solid lightgrey;" align="center">
												<td>

												<?php
												if ($value_anh['img'] != NULL) 
												{


													$path = '../mvc/View/uploads/gioithieu/' . $value_anh['img'];

													$path = str_replace(chr(0), '', $path);
												?>
													<br>


													<img src="<?php echo $path ?>" width="400">

													&nbsp;
													&nbsp;
													<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_img_intr&id=<?php echo $value['stt_tieude']; ?>&name_img=<?php echo $value_anh['img'] ?> ">
														<i class="bi bi-x-circle-fill"></i>
													</a>
													<br>
													<br>


													nội dung:


													<input type="text" name="noidung_anh<?php echo $stt; ?>[<?php echo $stt_anh; ?>][nd]" value="<?php echo $value_anh['noi_dung']; ?>">
													<input type="hidden" name="noidung_anh<?php echo $stt; ?>[<?php echo $stt_anh; ?>][img]" value="<?php echo $value_anh['img']; ?>">
													<input type="hidden" name="noidung_anh<?php echo $stt; ?>[<?php echo $stt_anh; ?>][stt_tieude]" value="<?php echo $value_anh['stt_tieude']; ?>">

													<br>
													<br>

												<?php
													$stt_anh++;
												}
												?>
												</td>
											</tr>

											<?php
												}
											} 
											?>
										</table>
									</div>
								</td>
							</tr>

					<?php

						}
						$stt++;
					}

					?>
					<tr>
						<td colspan="2">
							<input type="submit" class="btn btn-default" name="capnhatgioithieu" value="cập nhật">
						</td>
					</tr>
				</table>
			</div>
		</div>

	</form>
</div>