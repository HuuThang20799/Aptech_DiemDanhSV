<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Quản lý người dùng </title>
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
<!MODAL-ADD --------------------------------------------------!>
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm người dùng  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Tên người dùng </label>
                    <input type="text" id="Name" class="form-control" placeholder="Nhập tên người dùng">
                </div>
                <div class="form-group">
                    <label> Tên tài khoản đăng nhập </label>
                    <input type="text" id="user" class="form-control" placeholder="Nhập tài khoản đăng nhập">
                </div>				
		<div class="form-group">
                    <label> Mật khẩu </label>
                    <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" id="password_renew" class="form-control" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label> Cấp độ </label><br>
                    <label><input type="radio" name="role" id ="role" value ='1'checked="checked">Người dùng</label>
                    <label><input type="radio" name="role" id ="role" value ='2'>Admin</label>
                </div>
            </div>
            <div class="alert alert-danger d-none">
            </div>
            <div class="alert alert-success d-none">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" id="register-btn" class="btn btn-primary">Thêm</button>
            </div>
    </div>
  </div>
</div>
<!MODAL-EDIT------------------------------------------------------------------!>
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa người dùng </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                <input type="hidden" name="update_id" id="update_id">
                <div class="form-group">
                    <label> Tên người dùng </label>
                    <input type="text" id="NameEdit" class="form-control" placeholder="Nhập tên người dùng"required="">
                </div>
                <div class="form-group">
                    <label> Tên tài khoản đăng nhập </label>
                    <input type="text" id="user" class="form-control" placeholder="Nhập tài khoản đăng nhập"readonly="">
                </div>				
		<div class="form-group">
                    <label> Mật khẩu </label>
                    <input type="password" id="password_edit"class="form-control" placeholder="Nhập mật khẩu"required="">
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" id="password_edit_renew" class="form-control" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <label> Cấp độ </label><br>
                    <label><input type="radio" name="role" id ="role" value ='1'checked="checked">Người dùng</label>
                    <label><input type="radio" name="role" id ="role" value ='2'>Admin</label>
                </div>
            </div>
            <div class="alert alert-danger d-none">
            </div>
            <div class="alert alert-success d-none">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" id="edituser-btn" class="btn btn-primary">Chỉnh sửa</button>
            </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2> Quản lý người dùng </h2>
        </div>    
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary addUser">
                    Thêm người dùng
                </button>
            </div>
        </div>
		<?php 
			if (count($data)>0){
		?>
        <div class="card">
            <div class="card-body">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style = "display:none"></th>
                            <th style="width:3%">STT</th>
                            <th style="width:15%" data-orderable="false">Tên người dùng</th>
                            <th style="text-align:center" style="width:15%">Tên tài khoản đăng nhập </th>
                            <th style="width:13%"data-orderable="false"style="text-align:center">Trạng thái</th>
                            <th style="width:10%">Cấp độ</th>
                            <th style="text-align:center" style="width:12%">Lần đăng nhập gần nhất</th>
                            <th style="text-align:center"style="width:13%" data-orderable="false">Hành động</th>
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
                            <td style="text-align:center"><?php echo $item['Name']?></td> 
                            <td style="text-align:center"><?php echo $item['username'];?></td>                           
                            <td style="text-align:center">
                            <?php 
                                    if ($item['status']==1)
                                    {?>
                            <a class="fa fa-check" aria-hidden="true" style="color:green" href ="index.php?c=user&m=change&id=<?php echo $item['id'];?>&status=<?php echo $item['status'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>
                            <?php 
                                    }?>
                            <?php 
                                    if ($item['status']==0){?>
                            <a class="fa fa-minus-circle" aria-hidden="true" style="color:red" href ="index.php?c=user&m=change&id=<?php echo $item['id'];?>&status=<?php echo $item['status'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>

                            <?php 
                                    }?>
                            </td>                                                                                                           
                            <td style="text-align:center">
                            <?php 
                                 if ($item['role']==1)
                            {?>
                            <a>User</a>
                            <?php 
                                    }?>
                            <?php 
                                    if ($item['role']==2){?>
                                <a>Admin</a>

                            <?php 
                                    }?>                            
                            </td>
                            <td style="text-align:center"><?php if ($item['tgian'] == NULL){
                            echo("Tài khoản chưa sử dụng hệ thống");                             
                            }
                            else {
                                $test1=$item['tgian']['date'];
                                echo date('d/m/Y H:i:s',strtotime($test1));
                                //echo $item['tgian']['date']->format('d/m/Y H:i:s');
                            }?></td>  
                            <td style="text-align:center">
                            <a type="button" href ="#" class=" fa fa-pencil editbtn"></a>
                            <a class="fa fa-trash" href ="index.php?c=user&m=delete&id=<?php echo $item['id'];?>"onclick ="return confirm('Bạn có chắc chắn muốn xóa')"></a>
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
        $('#modalEditUser').modal('show'); 
        $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#update_id').val(data[0]);
            $('.modal-body #user').val(data[3]);
            $('.modal-body #NameEdit').val(data[2]);
    });
});

</script>
<script>

$(document).ready(function () {
    $('.addUser').on('click', function() {        
        $('#modalAddUser').modal('show');     
    });
});
</script>
<script language="javascript">
            $(document).ready(function(){
                // Khi người dùng click Đăng ký
                $('#register-btn').click(function(){
                    // Lấy dữ liệu
                    var data = {
                        username        : $('#user').val(),
                        password        : $('#password').val(),
                        password_renew  : $('#password_renew').val(),
                        Name            : $('#Name').val(),
                        role            : $('input[name=role]:checked').val()
                    }
                    // Gửi ajax
                    $.ajax({
                        type : "post",
                        dataType : "JSON",
                        url : "add.php",
                        data : data,
                        success : function(result)
                        {
                            // Có lỗi, tức là key error = 1
                            if (result.hasOwnProperty('error') && result.error == '1'){
                                var html = '';

                                // Lặp qua các key và xử lý nối lỗi
                                $.each(result, function(key, item){
                                    // Tránh key error ra vì nó là key thông báo trạng thái
                                    if (key != 'error'){ 
                                        html += '<li>'+item+'</li>';
                                    }
                                });
                                $('.alert-danger').html(html).removeClass('d-none');
                                $('.alert-success').addClass('d-none');
                            }
                            else{ // Thành công
                                $('.alert-success').html('Thêm người dùng thành công!').removeClass('d-none');
                                $('.alert-danger').addClass('d-none');

                                // 2 giay sau sẽ tắt popup
                                setTimeout(function(){
                                    $('#modalAddUser').modal('hide');
                                    // Ẩn thông báo lỗi
                                    $('.alert-danger').addClass('d-none');
                                    $('.alert-success').addClass('d-none');
                                }, 2000);
                                location.reload();
                            }
                        }
                    });
                });
            });
</script>
<script language="javascript">
            $(document).ready(function(){
                // Khi người dùng click Đăng ký
                $('#edituser-btn').click(function(){
                    // Lấy dữ liệu
                    var data = {
                        id              : $('#update_id').val(),
                        username        : $('#user').val(),
                        password        : $('#password_edit').val(),
                        password_renew  : $('#password_edit_renew').val(),
                        Name            : $('#NameEdit').val(),
                        role            : $('input[name=role]:checked').val()
                    }
                    // Gửi ajax
                    $.ajax({
                        type : "post",
                        dataType : "JSON",
                        url : "edituser.php",
                        data : data,
                        success : function(result)
                        {
                            // Có lỗi, tức là key error = 1
                            if (result.hasOwnProperty('error') && result.error == '1'){
                                var html = '';

                                // Lặp qua các key và xử lý nối lỗi
                                $.each(result, function(key, item){
                                    // Tránh key error ra vì nó là key thông báo trạng thái
                                    if (key != 'error'){ 
                                        html += '<li>'+item+'</li>';
                                    }
                                });
                                $('.alert-danger').html(html).removeClass('d-none');
                                $('.alert-success').addClass('d-none');
                            }
                            else{ // Thành công
                                $('.alert-success').html('Sửa người dùng thành công!').removeClass('d-none');
                                $('.alert-danger').addClass('d-none');

                                // 2 giay sau sẽ tắt popup
                                setTimeout(function(){
                                    $('#modalEditUser').modal('hide');
                                    // Ẩn thông báo lỗi
                                    $('.alert-danger').addClass('d-none');
                                    $('.alert-success').addClass('d-none');
                                }, 2000);
                                location.reload();
                            }
                        }
                    });
                });
            });
</script>
</body>
</html>

