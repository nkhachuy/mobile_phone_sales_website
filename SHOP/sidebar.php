<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <img src="./assets/images/logo.png" width="120" height="120" alt="Swiss Collection"> 
    <h5 style="margin-top:10px;">Hello, Admin</h5>
</div>

<hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./index.php" ><i class="fa fa-home"></i> Dashboard</a>
    <a href="./KhachHangAdmin.php"  onclick="showCustomers()" ><i class="fa fa-users"></i> Khách hàng</a>
    <a href="SanPhamAdmin.php"   onclick="showCategory()" ><i class="fa fa-th"></i> Sản phẩm</a>
    <a href="./LoaiSanPhamAdmin.php"   onclick="showSizes()" ><i class="fa fa-th"></i> Loại sản phẩm</a>
    
    <a href="./DonHangAdmin.php" onclick="showOrders()"><i class="fa fa-list"></i> Đơn hàng</a>
  
  <!---->
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>


