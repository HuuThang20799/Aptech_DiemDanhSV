1. Tạo thư mục (ví dụ"projects") nằm trong thư mục "htdocs" tại đường dẫn "C:\xampp\htdocs"

2. Giải nén tập tin QuanLyCTDT.rar đã được tải về, bên trong tập tin nén bao gồm:
	+ Thư mục "QuanLyCTDT": Chứa toàn bộ mã nguồn

	2.1 Copy toàn bộ nội dung trong thư mục QuanLyCTDT vào thư mục projects vừa tạo ở bước 1.
	
3.Cấu hình kết nối database SQL Server
	Truy cập vào tệp Database.php tại thư mục config trong projects. Cấu hình lại các thông số $serverName, $Database, $user, $password
	Trong đó:
	$serverName là tên SQL server
	$Database là tên Database cần kết nối
	$user, $password là tài khoản và mật khẩu kết nối SQL server.



*Lưu ý: Nếu xuất hiện lỗi ứng dụng không thể gửi yêu cầu tương tác với SQLServer. 

Bước 1: Vào thư mục extension trong project copy 2 tệp
php_pdo_sqlsrv_56_ts.dll và php_sqlsrv_56_ts.dll vào thư mục C:\xampp\php\ext

Bước 2: Mở tệp php.ini ở ví trị C:\xampp\php\php.ini.
Thêm 2 dòng:
extension=php_pdo_sqlsrv_56_ts.dll
extension=php_sqlsrv_56_ts.dll
Lưu lại và khởi động lại XAMPP để các thay đổi có hiệu lực.