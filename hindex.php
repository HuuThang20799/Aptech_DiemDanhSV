<?php
session_start();
ob_start();
    if (!isset($_SESSION['user'])|| $_SESSION['user'] == null){
        header('Location:login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<div class="radius-01 grid_65 div-center" style="background:#fff; margin-top:10px;">
<table align="center" width="100%" border="0">
        <tr>
                <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                <tr height="52px">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>													
                                <tr height="74px">
                                    <td align="center" class="bordersv"> <img src="images/phanhe/qldiem.png" style="border:none; cursor:pointer;cursor:pointer" onClick="gotoQLDindex()" height="44" width="44"/> </td>
                                    <td align="center" class="bordersv"> <img src="images/phanhe/diemdanh.png" style="border:none; cursor:pointer;cursor:hand" onClick="gotoDiemDanhindex()" height="44" width="44"/> </td>
                                    <td align="center" class="bordersv"><img src="images/phanhe/chieusinh.png" style="border:none; cursor:pointer;cursor:hand" onClick="gotoChieuSinhindex()" height="44" width="44"/></td>
                                </tr>
                                <tr height="30">
                                    <td align="center" valign="top" class="textbold"> Quản lý điểm </td>
                                    <td align="center" valign="top" class="textbold"> Điểm danh  </td>
                                    <td align="center" valign="top" class="textbold"> Chiêu sinh </td>
                                </tr>												
                        </table>
                </td>
        </tr>
</table>
</div>
<form name="frmDuLieuQLD" action="index.php?c=ctdt" method="post">
</form>
<form name="frmDuLieuDiemDanh" action="DiemDanhSV/cindex.php" method="post">
</form>
<form name="frmDuLieuChieuSinh" action="sindex.php" method="post">
</form>
 <script>              
    function gotoQLDindex()
    {
        frmDuLieuQLD.submit();
    }
    function gotoDiemDanhindex()
    {
        frmDuLieuDiemDanh.submit();
    }
    function gotoChieuSinhindex()
    {
        frmDuLieuChieuSinh.submit();
    }
</script>
