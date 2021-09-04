<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Chi tiết chương trình đào tạo</title>
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
<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2> Chi tiết chương trình đào tạo </h2>
        </div>    

        <div class="card">
            <div class="card-body">
		<button type="button" class="btn btn-primary addHPbtn">
                    Thêm môn học
                </button>
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        </br>
                        <h2>Chương trình đào tạo ngành : <?php echo $_GET['ten']?></h2>
                        <tr>
                            <th style = "display:none"></th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên học phần</th>
                            <th scope="col">Thứ tự hiển thị</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($data as $key => $item){
                    ?>
                    <tr>
                    <td style = "display:none"data-id="<?php echo $item['id']; ?>"><?php echo $item['id']; ?></td>
                    <td> <?php echo $key +1 ?></td>                                                      
                    <td > <?php echo $item['ten_mh']; ?> </td> 
                    <td style="text-align:center"><div contentEditable='true' class='edit' id='ThuTuHienThi_<?php echo $item['id']; ?>'><?php echo $item['ThuTuHienThi']; ?> </td> 
                    <td style="text-align:center">
                    <a class="fa fa-trash" href ="index.php?c=monhoc&m=delete&id=<?php echo $item['id'];?>&id_ctdt=<?php echo $_GET['id']?>&ten=<?php echo $_GET['ten']?>"onclick ="return confirm('Bạn có chắc chắn muốn xóa')" ></a>
                    </td>
                    </tr>							
                    <?php  					
                        }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal ADD Hoc Phan -->
<div class="modal fade" id="modalHPtoCTDT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm môn học vào chương trình đào tạo </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form action="index.php?c=monhoc&m=create" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" id="id"value ="<?php echo $_GET['id']?>">
                    <input type="hidden" name="ten" id="ten"value ="<?php echo $_GET['ten']?>">
                    <label> Tên môn học</label>
                    <select name="tenMH" class="form-control">
                    <option value="">Tất cả</option>
                    <?php
                            foreach ($dataMonHoc as $key => $row){
                    ?>
                    <option value="<?php echo $row['MH_TEN']?>_____<?php echo $row['MH_ID']?>"><?php echo $row['MH_TEN']?></option>                
                    <?php
                            }
                    ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label> Thứ tự hiển thị </label>
                    <input type="number" name="thutu" class="form-control"placeholder="Nhập thứ tự hiển thị"required="">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" name="insertdataHP" class="btn btn-primary">Thêm</button>
            </div>
        </form>

    </div>
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
            [ 25, 50, -1],
            [ 25, 50, "All"]
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

    $('.addHPbtn').on('click', function() {
        $('#modalHPtoCTDT').modal('show');		      
    });
});

</script>
<script>
$(document).ready(function(){
    
    // Add Class
    $('.edit').click(function(){
        $(this).addClass('editMode');
    
    });

    // Save data
    $(".edit").focusout(function(){
        $(this).removeClass("editMode");
 
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];

        var value = $(this).text();
     
        $.ajax({
            url: 'index.php?c=monhoc&m=update',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                if(response == 1){ 
                    console.log('Save successfully'); 
                    
                }else{ 
                    console.log("Not saved."); 
                    
                }             
            }
        });
                
    });

});

</script>
</body>
</html>