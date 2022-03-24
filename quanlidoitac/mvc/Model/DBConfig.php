<?php
class Database
{
	private $hostname = 'localhost';
	private $username = 'root';
	private $pass = '';
	private $dbname = 'nienluancs';

	private $conn = NULL;
	private $rersult = NULL;

	public function connect()
	{
		$this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->dbname);
		if (!$this->conn) {
			echo "ket noi that bai";
			exit();
		} else {
			mysqli_set_charset($this->conn, 'utf8');
		}
		return $this->conn;
	}
	// truy vấn dữ liệu
	public function execute($sql)
	{

		$this->result = $this->conn->query($sql);
		return $this->result;
	}
	// phuong thuc lay du lieu
	// lay 1 donngf
	public function getData()
	{
		if ($this->result) {
			$data = mysqli_fetch_array($this->result);
		}
		 else 
		{

			$data = 0;
		}
		return $data;
	}
	// tra ve dong du lieu
	public function num_rows()
	{
		if ($this->result) {
			$num = mysqli_num_rows($this->result);
		} else {
			$num = 0;
		}
		return $num;
	}
	// lay tat ca du lieu 
	public function getAlldata($table)
	{
		$sql = "SELECT * FROM $table";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	// lấy toàn bộ dữ liệu theo id lĩnh vực
	public function getAlldataIdLv($table, $id)
	{
		$sql = "SELECT * FROM $table join hoptac on $table.id_doitac = hoptac.id_doitac 
				WHERE hoptac.id_linhvuc='$id'";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}

	// lấy toàn bộ dữ liệu theo id đối tác
	public function getAlldataId($table, $id)
	{
		$sql = "SELECT * FROM $table WHERE id_doitac='$id'";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}

	// lay toan bo du lieu theo id hoat dong
	public function getAlldataIdHd($table, $id)
	{
		$sql = "SELECT * FROM $table WHERE id_hd='$id'";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	// lay ten cua linh vuc theo id linh vuc
	public function getNamelv($id)
	{
		$tble = "chitiet_linhvuc";
		$tble_2 = 'hoptac';
		$sql = "SELECT ten_linhvuc,$tble.id_linhvuc 
				FROM $tble join $tble_2 on $tble.id_linhvuc = $tble_2.id_linhvuc
			 	WHERE $tble_2.id_doitac='$id'";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	// lấy id lĩnh vực theo tên lĩnh vực
	public function getIdlv($ten)
	{
		$tble = "chitiet_linhvuc";

		$sql = "SELECT id_linhvuc FROM $tble 
			 WHERE ten_linhvuc='$ten' ";
		$this->execute($sql);
		$data[] = $this->getData();
		return $data;
	}

	// lấy tên lĩnh vực và id lĩnh vực theo id đối tác
	public function getAlldataLinhvucId($tb_doitac, $tb_hoptac, $tb_chitiet_linhvuc, $id)
	{
		$sql = "SELECT ten_linhvuc,$tb_hoptac.id_linhvuc
				FROM ($tb_chitiet_linhvuc join $tb_hoptac 
				on $tb_hoptac.id_linhvuc = $tb_chitiet_linhvuc.id_linhvuc ) 
				join $tb_doitac on $tb_doitac.id_doitac = $tb_hoptac.id_doitac 
				WHERE $tb_hoptac.id_doitac='$id' ";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	// lay thong tin chi tiet hoat dong bằng iddoitac và idlinhvuc
	public function getAlldataHd($id_doitac, $id_linhvuc)
	{
		$sql = "SELECT *
					 FROM chitiet_hoptac 
					 WHERE id_doitac='$id_doitac' AND id_linhvuc='$id_linhvuc' 
					 ORDER BY thoigian DESC ";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}

		return $data;
	}
	// lấy chi tiết hoạt động theo id đối tác , id lĩnh vực và id hoạt động
	public function getAlldataHdByidHD($id_doitac, $id_linhvuc, $id_hoatdong)
	{
		$sql = "SELECT *
					 FROM chitiet_hoptac 
					 WHERE id_doitac='$id_doitac' AND id_linhvuc='$id_linhvuc' AND id_hd='$id_hoatdong'
					 ORDER BY thoigian DESC ";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}

		return $data;
	}

	// lấy dữ liệu bảng admin

	public function getadmin($table, $u, $p)
	{

		$sql = "select * from admin where username='$u' and password='$p'";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}

	//lay ảnh bằng id các đối tượng hoạt động, lĩnh vực, đối tác
	public function getDataAnh($id,$obj)
	{
		if($obj=='hoatdong')
		{	
			$data=$this->getAlldataIdHd("hinhanh", $id);
			return $data;
		}
		elseif($obj=='doitac')
		{
			$data=$this->getAlldataId("hinhanh", $id);
			return $data;
		}
		elseif($obj=='linhvuc')
		{
			$table = "hinhanh";
			$sql = "SELECT * FROM $table WHERE id_linhvuc='$id' ";
			$this->execute($sql);
			if ($this->num_rows() == 0) {
				$data = 0;
			} else {
				while ($datas = $this->getData()) {
					$data[] = $datas;
				}
			}
			return $data;
		}					
	}

	// lấy dữ liệu cần sửa theo id đối tác khác với getAlldataId
	public function getDataId($table, $id)
	{
		$sql = "SELECT * FROM $table WHERE id_doitac='$id' ";
		$this->execute($sql);
		if ($this->num_rows() != 0) {
			$data = mysqli_fetch_array($this->result);
		} else {

			$data = 0;
		}
		return $data;
	}


	// thêm user
	public function Insertdata_user($ten_user, $acc_user, $pass)
	{

		$check = "select * from admin where username='$acc_user'";
		$this->execute($check);
		if ($this->num_rows() != 0) {
		    echo '<script language="javascript">';
		    echo 'alert("tài khoản đã tồn tại, nhập lại")';
		    echo '</script>';
		} else {
			$sql = "INSERT INTO admin(username,password,hoten) VALUES('$acc_user','$pass','$ten_user')";
			return $this->execute($sql);
		}
	}

	// xoa user
	public function Del_user($acc_user)
	{

		$tble = 'admin';

		// xóa 1 hoạt động theo id linhx vuc 
		$sql = " DELETE FROM $tble 
			WHERE $tble.username='$acc_user'";
		return $this->execute($sql);
	}
	// các phuong thức của đối tác


	//them dữ liệu vào bảng đối tác
	public function Insertdata_doitac($id_doitac, $ten_doitac, $email, $sdt, $diachi,$website, $gioithieu)
	{
		$sql = "INSERT INTO doitac(id_doitac,ten_doitac,email,sdt,diachi,website,gioithieu) 
				VALUES('$id_doitac','$ten_doitac','$email','$sdt','$diachi','$website','$gioithieu')";
		return $this->execute($sql);
	}
	//them du lieu vao bang hop tac
	public function Insertdata_hoptac($id_doitac, $id_linhvuc)
	{
		$check_exist = "SELECT id_doitac,id_linhvuc 
						FROM hoptac 
						WHERE id_doitac = '$id_doitac' AND id_linhvuc='$id_linhvuc'";

		$this->execute($check_exist);
		if ($this->num_rows() == 0) {

			$sql = "INSERT INTO hoptac(id_doitac,id_linhvuc) VALUES('$id_doitac','$id_linhvuc')";
			return $this->execute($sql);
		}
	}
	public function Insertdata_ctLinhvuc($ten_linhvuc, $stt)
	{
		//gán mã linh vuc
		for ($i = 0;; $i++) {
			$id_linhvuc = "categ" . "_" . strval($stt);
			$sql = "SELECT id_linhvuc FROM chitiet_linhvuc WHERE id_linhvuc = '$id_linhvuc'";
			$this->execute($sql);
			if ($this->num_rows() == 0) {
				// row not found, do stuff..
				$id_linhvuc = "categ" . "_" . strval($stt);
				break;
			} else {
				$stt++;
			}
		}
		$sql = "INSERT INTO chitiet_linhvuc(id_linhvuc,ten_linhvuc) VALUES('$id_linhvuc','$ten_linhvuc')";
		return $this->execute($sql);
	}
	//
	//gán mã đối tác
	public function SetIdName()
	{	$id=0;
		for ($i = 0;; $i++) {
			$id_doitac = 'CTU' . "_" . strval($id);

			$sql = "SELECT id_doitac FROM doitac WHERE id_doitac = '$id_doitac'";
			$this->execute($sql);
			if ($this->num_rows() == 0) {
				// row not found, do stuff..
				$id_hoatdong = $id_doitac . "_" . strval($id);
				break;
			} else {
				$id++;
			}
		}
		return $id_doitac;
	}
	//thêm hình ảnh
	public function Insertdata_hinhanh($id_doitac, $id_linhvuc, $id_hd, $file_name, $title)
	{

		$sql = "INSERT INTO hinhanh(id_doitac,id_linhvuc,id_hd,img,noi_dung) 
			VALUES('$id_doitac','$id_linhvuc','$id_hd','$file_name','$title')";
		return $this->execute($sql);
	}
	// thêm vào bảng chi tiết hợp tác
	public function Insertdata_cthoptac($id_doitac, $id_linhvuc, $tg, $phutrach, $tdhd, $noidung, $stt, $file_name, $title)
	{
		$trangthai = 1; // mặc định là 1 show 
		//gán mã hoạt động
		for ($i = 0;; $i++) {
			$id_hoatdong = $id_doitac . $id_linhvuc . "_" . strval($stt);
			$sql = "SELECT id_hd FROM chitiet_hoptac WHERE id_hd = '$id_hoatdong'";
			$this->execute($sql);
			if ($this->num_rows() == 0) {

				// row not found, do stuff..
				$id_hoatdong = $id_doitac . $id_linhvuc . "_" . strval($stt);
				break;
			} else {
				$stt++;
			}
		}
		///	
		if ($file_name != 'NULL') {
			foreach ($file_name as $key => $value) {
				$this->Insertdata_hinhanh($id_doitac, $id_linhvuc, $id_hoatdong, $value, $title);
			}
		}
		/////
		$sql_2 = "INSERT INTO chitiet_hoptac(id_doitac,id_linhvuc,thoigian,phutrach,td_hoptac,nd_hoptac,id_hd,trangthai) 
			VALUES('$id_doitac','$id_linhvuc','$tg','$phutrach','$tdhd','$noidung','$id_hoatdong','$trangthai')";
		return $this->execute($sql_2);
	}


	//update đối tác		
	public function UpdateDt($id_doitac, $ten_doitac, $email, $sdt, $diachi,$website, $gioithieu)
	{
		$sql = "UPDATE doitac 
			SET ten_doitac='$ten_doitac',email='$email',sdt='$sdt',diachi='$diachi',website='$website',gioithieu='$gioithieu'  
			WHERE id_doitac= '$id_doitac' ";
		return $this->execute($sql);
	}
	//update hoạt động
	public function UpdateHD($id_doitac, $id_linhvuc, $td_hoptac, $phutrach, $thoigian, $nd_hoptac, $id_hoatdong)
	{
		$sql = "UPDATE chitiet_hoptac 
			SET td_hoptac='$td_hoptac',phutrach='$phutrach',thoigian='$thoigian',nd_hoptac='$nd_hoptac'
			WHERE id_doitac= '$id_doitac' AND id_linhvuc='$id_linhvuc' AND id_hd='$id_hoatdong'";
		return $this->execute($sql);
	}

	// xóa 1 đối tác
	public function DelDt($id_doitac)
	{
		$tble = 'doitac';
		$tble_2 = 'hoptac';
		$tble_3 = 'chitiet_hoptac';
		$tble_4 = 'hinhanh';
		$sql = "DELETE FROM $tble WHERE $tble.id_doitac= '$id_doitac' ";
		$this->execute($sql);
		// xoa id doi tac trong bang hop tac
		$sql_2 = " DELETE FROM $tble_2 WHERE $tble_2.id_doitac= '$id_doitac' ";
		$this->execute($sql_2);
		//xoa id doi tac trong bang chi tiet hop tac
		$sql_3 = " DELETE FROM $tble_3 WHERE $tble_3.id_doitac= '$id_doitac' ";
		$this->execute($sql_3);
		//xoa id doi tac trong bang hinhanh
		$sql_4 = " DELETE FROM $tble_4 WHERE $tble_4.id_doitac= '$id_doitac' ";
		return $this->execute($sql_4);
	}
	//xóa 1 hoạt động 
	public function DelHd($id_hd, $id_linhvuc)
	{

		$tble = 'chitiet_hoptac';
		$tble_4 = 'hinhanh';
		// xóa 1 hoạt động theo id hoạt động
		$sql = "DELETE FROM $tble WHERE $tble.id_hd='$id_hd' ";
		$sql_4 = " DELETE FROM $tble_4 WHERE $tble_4.id_hd= '$id_hd' ";
		$this->execute($sql_4);
		// kiểm tra lĩnh vực rỗng
		$sql_2 = "SELECT * FROM $tble WHERE $tble.id_linhvuc = '$id_linhvuc'";
		//xóa lĩnh vực rỗng
		$sql_3 = " DELETE FROM hoptac WHERE id_linhvuc= '$id_linhvuc' ";
		$this->execute($sql);
		$this->execute($sql_2);
		//xoa id doi tac trong bang hinhanh
		if ($this->num_rows() == 0) {

			return $this->execute($sql_3);
		} else {
			return $this->execute($sql_2);
		}
	}
	//xóa toàn bộ dữ liệu của lĩnh vực 
	public function DelLV($id_linhvuc)
	{

		$tble = 'chitiet_linhvuc';
		$tble_2 = 'hoptac';
		$tble_3 = 'chitiet_hoptac';
		$tble_4 = 'hinhanh';
		// xóa 1 hoạt động theo id linhx vuc 
		$sql = "DELETE FROM $tble WHERE $tble.id_linhvuc='$id_linhvuc' ";
		$this->execute($sql);
		$sql_2 = "DELETE FROM $tble_2 WHERE $tble_2.id_linhvuc='$id_linhvuc' ";
		$this->execute($sql_2);
		$sql_3 = "DELETE FROM $tble_3 WHERE $tble_3.id_linhvuc='$id_linhvuc' ";
		$this->execute($sql_3);
		$sql_4 = " DELETE FROM $tble_4 WHERE $tble_4.id_linhvuc= '$id_linhvuc' ";
		return $this->execute($sql_4);
	}
	// xóa lĩnh vực và tất cả liên quan đến lĩnh vực của 1 đối tác 
	public function DelLV_obj($id_linhvuc, $id_doitac)
	{

		$tble_2 = 'hoptac';
		$tble_3 = 'chitiet_hoptac';
		$tble_4 = 'hinhanh';
		// xóa 1 hoạt động theo id linhx vuc 
		$sql_2 = "DELETE FROM $tble_2 
			WHERE $tble_2.id_linhvuc='$id_linhvuc' AND $tble_2.id_doitac='$id_doitac' ";
		$this->execute($sql_2);
		$sql_3 = "DELETE FROM $tble_3 
			WHERE $tble_3.id_linhvuc='$id_linhvuc' AND $tble_3.id_doitac='$id_doitac'";
		$this->execute($sql_3);
		$sql_4 = " DELETE FROM $tble_4 
			WHERE $tble_4.id_linhvuc='$id_linhvuc' AND $tble_4.id_doitac='$id_doitac'";
		return $this->execute($sql_4);
	}
	// xóa ảnh theo id và đối tượng
	public function Delimg($id, $name_img,$obj)
	{
		if($obj=='hoatdong')
		{
			$tble = 'hinhanh';
			$sql = " DELETE FROM $tble 
				WHERE $tble.id_hd= '$id' and $tble.img='$name_img' ";
			return $this->execute($sql);
		}
		elseif($obj=='doitac')
		{
			$tble = 'hinhanh';
			$sql = " DELETE FROM $tble 
				WHERE $tble.id_doitac= '$id' ";
			return $this->execute($sql);
		}

		elseif($obj=='linhvuc')
		{
			$tble = 'hinhanh';
			$sql = " DELETE FROM $tble 
				WHERE $tble.id_linhvuc= '$id'";
			return $this->execute($sql);
		}
						
	}
	// tìm kiếm theo từ khóa
	public function Search($key, $catg)
	{
		$tble = 'doitac';
		$tble_2 = 'chitiet_hoptac';
		$tble_3 = 'chitiet_linhvuc';
		switch ($catg) {
			case 'search_act': {
					$sql = "SELECT * FROM $tble_2 JOIN $tble ON $tble_2.id_doitac = $tble.id_doitac
							WHERE td_hoptac LIKE '%$key%'  ORDER BY thoigian DESC ";
					$this->execute($sql);
					break;
				}
			case 'search_obj': {
					$sql = "SELECT * FROM $tble 
							WHERE ten_doitac LIKE '%$key%'  ORDER BY id_doitac DESC ";
					$this->execute($sql);
					break;
				}
			case 'search_all': {
					$sql = 	"SELECT * FROM $tble_2
							JOIN $tble on $tble_2.id_doitac = $tble.id_doitac 
							JOIN   $tble_3 on $tble_3.id_linhvuc= $tble_2.id_linhvuc
							WHERE td_hoptac LIKE '%$key%' OR ten_doitac LIKE '%$key%' 
							OR ten_linhvuc LIKE '%$key%'
							ORDER BY thoigian DESC ";


					$this->execute($sql);
					break;


				}
			case 'search_catg': {
					$sql = 	"SELECT * FROM $tble_2
							JOIN $tble on $tble_2.id_doitac = $tble.id_doitac 
							JOIN   $tble_3 on $tble_3.id_linhvuc= $tble_2.id_linhvuc
							WHERE  ten_linhvuc LIKE '%$key%'
							ORDER BY thoigian DESC ";
					$this->execute($sql);
					break;
				}								
		}

		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	// trạng thái hiển thị nội dung				
	public function Updatestatus($id_hoatdong, $action)
	{
		switch ($action) {
			case 'show': {
					$value = 1;
					break;
				}
			case 'hide': {
					$value = 0;
					break;
				}
		}
		#echo $value;
		$sql = "UPDATE chitiet_hoptac 
				SET   trangthai='$value'
				WHERE id_hd= '$id_hoatdong' ";
		return $this->execute($sql);
	}
	// upadte tên ảnh 				
	public function UpdateTitleImg($id_hd, $img, $noidung)
	{


		$sql = "UPDATE hinhanh 
				SET   noi_dung='$noidung'
				WHERE img= '$img' and id_hd='$id_hd' ";
		return $this->execute($sql);
	}
	// các chức năng xử lý giới thiệu
	// thêm số lượng mục tiêu đề trong giới thiệu
	public function InsertNumIntro($soluong,$vitri)
	{

		$sql = "SELECT * FROM gioithieu";
		$this->execute($sql);
		$start = intval($this->num_rows());// số lượng phần tử 
		$end = intval($start) +	intval($soluong); // số lượng phần tử cộng với số lượng thêm mới
		if(isset($vitri))
		{
			// tịnh tiến stt
			// chạy từ dưới lên
			for ($i = $start  ; $i > $vitri; $i --) 
			{
				
				$index_new = strval($i+$soluong);
				$index_old = strval($i);
				$sql1 = "UPDATE gioithieu
					SET   stt_tieude='$index_new'
					WHERE stt_tieude= '$index_old' ";
				$this->execute($sql1);
				// kiểm tra mục giới thiệu có ảnh ?
				$sql2 = "SELECT *
					FROM   hinhanh_gioithieu
					WHERE stt_tieude= '$index_old' ";
				$this->execute($sql2);
				// nếu có 						
				if($this->num_rows()!=0)
				{
					// update stt tai bang hinh anh gioi thieu
					$sql3 = "UPDATE hinhanh_gioithieu
						SET   stt_tieude='$index_new'
						WHERE stt_tieude= '$index_old' ";
					$this->execute($sql3);
				}	
					
			}
					
			// thêm vào vị trí trống csdl
			for ($i = 1 ; $i < $end; $i++)
			{
				// kiểm tra có tồn tại stt chưa
				$check = strval($i);
				$sql1 = "SELECT stt_tieude FROM gioithieu WHERE stt_tieude = '$check'";
				$this->execute($sql1);
				if ($this->num_rows() == 0) {

					$sql2 = "INSERT INTO gioithieu(stt_tieude) VALUES('$check') ";

					$this->execute($sql2);
				}
			}
		}	
	}
	
	// lấy dữ tất cả liệu bảng giới thiệu
	public function getAlldataGT()
	{
		$table='gioithieu';
		$sql = "SELECT * FROM $table ORDER BY stt_tieude ASC ";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;

	}
	// xóa số thứ tự mục trong bảng giới thiệu
	public function delIndexOfIntro($index)
	{
		$sql1 = " DELETE FROM gioithieu WHERE stt_tieude='$index'";
		$this->execute($sql1);
		$this->autoResetIndex('gioithieu');
	}
	// cập nhật số thứ tự mục trong bảng giới thiệu theo thứ tự 
	public function autoResetIndex($table)
	{
		if($table=='gioithieu')
		{
			$stt = 1;
			$datas = $this->getAlldataGT();
			foreach ($datas as $value) 
			{
				if ($value['stt_tieude'] != '0') 
				{
					$index_new = strval($stt);
					$index_old = strval($value['stt_tieude']);
					$sql1 = "UPDATE gioithieu
						SET   stt_tieude='$index_new'
						WHERE stt_tieude= '$index_old' ";
					$this->execute($sql1);
					// kiểm tra mục giới thiệu có ảnh ?
					$sql2 = "SELECT *
						FROM   hinhanh_gioithieu
						WHERE stt_tieude= '$index_old' ";
					$this->execute($sql2);
					// nếu có 						
					if($this->num_rows()!=0)
					{
						// update stt tai bang hinh anh gioi thieu
						$sql3 = "UPDATE hinhanh_gioithieu
							SET   stt_tieude='$index_new'
							WHERE stt_tieude= '$index_old' ";
						$this->execute($sql3);
					}	
					$stt++;
				}
			}
		}
		elseif ($table=='lienhe') 
		{
			$stt = 0;
			$datas = $this->getAlldataLH();
			foreach ($datas as $value) 
			{
					$index_new = strval($stt);
					$index_old = strval($value['lh_stt']);
					$sql = "UPDATE lienhe
							SET   lh_stt='$index_new'
							WHERE lh_stt= '$index_old' ";
					$this->execute($sql);
					$stt++;
				
			}
		}	
	}
	// thêm nội dung text trong bảng giới thiệu
	public  function InsertTextIntro($gt_td, $gt_nd, $stt)
	{
		if ($stt == '0') // tieu đề đầu tiên
		{
			$sql = "UPDATE gioithieu
					SET gt_tieude='$gt_td'						
					WHERE stt_tieude='$stt' ";
			$this->execute($sql);
		} 
		else 
		{
			$sql = "UPDATE gioithieu
					SET gt_tieude='$gt_td',
						gt_noidung='$gt_nd'
					WHERE stt_tieude='$stt'";

			$this->execute($sql);
		}
	}

	// thêm ảnh của bảng giới thiệu
	public function Insertdata_hinhanh_GT($stt_tieude, $file_name, $title)
	{

		$sql = "INSERT INTO hinhanh_gioithieu(stt_tieude,img,noi_dung) 
				VALUES('$stt_tieude','$file_name','$title')";
		return $this->execute($sql);
	}
	// cập nhật nội dung ảnh của bảng giới thiệu
	public function UpdateTitleImgGT($stt, $img, $noidung)
	{

		$sql = "UPDATE hinhanh_gioithieu 
				SET   noi_dung='$noidung'
				WHERE img= '$img' and stt_tieude='$stt' ";
		return $this->execute($sql);
	}
	//lấy ảnh theo stt
	public function getDataAnhGT($stt)
	{

		$sql = "SELECT * FROM  hinhanh_gioithieu 
				WHERE stt_tieude='$stt' ";
		$this->execute($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($datas = $this->getData()) {
				$data[] = $datas;
			}
		}
		return $data;
	}
	//lấy tất cả các ảnh
	public function getAllDataAnhGT()
	{
		$data= $this->getAlldata('hinhanh_gioithieu');
		return $data;
	}
	// xóa ảnh bảng giới thiệu
	public function DelImgGT($stt, $name_img)
	{
		$sql = " DELETE FROM hinhanh_gioithieu 
				WHERE stt_tieude= '$stt' and img='$name_img' ";
		return $this->execute($sql);
	}
	// các chức năng xử lý liên hệ
	// thêm số lượng liên hệ 
	public function InsertNumLH($soluong)
	{

		$number = intval($soluong);

		$sql = "SELECT * FROM lienhe";
		$this->execute($sql);
		$start = intval($this->num_rows());
		$end = intval($start) +	intval($soluong);
		for ($i = $start; $i < $end; $i++) {
			// kiểm tra có tồn tại stt chưa
			$check = strval($i);
			$sql1 = "SELECT lh_stt FROM lienhe WHERE lh_stt = '$check'";
			$this->execute($sql1);
			if ($this->num_rows() == 0) {
				$sql2 = "INSERT INTO lienhe(lh_stt) VALUES('$check')";
				$this->execute($sql2);
			}
		}
	}
	// lấy tất cả dữ liệu bảng liên hệ
	public function getAlldataLH()
	{
		$data=$this->getAlldata('lienhe');
		return $data;
	}
	// xóa liên hệ
	public function delIndexOfContact($index)
	{
		$sql1 = " DELETE FROM lienhe WHERE lh_stt='$index'";
		$this->execute($sql1);
		$this->autoResetIndex('lienhe');// reset lai các số thứ tự
	}
	// thêm dữ liệu liên hệ
	public  function InsertTextContact($lh_ten,$lh_gmail, $lh_sdt, $stt)
	{

		$sql = "UPDATE lienhe
				SET lh_ten='$lh_ten',
					lh_gmail='$lh_gmail',
					lh_sdt='$lh_sdt'
				WHERE lh_stt='$stt'";

		$this->execute($sql);

	}
}
