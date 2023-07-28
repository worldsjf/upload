<!DOCTYPE html>
<html>
<head>
    <title>Upload File PHP</title>
</head>
<body>
    <h1>Tải lên tập tin hình ảnh</h1>
    <form action="./upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileUpload" id="image">
        <input type="submit" name="submit" value="Tải lên">
    </form>
</body>
</html>
