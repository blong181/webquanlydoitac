<?php include('sessions_start.php'); ?>

<?php
// lấy dữ liệu lĩnh vực tùy theo trang 
$tble = "chitiet_linhvuc";
$tble_2 = "hoptac";

$tble = "chitiet_linhvuc";
$data = $db->getAlldata($tble);
?>

<?php
if (isset($_POST['themlinhvuc'])) {
  if($_POST['ten']!=NULL)
  {
    $ten_linhvuc = $_POST['ten'];
    $db->Insertdata_ctLinhvuc($ten_linhvuc, 0);

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
?>
<style type="text/css">

</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CTU</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php


        if ($_GET['controller'] == "admin") {

          $controller = 'admin';
        } else {
          $controller = 'client';
        }



        ?>
        `<li><a href="index.php?controller=<?php echo $controller; ?>&action=list">HỢP TÁC </a> </li>
        <li><a href="index.php?controller=<?php echo $controller; ?>&action=add_obj">THÊM ĐỐI TÁC</a> </li>
        <!-- /CHỈNH SỬA THÔNG TIN-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">THÔNG TIN <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="index.php?controller=<?php echo $controller; ?>&action=edit_introduce">GIỚI THIỆU </a> </li>
            <li><a href="index.php?controller=<?php echo $controller; ?>&action=edit_contact">LIÊN HỆ </a></li>

          </ul> <!-- /.drop down menu-->
        </li> <!-- /.drop down menu-->
        <!-- /QUẢN LÝ TAI KHOAN QUẢN LÝ-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TÀI KHOẢN <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="index.php?controller=<?php echo $controller; ?>&action=add_user">THÊM TÀI KHOẢN </a> </li>
            <li><a href="index.php?controller=<?php echo $controller; ?>&action=del_user">XÓA TÀI KHOẢN </a></li>

          </ul> <!-- /.drop down menu-->
        </li> <!-- /.drop down menu-->
        <!-- /.LĨNH VỰC HỢP TÁC-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LĨNH VỰC <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <?php
              foreach ($data as $value) {

              ?>
                <a style="display:inline-block;" href="index.php?controller=admin&action=sort&id_catg=<?php echo $value['id_linhvuc']; ?>"><?php echo $value['ten_linhvuc']; ?>
                </a>
                <a style="display:inline-block;float: right;" onclick='return confirm("bạn muốn xóa ?")' href="index.php?controller=admin&action=del_catg&id_catg=<?php echo $value['id_linhvuc']; ?>">
                  <i class="bi bi-x-circle-fill"></i></i>
                </a>
              <?php } ?>
            </li>

            <form class="navbar-form navbar-left" action="" method="POST">
              <div class="col-md-8">
                <input class="form-control" type="text" name="ten" placeholder="nhập tên lĩnh vực">
              </div>
              <div class="col-md-2">
                <span class="input-group-btn">
                  <input class="btn btn-default" type="submit" name="themlinhvuc" value="thêm">
                </span>
              </div>

            </form>

          </ul> <!-- /.drop down menu-->
        </li> <!-- /.drop down menu-->
      </ul>

      <form class="navbar-form navbar-left" action="" method="GET">

        <div class="form-group">
          <input type="hidden" name="controller" value="admin">
          <input type="text" class="form-control" type="text" id="search" name="key" placeholder="Search">
          <input type="hidden" name="action" value="search">

        </div>
        <select class="form-control" name="name">

          <option value="search_all">tất cả</option>
          <option value="search_catg">lĩnh vực</option>
          <option value="search_obj">đối tác</option>
          <option value="search_act">hoạt động</option>


        </select>
        <button type="submit" type="submit" value="tìm kiếm" class="btn btn-default">SEARCH</button>

      </form>






      <ul class="nav navbar-nav navbar-right">
        <li>
          <h4 align="center"> <?php echo $_SESSION['submit'] ?>&nbsp;&nbsp;<a href="index.php?controller=admin&action=logout"><i class="bi bi-box-arrow-right"></i></a></h4>
        </li>

      </ul>

    </div>


  </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>