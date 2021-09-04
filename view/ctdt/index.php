<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Quản lý chương trình đào tạo </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
    

<!-- Modal -->
<div class="modal fade" id="CTDTaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm chương trình đào tạo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="index.php?c=ctdt&m=create" method="POST">

            <div class="modal-body">
                <div class="form-group">
                    <label> Tên chương trình đào tạo </label>
                    <input type="text" name="ten" class="form-control" placeholder="Nhập tên chương trình đào tạo"required="">
                </div>

                <div class="form-group">
                    <label> Trạng thái </label><br>
                    <label><input type="radio" name="tt" value='1'checked="checked">Hoạt động</label>
                    <label><input type="radio" name="tt" value ='0'>Ngừng hoạt động</label>
                </div>
                <div class="form-group">
                    <label> Thứ tự hiển thị </label>
                    <input type="number" name="thutu" class="form-control" placeholder="Nhập thứ tự hiển thị"required="">
                </div>
                <div class="form-group">
                    <label> Ghi chú </label>
                    <textarea name="ghichu" id="ghichu" class="form-control" placeholder="Nhập ghi chú"required=""></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" name="insertdata" class="btn btn-primary">Thêm</button>
            </div>
        </form>

    </div>
  </div>
</div>




<!-- ####################################################################################################################### -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Sửa chương trình đào tạo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="index.php?c=ctdt&m=update" method="POST">

            <div class="modal-body">

                <input type="hidden" name="update_id" id="update_id">

                <div class="form-group">
                    <label> Tên chương trình đào tạo </label>
                    <input type="text" name="ten" id="ten" class="form-control" placeholder="Nhập tên chương trình đào tạo"required="">
                </div>

                <div class="form-group">
                    <label> Trạng thái </label><br>
                    <label><input type="radio" name="tt" id ="tt" value ='1'checked="checked">Hoạt động</label>
                    <label><input type="radio" name="tt" id ="tt" value ='0'>Ngừng hoạt động</label>
                </div>
				<div class="form-group">
                    <label> Thứ tự hiển thị</label>
                    <input type="text" name="thutu" id="thutu" class="form-control" placeholder="Nhập thứ tự hiển thị"required="">
                </div>
                <div class="form-group">
                    <label> Ghi chú </label>
                    <textarea name="ghichu" id="ghichu" class="form-control" placeholder="Nhập ghi chú" required=""></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" name="updatedata" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </form>

    </div>
  </div>
</div>

<!-- #################################################################################################### -->

<!-- #################################################################################################### -->

<!-- #################################################################################################### -->
<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2> Quản lý chương trình đào tạo </h2>
        </div>    
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CTDTaddmodal">
                    Thêm chương trình đào tạo
                </button>
            </div>
        </div>
		<?php 
			if (count($data)>0){
                            //print_r($data);die;
		?>
        <div class="card">
            <div class="card-body">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style = "display:none"></th>
                            <th style="width:3%">STT</th>
                            <th style="width:25%"data-orderable="false">Tên chương trình đào tạo</th>
                            <th style="width:13%"data-orderable="false"style="text-align:center">Trạng thái</th>
                            <th style="width:12%">Thứ tự hiển thị</th>
                            <th style="text-align:center">Ghi chú</th>
                            <th style="width:15%" data-orderable="false">Chi tiết CTĐT</th>
                            <th style="width:13%" data-orderable="false">Hành động</th>
                        </tr>
                    </thead>
			<tbody>
                            <?php
                                $stt =1;
                                foreach ($data as $key => $item){
                            ?>
                            <tr>
                            <td style = "display:none"><?php echo $item['id']; ?></td>
                            <td style="text-align:center"><?php echo $stt; ?></td>                            
                            <td><a href="index.php?c=monhoc&id=<?php echo $item['id'];?>&ten=<?php echo $item['ten']?>"><?php echo $item['ten']?></a></td>                           
                            <td style="text-align:center">
                            <?php 
                                if ($item['tt']==1)
                            {?>
                            <a class="fa fa-check" aria-hidden="true" style="color:green" href ="index.php?c=ctdt&m=change&id=<?php echo $item['id'];?>&tt=<?php echo $item['tt'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>
                            <?php 
                                    }?>
                            <?php 
                                    if ($item['tt']==0){?>
                            <a class="fa fa-minus-circle" aria-hidden="true" style="color:red" href ="index.php?c=ctdt&m=change&id=<?php echo $item['id'];?>&tt=<?php echo $item['tt'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>

                            <?php 
                                }
                            ?>
                            </td> 
                            <td style="text-align:center"><?php echo $item['thutu'];?></td> 
                            <td style="text-align:center"><?php echo $item['ghichu'];?></td>                                                                                 
                            <td style="text-align:center"> 
                                <a href="index.php?c=monhoc&id=<?php echo $item['id'];?>&ten=<?php echo $item['ten']?>">Xem chi tiết</a>
                            </td>
                            <td style="text-align:center">
                            <a type="button" href ="#" class=" fa fa-pencil editbtn"></a>
                            <a class="fa fa-trash" href ="index.php?c=ctdt&m=delete&id=<?php echo $item['id'];?>"onclick ="return confirm('Bạn có chắc chắn muốn xóa')"></a>
                            </td>
                        </tr>                   
                            <?php  
                            $stt++;
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
		<?php
                    }
		?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"> </script>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {

    $('#datatableid').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "aaSorting": [],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm",
        }
    });

});

</script>

<script>

$(document).ready(function () {
    $('.editbtn').on('click', function() {       
        $('#editmodal').modal('show');        
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#update_id').val(data[0]);
            $('.modal-body #ten').val(data[2]);
            $('.modal-body #thutu').val(data[4]);
            $('.modal-body #ghichu').val(data[5]);
    });
});

</script>
<script>

$(document).ready(function () {

    $('.addHPbtn').on('click', function() {
        
        $('#modalHPtoCTDT').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
      
    });
});

</script>
</body>
</html>

