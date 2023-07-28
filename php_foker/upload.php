<?php
class ImageUpload {
    private $uploadDir;
    private $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
    private $fileName;
    
    public function __construct($uploadDir) {
        $this->uploadDir = $uploadDir;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function checkFile() {
        if (!isset($_FILES['fileUpload']['name']) || empty($_FILES['fileUpload']['name'])) {
            return "Vui lòng chọn một file để upload.";
        }

        $this->fileName = basename($_FILES['fileUpload']['name']);
        $fileTmpPath = $_FILES['fileUpload']['tmp_name'];

        $extension = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            return "File không hợp lệ.";
        }

        if (exif_imagetype($fileTmpPath) === false) {
            return "File không hợp lệ.";
        }

        return null; 
    }

    public function moveFile() {
        $destination = $this->uploadDir . '/' . $this->fileName;
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $destination)) {
            return true; 
        } else {
            return false; 
        }
    }
}

if (isset($_FILES['fileUpload'])) {
    $uploadDir = './upload'; 
    $imageUploader = new ImageUpload($uploadDir);

    $checkResult = $imageUploader->checkFile();
    if ($checkResult !== null) {
        echo $checkResult;
    } else {
        if ($imageUploader->moveFile()) {
            echo "di chuyển file thành công.";
            echo '<br>Dường dẫn: ' . $uploadDir . '/' . $imageUploader->getFileName();
            echo '<br>Loại file: ' . $_FILES['fileUpload']['type'];
            echo '<br>Dung lượng: ' . ((int)$_FILES['fileUpload']['size'] / 1024) . 'KB';
        } else {
            echo "Upload file thất bại.";
        }
    }
}
?>