<?php
// lấy dữ liệu lĩnh vực tùy theo trang 
$tble = "chitiet_linhvuc";
$tble_2 = "hoptac";

$tble = "chitiet_linhvuc";
$data = $db->getAlldata($tble);

?>
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
        <li><a href="index.php?controller=client&action=introduce">TRANG CHỦ</a></li>
        <li> <a href="index.php?controller=client&action=list"> HỢP TÁC</a></li>
        <li><a href="index.php?controller=client&action=contact">LIÊN HỆ </a></li>
        <li><a href="index.php?controller=client&action=login">QUẢN LÝ</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            LĨNH VỰC <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($data as $value) {

            ?>
              <li>
                <a href="index.php?controller=client&action=sort&id_catg=<?php echo $value['id_linhvuc']; ?>">
                  <?php echo $value['ten_linhvuc']; ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" action="" method="GET">
        <div class="form-group">
          <input type="hidden" name="controller" value="client">
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
        <?php # include_once('Controller/client/index.php'); 
        ?>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>