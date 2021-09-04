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
    
<!-- #################################################################################################### -->
<div class="container">
    <div class="jumbotron">
        <div class="card">
            <center><h2> Xét tốt nghiệp </h2></center>
        </div>    
        <div class="card">
            <div class="card-body">
            <center><form action ="index.php" method ="GET">
            <input type="hidden" name="c" value ="totnghiep">
            <input type="hidden" name="m" value ="search">
            <?php
                    if (!empty($info)){
                        foreach ($info as $key => $item){	
            ?>
            <table class="TableContainer">
            <td> Nhập MSSV hoặc tên: </td>
            <td><input type = "text" name = "keyword" id = "keyword" size="55" placeholder="Nhập MSSV hoặc tên"autocomplete="off" /></td>
            <input type="hidden" name="keyword1" value ="<?php echo $item['SV_MSSV']; ?>">
            <tr>
                <td>Họ và Tên: </td>
                <td><input type = "text" size="55" id = "name"value = "<?php echo $item['SV_HOTEN']; ?>" readonly /></td>
            </tr>
            <tr>
                <td class="cssTdLeft">MSSV: </td>
                <td class="cssTdRight"><input type = "text" size="55"id = "mssv"value = "<?php echo $item['SV_MSSV']; ?>" readonly /></td>
            </tr>
              <tr>
                <td class="cssTdLeft">Portal ID: </td>
                <td class="cssTdRight"><input type = "text" size="55"id = "portalid"value = "<?php echo $item['SV_PORTALID']; ?>" readonly /></td>
            </tr>
            <tr>
                <td class="cssTdLeft">Khóa: </td>
                <td class="cssTdRight"><input type = "text" size="55"id = "khoa"value = "<?php echo $item['KHOA_TEN']; ?>"/></td>
            </tr>
            <tr>
                <td class="cssTdLeft">Lớp: </td>
                <td class="cssTdRight"><input type = "text" size="55"id = "lop" value = "<?php echo $item['LOP_TEN']; ?>" readonly /></td>
            </tr>
            <tr>
                <td class="cssTdLeft">Môn học: </td>
                <td class="cssTdRight"><select name="tenMH" class="form-control">
                    <option value="">Tất cả</option>
                        <?php
                            if (!empty($monhoc)){
				foreach ($monhoc as $key => $item){
                            ?>
                    <option value="<?php echo $item['MH_ID']?>"><?php echo $item['MH_TEN']?></option>                
			<?php
                            }
			}
			?>
		</select>
            </td>
            </tr>
            <tr>
                <td class="cssTdLeft">CTDT: </td>
                <td class="cssTdRight"><select name="tenCTDT"id="tenCTDT"  class="form-control">                    
                    <?php 
                        if (isset($_GET['tenCTDT']) && $_GET['tenCTDT'] !=''){
                            require_once "model/tot_nghiep.php";
                            $idCTDT = $_GET['tenCTDT'];
                            $u = new tot_nghiep();
                            $tenCTDT = $u->getTenMHbyID($idCTDT);
                    ?>
                    <option value="<?php echo $_GET['tenCTDT'];?>"><?php echo $tenCTDT;?></option>
                    <option value="">Tất cả</option>
                    <?php  
                        }
                        else {
                            ?>
                        <option value="">Tất cả</option>
                        <?php
                         }
                            if (!empty($ctdt)){
                                foreach ($ctdt as $key => $item1){
                    ?>
                    <option value="<?php echo $item1['id']?>"><?php echo $item1['ten']?></option>                
			<?php
                                }
                            }
			?>
		</select>
		</td>
            </tr>
            <tr>
                <td class="cssTdLeft">Ẩn các môn học rớt: </td>
                <?php 
                    if (isset($_GET['checkbox'])){
                    ?>
                <td><input type="checkbox" name="checkbox" value ="on" checked></td>
                <?php  
                    }
                    else {
                        ?>
                <td><input type="checkbox" name="checkbox" value ="on"></td>
                    <?php
                     }
                    ?>
            </tr>
			</table>
                        <input type = "submit" value = "Tìm kiếm"/>
			<button type="button" onclick="ClearFields();">Làm mới</button>
            <?php
                        }
                    } else {
            ?>  
                        <a> Nhập MSSV hoặc tên :</a>
                        <input type = "text" name = "keyword" id = "keyword" size="55" placeholder="Nhập MSSV hoặc tên"autocomplete="off" />
                        <input type = "submit" value = "Tìm kiếm"/>
			<button type="button" onclick="ClearFields();">Làm mới</button>
                        <?php
                    }
                    ?>
			</form>
                        </center>
            </div>
        </div>
                        <div class="col-md-5" style="position: relative;margin-top: -20px;margin-left: 290px;">
                            <div class="list-group" id="show-list">
                            <!-- Here autocomplete list will be display -->
                            </div>
                        </div>
		<?php 
                    if (isset($data)){
			if (count($data)>0){
		?>
        <div class="card">
            <div class="card-body">
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style = "display:none"></th>
                            <th style="width:3%">STT</th>
                            <th style="width:35%" style="text-align:center">Tên môn học</th>							<th style="width:10%" data-orderable="false">Loại thi</th>
                            <th style="width:13%"data-orderable="false"style="text-align:center">Ngày thi</th>
                            <th style="width:12%">Điểm thi</th>                                                      
                            <th style="width:8%" data-orderable="false">Lần thi</th>
                            <th style="text-align:center">Kết quả</th> 
                            <th style="text-align:center">Ghi chú</th>
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
                            <td><?php echo $item['MH_TEN'];?></td>
                            <td style="text-align:center"><?php echo $item['LOAITHI_TEN'];?></td>	
                                <td><?php $test1=$item['KT_NGAY']['date'];
                                          echo date('d/m/Y H:i:s',strtotime($test1));?></td>
                                <td style="text-align:center"><?php echo $item['THI_DIEM'];?></td> 	
                                <td style="text-align:center"><?php echo $item['KT_LANTHI'];?></td> 							
                                <td style="text-align:center">
                                    <?php 
                                        if ($item['THI_KQ']==1)
                                    {?>
                                    <a class="fa fa-check" aria-hidden="true" style="color:green" href ="index.php?c=ctdt&m=change&id=<?php echo $item['id'];?>&tt=<?php echo $item['tt'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>
                                    <?php 
                                        }?>
                                    <?php 
                                         if ($item['THI_KQ']==0){?>
                                    <a class="fa fa-minus-circle" aria-hidden="true" style="color:red" href ="index.php?c=ctdt&m=change&id=<?php echo $item['id'];?>&tt=<?php echo $item['tt'];?>"onclick ="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái')"></a>
                                    <?php 
                                            }?>
                                    </td> 
                                    <td style="text-align:center"><?php echo $item['THI_GHICHU'];?></td> 
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
  // Send Search Text to the server
  $("#keyword").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "action.php",
        method: "get",
        data: {
          search: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#keyword").val($(this).text());
    $("#show-list").html("");
  });
});
</script>

<script>
	function ClearFields() {
	 document.getElementById("keyword").value = "";
         document.getElementById("name").value = "";
	 document.getElementById("mssv").value = "";
	 document.getElementById("portalid").value = "";
	 document.getElementById("khoa").value = "";
	 document.getElementById("lop").value = "";
         document.getElementById("tenCTDT").value = "";
}
</script>

</body>
</html>