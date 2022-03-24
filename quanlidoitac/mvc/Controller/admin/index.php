<?php
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'list';
}

$thanhcong_act = array();

switch (($action)) {
	// thêm đối tác
	case 'add_obj': {
			if (isset($_POST['themdoitac'])) {

				$ten_doitac = $_POST['tendoitac'];
				$email = $_POST['email'];
				$sdt = $_POST['sdt'];
				$diachi = $_POST['diachi'];
				$website = $_POST['website'];
				$gioithieu = $_POST['gioithieu'];
				// gán id
				$id_doitac = $db->SetIdName();
				//them linh vuc hop tac theo id doi tac
				if ($db->Insertdata_doitac($id_doitac, $ten_doitac, $email, $sdt, $diachi,$website, $gioithieu)) {
					// chuyển đến trang thông tin chi tiết đối tác
					$path =	'location: index.php?controller=admin&action=detail&id=' . $id_doitac . '&category=default';
					header($path);
				}
			}

			require_once ('View/admin/add_doitac.php');

			break;
		}
	// thêm tài khoản quản lý	
	case 'add_user': {

			if (isset($_POST['add_user'])) {

				$ten_user = $_POST['user_name'];
				$acc_user = $_POST['account'];
				$pass = $_POST['pass'];
				$password = md5($pass);
				//them linh vuc hop tac theo id doi tac
				if($db->Insertdata_user($ten_user, $acc_user, $password))
				{
				    echo '<script language="javascript">';
				    echo 'alert("thêm thành công")';
				    echo '</script>';
			    }				
			}

			require_once ('View/admin/user/add_user.php');

			break;
		}
	// xóa tài khoản quản lý	
	case 'del_user': {

			$list_user = $db->getAlldata('admin');
			if (isset($_GET['name'])) {
				$name = $_GET['name'];

				if ($db->Del_user($name))
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}


			require_once ('View/admin/user/del_user.php');

			break;
		}

	// them hoat dong cua doi tac
	case 'add_act': {
			$id_doitac = $_GET['id'];

			// lay id linh vuc theo id doi tac

			// lay ten linh vuc theo id linh vuc
			$data_lv = $db->getNamelv($id_doitac);
			foreach ($data_lv as $value) {
				$get_namelv[$value['id_linhvuc']] = $value['ten_linhvuc'];
			}
			// them hoat dong
			if (isset($_POST['themhoatdong'])) {

				$tdhd = $_POST['tdhd'];
				$phutrach = $_POST['phutrach'];
				$tg = $_POST['tg'];
				$noidung = $_POST['noidung'];
				if ($_GET['category'] == 'default') {
					foreach ($data_lv as $value) {
						$_GET['category'] = $value['id_linhvuc'];
						break;
					}
				}

				//
				$id_linhvuc = $_GET['category'];
				//				
				// nhap hinh anh					
				if (isset($_FILES['hinhanh'])) {
					$file = $_FILES['hinhanh'];
					$file_name = $file['name'];
					$title = ''; //mặc dịnh tiêu đề là null
					foreach ($file_name as $key => $value) {
						// nếu file pdf lưu vào file pdf
						if (strpos($value, '.pdf')){
							move_uploaded_file($file['tmp_name'][$key], 'View/uploads/doitac/pdf/' . $value);
						}
						else{
							move_uploaded_file($file['tmp_name'][$key], 'View/uploads/doitac/pic/' . $value);
						}	
					}
				}

				if (!empty($_FILES['hinhanh']['name'][0])) {

					$db->Insertdata_cthoptac($id_doitac, $id_linhvuc, $tg, $phutrach, $tdhd, $noidung, 0, $file_name, $title);

				} 
				else 
				{
					$db->Insertdata_cthoptac($id_doitac, $id_linhvuc, $tg, $phutrach, $tdhd, $noidung, 0, 'NULL', $title);
				}
			    echo '<script language="javascript">';
			    echo 'alert("thêm thành công")';
			    echo '</script>';				

			}
			require_once ('View/admin/add_hoatdong.php');
			break;
		}
	//xóa toàn bộ hoạt động theo lĩnh vực
	case 'del_catg': {
			$id_linhvuc = $_GET['id_catg'];
			// xóa lĩnh vực của 1 đối tác
			if (isset($_GET['id'])) {
				// lấy tất cả ảnh của 1 đối tác
				$data_anh=$db->getDataAnh($_GET['id'],'doitac');
				foreach($data_anh as $value)
				{	// chọn ra theo lĩnh vực
					if($value['id_linhvuc']==$id_linhvuc)
					{
						// nếu là file pdf
						if (strpos($value['img'], '.pdf'))
						{
							if (file_exists("View/uploads/doitac/pdf/" .  $value['img'])) 
							{
								// xóa trong thư mục
								unlink("View/uploads/doitac/pdf/" . $value['img']);
								// xóa trong cơ sở dữ liệu theo id hd
								$db->Delimg($value['id_hd'], $value['img'],'hoatdong');
							}
						}
						else
						{
							if (file_exists("View/uploads/doitac/pic/" .  $value['img'])) 
							{
								// xóa trong thư mục
								unlink("View/uploads/doitac/pic/" . $value['img']);
								// xóa trong cơ sở dữ liệu theo id hd
								$db->Delimg($value['id_hd'], $value['img'],'hoatdong');
							}							
						}
					}			
				}						
				// xóa toàn bộ hoạt động trong 1 lĩnh vực của 1 đối tác
				if ($db->DelLV_obj($id_linhvuc, $_GET['id'])) 
				{	//khi xóa xong sẽ load lại lĩnh vực mặc định là lĩnh vực đầu tiên trong mảng
					$path =	'location: index.php?controller=admin&action=detail&id=' . $_GET['id'] . '&category=default';
					header($path);
					exit;
				}
			}
			// xóa lĩnh vực của khoa 
			// xóa tất cả các hoạt động đối tác liên quan đến lĩnh vực
			else {
				// xóa ảnh tất cả đối tác liên quan đến lĩnh vực
				$data_anh=$db->getDataAnh($id_linhvuc,'linhvuc');
				foreach($data_anh as $value)
				{
					if (strpos($value['img'], '.pdf'))
					{
						if (file_exists("View/uploads/doitac/pdf/" .  $value['img'])) 
						{
							// xóa trong thư mục
							unlink("View/uploads/doitac/pdf/" . $value['img']);
							// xóa trong cơ sở dữ liệu
							$db->Delimg($id_linhvuc, $value['img'],'linhvuc');
						}
					}
					else
					{
						if (file_exists("View/uploads/doitac/pic/" .  $value['img'])) 
						{
							// xóa trong thư mục
							unlink("View/uploads/doitac/pic/" . $value['img']);
							// xóa trong cơ sở dữ liệu
							$db->Delimg($id_linhvuc, $value['img'],'linhvuc');
						}
					}			
				}					
				// xóa tất cả các hoạt động đối tác liên quan đến lĩnh vực
				if ($db->DelLV($id_linhvuc)) 
				{
					// nếu đang ở trang tt chi tiết đối tác
					if(strpos($_SERVER['HTTP_REFERER'],$id_linhvuc))
					{	// đổi url thành default
						$path =	str_replace($id_linhvuc,'default',$_SERVER['HTTP_REFERER']);
						header('Location: '.$path);
						exit;
					}
					else
					{					
						//load lai trang truoc
						header('Location: ' . $_SERVER['HTTP_REFERER']);
						exit;
					}
				}
			}
		}
	// xóa ảnh trong phần chỉnh sửa đối tác
	case 'del_img': {

			$id_hd = $_GET['id_hd'];
			$file_name = $_GET['name_img'];
			// xóa ảnh trong thư mục
			if (strpos($file_name, '.pdf'))
			{
				if (file_exists("View/uploads/doitac/pdf/" . $file_name)) 
				{
					unlink("View/uploads/doitac/pdf/" . $file_name);
				}
			}
			else
			{
				if (file_exists("View/uploads/doitac/pic/" . $file_name)) 
				{
					unlink("View/uploads/doitac/pic/" . $file_name);
				}
			}	
			// xóa ảnh trong cow sở dữ liệu
			if ($db->Delimg($id_hd, $file_name,'hoatdong')) {	//load lai trang truoc
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}
			break;
		}
	// xóa ảnh trong phần giới thiệu	
	case 'del_img_intr': {

			$stt = $_GET['id'];
			$file_name = $_GET['name_img'];
			// xóa ảnh trong thư mục
			if (file_exists("View/uploads/gioithieu/" . $file_name)) {
				unlink("View/uploads/gioithieu/" . $file_name);
			}

			// xóa ảnh trong cow sở dữ liệu
			if ($db->DelImgGT($stt, $file_name)) {	//load lai trang truoc
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}
			break;
		}

	//xoa 1 hoat dong của đối tác
	case 'del_act': {
			$id_hd = $_GET['id_hd'];
			$id_linhvuc = $_GET['id_catg'];
			$id = $_GET['id'];
			//xóa ảnh của hoạt động
			$data_anh=$db->getDataAnh($id_hd,'hoatdong');
			foreach($data_anh as $value)
			{
				if (strpos($value['img'], '.pdf'))
				{
					if (file_exists("View/uploads/doitac/pdf/" .  $value['img'])) 
					{
						// xóa trong thư mục
						unlink("View/uploads/doitac/pdf/" . $value['img']);
						// xóa trong cơ sở dữ liệu
						$db->Delimg($id_hd, $value['img'],'hoatdong');
					}	
				}
				else
				{
					if (file_exists("View/uploads/doitac/pic/" .  $value['img'])) 
					{
						// xóa trong thư mục
						unlink("View/uploads/doitac/pic/" . $value['img']);
						// xóa trong cơ sở dữ liệu
						$db->Delimg($id_hd, $value['img'],'hoatdong');
					}					
				}	
			}
			//	
			if ($db->DelHD($id_hd, $id_linhvuc)) {
				$path =	'location: index.php?controller=admin&action=detail&id=' . $id . '&category=default' ;
				header($path);
			}


			break;
		}
	// chỉnh sửa đối tác
	case 'edit': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$tble = 'doitac';
				$dataId = $db->getDataId($tble, $id);

				if (isset($_POST['suadoitac'])) {
					$id_doitac = $_GET['id'];
					$ten_doitac = $_POST['tendoitac'];
					$email = $_POST['email'];
					$sdt = $_POST['sdt'];
					$diachi = $_POST['diachi'];
					$website = $_POST['website'];
					$gioithieu = $_POST['gioithieu'];
					if ($db->UpdateDt($id_doitac, $ten_doitac, $email, $sdt, $diachi,$website, $gioithieu)) {
						$path = 'location: index.php?controller=admin&action=detail&id=' . $id_doitac . '&category=default';
						header($path);
					}
				}
				require_once ('View/admin/edit_doitac.php');
				break;
			}
		}
	// chỉnh sửa hoạt động
	case 'edit_act': {
			$id_doitac = $_GET['id'];
			$id_linhvuc = $_GET['category'];
			$id_hd = $_GET['id_hd'];
			// lay du lieu ảnh theo id hoạt động
			$data_anh = $db->getDataAnh($_GET['id_hd'],'hoatdong');
			// lay ten linh vuc theo id linh vuc
			$data_lv = $db->getNamelv($id_doitac);
			$data_hd = $db->getAlldataHdByidHD($id_doitac, $id_linhvuc, $id_hd);
			foreach ($data_lv as $value) {
				$get_namelv[$value['id_linhvuc']] = $value['ten_linhvuc'];
			}
			// them hoat dong
			if (isset($_POST['suahoatdong'])) {
				$id_hoatdong = $_POST['idhd'];
				$td_hoptac = $_POST['tdhd'];
				$phutrach = $_POST['phutrach'];
				$thoigian = $_POST['tg'];
				$nd_hoptac = $_POST['noidung'];
				// tile của ảnh
				if ($_GET['category'] == 'default') {
					foreach ($data_lv as $value) {
						$_GET['category'] = $value['id_linhvuc'];
						break;
					}
				}

				$id_linhvuc = $_GET['category'];
				//them hinh anh 
				if (isset($_FILES['hinhanh'])) {

					$file = $_FILES['hinhanh'];
					$file_name = $file['name'];
					###them
					foreach ($file_name as $key => $value) {
						// nếu là file pdf
						if (strpos($value, '.pdf'))
						{						
							move_uploaded_file($file['tmp_name'][$key], 'View/uploads/doitac/pdf/' . $value);
						}
						else // các trường hợp là ảnh
						{
							move_uploaded_file($file['tmp_name'][$key], 'View/uploads/doitac/pic/' . $value);							
						}	
					}
					####

					if (!empty($_FILES['hinhanh']['name'][0])) {
						foreach ($file_name as $key => $value) {
							$db->Insertdata_hinhanh($id_doitac, $id_linhvuc, $id_hoatdong, $value, '');
						}
					}
				}

				// update noi dung anh
				if (isset($_POST['noidung_anh'])) {
					$title = $_POST['noidung_anh'];
					foreach ($title as $key => $value_anh) {
						$db->UpdateTitleImg($value_anh['id_hd'], $value_anh['img'], $value_anh['nd']);
					}
				}

				//update hoat động
				$db->UpdateHD($id_doitac, $id_linhvuc, $td_hoptac, $phutrach, $thoigian, $nd_hoptac, $id_hoatdong); 
				// load lai trang
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}

			require_once ('View/admin/edit_hoatdong.php');
			break;
		}
	// chỉnh sửa giới thiệu 
	case 'edit_introduce': {
			$data_gt = $db->getAlldataGT();
			if (isset($_POST['themsoluongmuc'])) {

				$soluong = $_POST['soluong'];
				$vitri = $_POST['position'];
				$db->InsertNumIntro($soluong,$vitri);
				// tự load lại trang
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			if (isset($_POST['capnhatgioithieu'])) 
			{
				$stt = 1;
				$end = count($data_gt);
				//thêm tiêu đề đầu tiên
				$db->InsertTextIntro($_POST['nd0'], '0', '0');
				// thêm các mục còn lại
				for ($i = $stt; $i < $end; $i++) 
				{
					$td = 'td' . strval($i);
					$nd = 'nd' . strval($i);
					$db->InsertTextIntro($_POST[$td], $_POST[$nd], $i);

					// thêm ảnh
					if (isset($_FILES['hinhanhgt' . strval($i)])) 
					{
						$file = $_FILES['hinhanhgt' . strval($i)];
						$file_name = $file['name'];

						foreach ($file_name as $key => $value) {
							move_uploaded_file($file['tmp_name'][$key], 'View/uploads/gioithieu/' . $value);
						}

						if (!empty($_FILES['hinhanhgt' . strval($i)]['name'][0])) {
							foreach ($file_name as $key => $value) {
								$db->Insertdata_hinhanh_GT($i, $value, '');
							}
						}
						////////////
						// update noi dung anh
						if (isset($_POST['noidung_anh'.strval($i)])) 
						{
							$title = $_POST['noidung_anh'.strval($i)];
							foreach ($title as $key => $value_anh) 
							{
								$db->UpdateTitleImgGT($value_anh['stt_tieude'], $value_anh['img'], $value_anh['nd']);
							}
						}
					}
				}

				// tự load lại trang
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}

			//them hinh anh

			require_once ('View/admin/edit_gioithieu.php');

			break;
		}
	// chỉnh sửa liên hệ	
	case 'edit_contact': {
			$data_lh = $db->getAlldataLH();
			
			if (isset($_POST['themsoluonlh'])) {

				$soluong = $_POST['soluong'];

				$db->InsertNumLH($soluong);
				// tự load lại trang
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			if(isset($_POST['capnhatlienhe']))
			{
				$stt = 0;
				$end = count($data_lh);
				//thêm tiêu đề đầu tiên
				// thêm các mục còn lại
				for ($i = $stt; $i < $end; $i++) 
				{
					$tenlh = 'tenlh' . strval($i);
					$gmail = 'gmail' . strval($i);
					$sdt = 'sdt' . strval($i);
					$db->InsertTextContact($_POST[$tenlh], $_POST[$gmail], $_POST[$sdt], $i);

				}
				header('Location: ' . $_SERVER['HTTP_REFERER']);

			}

			require_once('View/admin/edit_lienhe.php');

			break;	
	}
	// xóa liên hệ
	case 'del_contact': {
			$index = strval($_GET['id']);
			$db->delIndexOfContact($index);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			break;
		}
	// xóa mục giới thiệu
	case 'del_intro': {
			$index = strval($_GET['id']);
			// xóa tất cả các ảnh trong 1 mục
			// dữ liêu tất cả trong bảng hình ảnh giới thiệu
			$data_anh=$db->getAlldata('hinhanh_gioithieu');
			foreach ($data_anh as $value){
				if( $value['stt_tieude'] == $index){
					$stt = $index;
					$file_name = $value['img'];
					// xóa ảnh trong thư mục
					if (file_exists("View/uploads/gioithieu/" . $file_name)) {
						unlink("View/uploads/gioithieu/" . $file_name);
						// xóa ảnh trong cơ sở dữ liêu
						$db->DelImgGT($stt, $file_name);
					}
									
				}
			}
			// xóa mục trong bảng giới thiệu
			$db->delIndexOfIntro($index);
			header('Location: ' . $_SERVER['HTTP_REFERER']);

			break;
		}

	// xóa đối tác
	case 'delete': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				// xóa tất cả các ảnh liên quan đến đối tác
				$data_anh=$db->getDataAnh($id,'doitac');
				foreach($data_anh as $value)
				{
					if (strpos($value['img'], '.pdf'))
					{					
						if (file_exists("View/uploads/doitac/pdf/" .  $value['img'])) 
						{
							// xóa trong thư mục
							unlink("View/uploads/doitac/pdf/" . $value['img']);
							// xóa trong cơ sở dữ liệu
							$db->Delimg($id, $value['img'],'doitac');
						}
					}
					else
					{
						if (file_exists("View/uploads/doitac/pic/" .  $value['img'])) 
						{
							// xóa trong thư mục
							unlink("View/uploads/doitac/pic/" . $value['img']);
							// xóa trong cơ sở dữ liệu
							$db->Delimg($id, $value['img'],'doitac');
						}						
					}			
				}

				if ($db->DelDt($id)) {
					header('location: index.php?controller=admin&action=list');
				} else {
					header('location: index.php?controller=admin&action=list');
				}
			}
			break;
		}
	// danh sách đối tác	
	case 'list': {
			$tble = "doitac";
			$data = $db->getAlldata($tble);
			require_once ('View/admin/list_doitac.php');
			break;
		}
	// phân loại đối tác	
	case 'sort': {
			$tble = "doitac";
			$id_linhvuc = $_GET['id_catg'];
			$data = $db->getAlldataIdLv($tble, $id_linhvuc);
			$data_lv_all = $db->getAlldata("chitiet_linhvuc"); // lấy dữ liệu lĩnh vực 
			require_once ('View/admin/list_doitac.php');
			break;
		}

	// đăng xuất
	case 'logout': {
			require_once ('View/admin/sessions_end.php');
			header('location: index.php?controller=client&action=list');
			break;
		}

	// chi tiết của đối tác
	case 'detail': {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$tble = 'doitac';
				// lấy dữ liệu thongotin đối tác
				$data_doitac = $db->getAlldataId($tble, $id);

				// in ra linh vuc
				$tble_3 = 'chitiet_linhvuc';
				$tble_2 = 'hoptac';

				$data_lv = $db->getAlldataLinhvucId($tble, $tble_2, $tble_3, $id);

			}

			$nhap = $_GET['category'];

			// gan phan tu dau tien mac định 
			if ($nhap == 'default') {


				if (empty($data_lv)) {
					echo ""; // đối tác chưa có lĩnh vực hợp tác nào 
				} else {
					foreach ($data_lv as $value) {
						$_GET['category'] = $value['id_linhvuc'];
						break;
					}
				}
			}
			//lay data hoat dong


			$id = $_GET['id'];
			$linhvuc = $_GET['category'];
			$data_hd = $db->getAlldataHd($id, $linhvuc);

			require_once ('View/admin/tt_chitiet.php');

			break;
		}
	// ẩn hoạt động	
	case 'hid_act': {
			$id_dt = $_GET['id'];
			$id_linhvuc = $_GET['id_catg'];
			if (isset($_GET['id_hd'])) {
				$id = $_GET['id_hd'];
				$value = $_GET['act_1'];
				$db->Updatestatus($id, $value);
			}

			header('location: index.php?controller=admin&action=detail&id=' . $id_dt . '&category=' . $id_linhvuc);
			break;
		}
	// tìm kiếm	
	case 'search': {
			$key = $_GET['key'];
			$catg = $_GET['name'];

			if (isset($key)) {
				$data = $db->Search($key, $catg);
			}
			switch ($catg) {
				case 'search_all': {
						$str='TẤT CẢ';
						require_once ('View/admin/search/search_all.php');
						break;
					}
				case 'search_catg': {
						// dùng chung
						$str='LĨNH VỰC';					
						require_once ('View/admin/search/search_all.php');
						break;
					}									
				case 'search_obj': {
						$str='ĐỐI TÁC';
						require_once ('View/admin/search/search_doitac.php');
						break;
					}
				case 'search_act': {
						$str='HOẠT ĐỘNG';
						require_once ('View/admin/search/search_hoatdong.php');
						break;
					}
			}
			break;
		}
	// chi tiết của hoạt động
	case 'dtl_srch_act': {
			$id = $_GET['id'];
			$tble = 'doitac';

			$data_doitac = $db->getAlldataId($tble, $id);
			$id_hd = $_GET['id_hd'];
			// lay anh cua hoat dong
			$data_anh=$db->getDataAnh($id_hd,'hoatdong');
			if (isset($id_hd)) {

				$data = $db->getAlldataIdHd('chitiet_hoptac', $id_hd);
				require_once ('View/admin/search/chitiet_timkiem_hd.php');
			}

			break;
		}

	default: {
			require_once ('View/admin/list_doitac.php');
			break;
		}
}
