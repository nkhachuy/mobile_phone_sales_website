<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="./assets/css/style.css"></link>

</head>
<?php
    include("Connection.php");
    
    $sql = "SELECT * FROM san_pham";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    
    if ($sta->rowCount() > 0) {
        $san_pham = $sta->fetchAll(PDO::FETCH_OBJ);
    }
?>
<body>
    <?php 
    include("adminHeader.php");   
    include("sidebar.php");
    ?>    
    <div id="Content" class="row">
           
           <div class="col-12">
               <h2 align="center" class="mt-5">TRANG QUẢN LÝ KHÁCH HÀNG</h2>
               <button class="btn btn-primary my-2" type="submit"><a class="text-light"href="CreateCustomer.php"> ADD NEW</a> </button>
               <table class="table">
                   <thead>
                       <th>ID</th>
                       <th>Tên sản phẩm</th>
                       <th>Hình</th>
                       <th>Giá</th>
                       <th>Màn hình</th>
                       <th>Hệ điều hành</th>
                       <th>Camera sau</th>
                       <th>Camera trước</th>
                       <th>Chip</th>
                       <th>Ram</th>
                       <th>Dung lượng</th>
                       <th>Sim</th>
                       <th>Pin, sạc</th>
                       <th>Hãng</th>
                       <th>ID Loại</th>
                       <th>CRUD</th>
                   </thead>
                   <tbody>
                       <?php
                           foreach ($san_pham as $sp) {
                               ?>
                               <tr>
                                   <td><?php echo $sp->id_san_pham ?></td>
                                   <td><?php echo $sp->ten_san_pham ?></td>
                                   <td><img src="./Image_SanPham/<?php echo $sp->hinh ?>" alt="" width="50px"></td>
                                   <td><?php echo $sp->don_gia ?></td>
                                   <td><?php echo $sp->man_hinh ?></td>
                                   <td><?php echo $sp->he_dieu_hanh ?></td>
                                   <td><?php echo $sp->camera_sau ?></td>
                                   <td><?php echo $sp->camera_truoc ?></td>
                                   <td><?php echo $sp->chip ?></td>
                                   <td><?php echo $sp->ram ?></td>
                                   <td><?php echo $sp->dung_luong_luu_tru ?></td>
                                   <td><?php echo $sp->sim ?></td>
                                   <td><?php echo $sp->pin_sac ?></td>
                                   <td><?php echo $sp->hang ?></td>
                                   <td><?php echo $sp->id_loai ?></td>
                                   <td>
                                       <button class="btn btn-success" type="submit">
                                           <a href="" class="text-light">Update</a>
                                       </button>
                                       <button class="btn btn-danger" type="submit">
                                           <a href="" class="text-light">Delete</a>
                                       </button>
                                   </td>
                               </tr>
                               <?php
                           } 
                       ?>
                   </tbody>
               </table>
               
           </div>
        </div>

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>