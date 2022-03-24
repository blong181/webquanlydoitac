<div class="dsdoitac">

	<table class="table  table-hover text-center" style="width:60%;">

		<?php
		if ($_GET['action'] == 'sort') {
			foreach ($data_lv_all as $value) {
				if ($value['id_linhvuc'] == $_GET['id_catg']) {
					$name_lv = $value['ten_linhvuc'];
					break;
				}
			}
		}

		?>
		<thead>
			<tr>
				<td colspan="3">
					<h3> DANH SÁCH HỢP TÁC

						<?php if (!empty($name_lv)) {
						?>
							<h4>( <?php echo $name_lv ?> )</h4>
						<?php
						}
						?>

					</h3>
					<br>
				</td>

			</tr>

			<tr class="info" style="border-left: 1px solid lightgrey;border-right:  1px solid lightgrey;">
				<th style="text-align:center;padding-right:50px ;">
					<strong> STT </strong>
				</th>
				<th style="text-align:center;padding-right:150px ;">
					<strong>TÊN ĐỐI TÁC</strong> 
				</th>
				<th style="text-align:center;"></th>

			</tr>
		</thead>
		<tbody>
			<?php
			$stt = 1;
			if (empty($data)) {
			?>
				<h4 align="center"> <?php echo ' không có dữ liệu '; ?> </h4>

				<?php
			} else {
				foreach ($data as $value) {
				?>
					<tr style="border-bottom:1px solid lightgrey;border-left:  1px solid lightgrey;border-right:  1px solid lightgrey;">
						<td style="padding-right:50px ;">
							<?php echo $stt ?> 
						</td>
						<td style="padding-right:150px ;text-align: left;width: 60%;">
							<a href="index.php?controller=admin&action=detail&id=<?php echo $value['id_doitac']; ?>&category=<?php echo 'default' ?>">
								<?php echo $value['ten_doitac'] ?>

							</a>
						</td>
						<td style="text-align:left ;width: 10%;">
							<a onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=delete&id=<?php echo $value['id_doitac']; ?>"><i class="bi bi-x-circle-fill"></i>
							</a>
						</td>
					</tr>


			<?php
					$stt++;
				} //foreach ($data as $value) {
			} //elese


			?>

		</tbody>
	</table>
</div>