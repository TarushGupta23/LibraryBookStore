<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header("Location: ./login.php");
    exit();
}

if (isset($_POST["logout"])) {
    unset($_POST['logout']);
    unset($_SESSION['admin']);
    header("Location: ./login.php");
    exit();
}


?>
<link rel="stylesheet" href="./style/adminPanel.css">
<body>
<div class="wrap">
    <form action="adminpanel.php" method="post">
        <button id="logoutBtn" type="submit" name="logout">Logout</button>
    </form>

    <form action="adminpanel.php" method="post">
        <h2>Add Excel Data</h2>
        <input type="file" id="addDataFile" name="addDataFile" accept=".xls, .xlsx" required>
        <input type="submit" value="upload" class="submitBtn" name="addExcel">
    </form>
    
    <br>
    <form action="adminpanel.php" method="post">
        <h2>Remove Excel Data</h2>
        <input type="file" id="removeDataFile" name="removeDataFile" accept=".xls, .xlsx" required>
        <input type="submit" value="upload" class="submitBtn" name="removeExcel">
    </form>
    <br>
    <form action="adminpanel.php" method="post">
        <h2>Extract Data</h2>
        <input type="submit" value="extract" class="submitBtn" name="extract">
    </form>
    <br>
    <form action="adminpanel.php" method="post">
        <h2>Execute Query</h2>
        <input type="text" id="queryInput" name="queryInput">
        <input type="submit" value="execute" class="submitBtn" name="exeQuery">

        <div class="tableWrap">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th> <th>Subject</th> <th>Publisher</th> <th>Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Library Website</td> <td>Library Science</td> <td>NIT Jalandhar</td> <td>2021-2024</td>
                        </tr>
                        <tr>
                            <td>Institution Repository</td> <td>Digital Library</td> <td>Dspace</td> <td>2021-2024</td>
                        </tr>
                        <tr>
                            <td>Library Catalog</td> <td>Library Catalog</td> <td>Koha Online Catalog</td> <td>2021-2024</td>
                        </tr>
                        <tr>
                            <td>Off-Campus</td> <td>Remote Access</td> <td>NIT Jalandhar</td> <td>2021-2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <br>
</div>


</body>