<?php
//Kiểm tra thư mục tồn tại chưa có thì tạo mới
if(file_exists('data.txt'))
echo 'file tồn tại';
else
echo 'file không tồn tại';

//Kiểm tra file có cho phép ghi không
if(is_writable('data.txt'))
    echo 'Được phép ghi';
else
    echo 'không được phép ghi';

//Ghi file với nội dung: xin chào 
    $file = @fopen('data.txt', 'w');
    if (!$file)
        echo "Mở file không thành công";
    else {
        $data = 'xin chào';
        fwrite($file, $data);
    }
//Đóng file
$file = @fopen('data.txt', 'w');
if (!$file)
    echo "Mở file không thành công";
else {
    $data = 'xin chào';
    fwrite($file, $data);

    fclose($file);
}
//Xoá file
if(unlink('data.txt'))
    echo 'Thành công';
else
    echo 'Không thành công';
?>