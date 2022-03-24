<?php

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'introduce';
}

switch (($action)) {

	case 'list': {
			$tble = "doitac";
			$data = $db->getAlldata($tble);


			require_once('View/client/list_doitac.php');
			break;
		}
	case 'sort': {
			$tble = "doitac";
			$id_linhvuc = $_GET['id_catg'];
			$data = $db->getAlldataIdLv($tble, $id_linhvuc);


			$data_lv_all = $db->getAlldata("chitiet_linhvuc");

			require_once('View/client/list_doitac.php');
			break;
		}
	case 'login': {

			if (isset($_POST['submit'])) {
				$u = $_POST['username'];
				$p = $_POST['password'];
				$p = md5($p);
				$db = $db->connect();
				$sql = "select * from admin where username='$u' and password='$p' ";
				$rs = mysqli_query($db, $sql);
				$row_login = mysqli_fetch_array($rs);
				if (mysqli_num_rows($rs) > 0) {

					session_start();
					$_SESSION['submit'] = $row_login['hoten'];
					// chuyển hướng đến trang admin
					header('location: index.php?controller=admin&action=list');
					

				} else {
			    echo '<script language="javascript">';
			    echo 'alert("sai mật khẩu")';
			    echo '</script>';
				}
			}

			require_once('View/client/login.php');
			break;
		}


	case 'detail': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$tble = 'doitac';

				$data_doitac = $db->getAlldataId($tble, $id);

				// in ra linh vuc
				$tble_3 = 'chitiet_linhvuc';
				$tble_2 = 'hoptac';

				$data_lv = $db->getAlldataLinhvucId($tble, $tble_2, $tble_3, $id);
			}

			// mặc định default 
			$nhap = $_GET['category'];

			// gan phan tu dau tien mac định 
			if ($nhap == 'default' && !empty($data_lv)) {
				foreach ($data_lv as $value) {
					$_GET['category'] = $value['id_linhvuc'];
					break;
				}
			}

			//lay data hoat dong
			$id = $_GET['id'];
			$linhvuc = $_GET['category'];
			$data_hd = $db->getAlldataHd($id, $linhvuc);



			require_once('View/client/tt_chitiet.php');

			break;
		}
	case 'search': {
			$key = $_GET['key'];
			$catg = $_GET['name'];

			if (isset($key)) {

				$data = $db->Search($key, $catg);
			}
			switch ($catg) {
				case 'search_all': {
						$str='TẤT CẢ';
						require_once ('View/client/search/search_all.php');
						break;
					}
				case 'search_catg': {
						// dùng chung
						$str='LĨNH VỰC';					
						require_once ('View/client/search/search_all.php');
						break;
					}					
				case 'search_obj': {
						$str='ĐỐI TÁC';
						require_once('View/client/search/search_doitac.php');

						break;
					}
				case 'search_act': {

						$str='HOẠT ĐỘNG';
						require_once('View/client/search/search_hoatdong.php');
						break;
					}
			}
			break;
		}


	case 'dtl_srch_act': {

			$id = $_GET['id'];
			$tble = 'doitac';
			$id_hd = $_GET['id_hd'];
			//lấy dữ liệu ảnh
			$data_anh=$db->getDataAnh($id_hd ,'hoatdong');
			//lấy dữ liệu đối tác
			$data_doitac = $db->getAlldataId($tble, $id);
			

			if (isset($id_hd)) {

				$data = $db->getAlldataIdHd('chitiet_hoptac', $id_hd);
				require_once('View/client/search/chitiet_timkiem_hd.php');
			}

			break;
		}


	case 'introduce': {
			$data = $db->getAlldataGT();
			$data_anh = $db->getAllDataAnhGT();
			require_once('View/client/gioithieu.php');
			break;
		}
	case 'contact': {
			$data = $db->getAlldataLH();
			require_once('View/client/lienhe.php');
			break;
		}
}
