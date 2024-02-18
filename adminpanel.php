<?php 
include './partials/connection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
?>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ./login.php");
    exit();
}

if (isset($_POST["logout"])) {
    unset($_POST['logout']);
    unset($_SESSION['admin']);
    header("Location: ./login.php");
    exit();
}

if(isset($_POST['addExcel'])) {
    $inputFileNamePath = $_FILES['addDataFile']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
    $data = $spreadsheet->getActiveSheet()->toArray();

    foreach($data as $row) {
        $title = $row['1'];
        $period = $row['2'];
        $subject = $row['3'];
        $publisher = $row['4'];
        $link = $row['5'];
        $dateArray = explode('-', $period);
        $periodFrom = $dateArray[0];
        $periodTo = $dateArray[1];
        $queryCheck = "select publisher from books where title='$title' and publisher='$publisher'";
        $result = $conn->query($queryCheck);
        if ($title != "") {
            if ($result->num_rows != 0) {
                $queryDelete = "DELETE FROM books WHERE title = '$title' AND publisher = '$publisher'";
                $conn->query($queryDelete);
            }
            $query = "insert into books values ('$title',  '$periodFrom', '$periodTo', '$subject', '$publisher', '$link')";
            $conn->query($query);
        }
    }
    unset($_POST['addExcel']);
}

if(isset($_POST['removeExcel'])) {
    $inputFileNamePath = $_FILES['removeDataFile']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
    $data = $spreadsheet->getActiveSheet()->toArray();

    foreach($data as $row) {
        $title = $row['1'];
        $period = $row['2'];
        $subject = $row['3'];
        $publisher = $row['4'];
        $link = $row['5'];
        $dateArray = explode('-', $period);
        $periodFrom = $dateArray[0];
        $periodTo = $dateArray[1];
        $queryCheck = "select publisher from books where title='$title' and publisher='$publisher'";
        $result = $conn->query($queryCheck);
        if ($title != "") {
            if ($result->num_rows != 0) {
                $queryDelete = "DELETE FROM books WHERE title = '$title' AND publisher = '$publisher'";
                $conn->query($queryDelete);
            }
            $query = "insert into books values ('$title',  '$periodFrom', '$periodTo', '$subject', '$publisher', '$link')";
            $conn->query($query);
        }
    }
    unset($_POST['removeExcel']);
}

if (isset($_POST['exeQuery'])) {
    $queryExec = $_POST["queryInput"];
    try {
        $resultExecution = $conn->query($queryExec);
    } catch (Exception $err) {
        $msg = "Error in query";
        unset($resultExecution);
    }

    unset($_POST['exeQuery']);
}
?>

<link rel="stylesheet" href="./style/adminPanel.css">
<body>
<div class="wrap">
    <form action="adminpanel.php" method="post">
        <button id="logoutBtn" type="submit" name="logout">Logout</button>
    </form>

    <form action="adminpanel.php" method="post" enctype="multipart/form-data">
        <h2>Add Excel Data</h2>
        <input type="file" id="addDataFile" name="addDataFile" accept=".xls, .xlsx" required>
        <input type="submit" value="upload" class="submitBtn" name="addExcel">
    </form>
    
    <br>
    <form action="adminpanel.php" method="post" enctype="multipart/form-data">
        <h2>Remove Excel Data</h2>
        <input type="file" id="removeDataFile" name="removeDataFile" accept=".xls, .xlsx" required>
        <input type="submit" value="upload" class="submitBtn" name="removeExcel">
    </form>
    <br>
    <form action="extractData.php" method="post">
        <h2>Extract Data</h2>
        <input type="submit" value="extract" class="submitBtn" name="extract">
    </form>
    <br>
    <form action="adminpanel.php" method="post">
        <h2>Execute Query</h2>
        <input type="text" id="queryInput" name="queryInput">
        <input type="submit" value="execute" class="submitBtn" name="exeQuery">

        <div class="tableWrap">
            <?php if (isset($msg)) {
                echo $msg;
            } else if (isset($resultExecution) && $resultExecution->num_rows > 0) { ?>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th> <th>Subject</th> <th>Publisher</th> <th>Period</th> <th>link</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultExecution)) { ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['Subject']; ?></td> 
                            <td><?php echo $row['Publisher']; ?></td> 
                            <td><?php echo $row['periodFrom']; ?>-<?php echo $row['periodTo']; ?></td>
                            <td><?php echo $row['link']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
    </form>
    <br>
</div>


</body>