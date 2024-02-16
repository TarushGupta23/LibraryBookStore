<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="./style/books.css">
</head>
<?php include './partials/connection.php'; ?>
<?php
    if ($_POST["yearFrom"] != "" && $_POST["yearTo"] != "") {
        $query = "Select * from books where periodFrom >= " . $_POST['yearFrom'] . " and periodTo <= " . $_POST['yearTo'];
    } else if ($_POST["yearBetween"] != "") {
        $query = 'Select * from books where periodTo >= ' . $_POST['yearBetween'] . " and periodFrom <= " . $_POST['yearBetween'];
    } else if ($_POST["yearFrom"] != "") {
        $query = "Select * from books where periodFrom >= " . $_POST['yearFrom'];
    } else if ($_POST["yearTo"] != "") {
        $query = "Select * from books where periodTo <= " . $_POST['yearTo'];
    } else {
        $query = "select * from books where 1";
    }
    if (isset($_POST['subjects'])) {
        $selectedSubjects = $_POST['subjects'];
        $condition = "Subject IN ('" . implode("', '", $selectedSubjects) . "')";
    } else {
        $condition = "1";
    }
    $queryFinal = $query . " and " . $condition;
    $result = $conn->query($queryFinal);
    if (isset($_POST['subjNameFind']) && $_POST['subjNameFind'] != "") {
        $subjQuery = "select distinct subject from books where subject LIKE '%" . $_POST['subjNameFind'] . "%' ORDER BY subject ASC";
    } else {
        $subjQuery = "select distinct subject from books ORDER BY subject ASC";
    }
    $resultSubjList = $conn->query($subjQuery);
    $resultSubjList2 = $conn->query($subjQuery);
?>
<body>
    <div class="flex-container">
        <form class="sidebar" action="./books.php" method="POST">
            <div class="sidebar-title">Filter by: <input type="submit" value="apply" name="filterSubmit" class="filter-submit"></div>
            <div class="sidebar-filter-item">
                <div class="filter-title">Period</div>
                <div class="year-wrap">
                    <input type="text" pattern="\d{4}" class="filter-year" name='yearFrom' placeholder="from" />
                    <input type="text" pattern="\d{4}" class="filter-year" name='yearBetween' placeholder="during" />
                    <input type="text" pattern="\d{4}" class="filter-year" name="yearTo" placeholder="to" />
                </div>
            </div>

            <div class="sidebar-filter-item">
                <div class="filter-title">Subject <img src="./res/arrowIcon.png" onClick="showHide('subject')" class="subject-detailBtn"></div>
                <div class="subj-form">
                    <input type="text" name="subjNameFind" placeholder="Search subject" class="subject-filter-search">
                    <input type="submit" class="subj-filter-submit" value="search">
                </div>
                <span style="display: none;">
                    <select id="subjects" name="subjects[]" multiple>
                    <?php $j = 0;?>
                    <?php while ($row = mysqli_fetch_assoc($resultSubjList2)) { ?>
                        <option value="<?php echo $row['subject'];?>" id="_<?= $j++?>"><?php echo $row['subject'];?></option>
                    <?php } ?>
                    </select>
                </span>

                <ul class="subject-items">
                <?php $i = 0;?>
                <?php while ($row = mysqli_fetch_assoc($resultSubjList)) { ?>
                    <li class="subject-item" id="<?= $i?>" onClick="subjFilterClick('<?= $i++ ?>')">
                        <?php echo $row['subject'];?>
                    </li>
                <?php } ?>
                </ul>
                
            </div>

            <div class="sidebar-filter-item">
                <div class="filter-title">Publisher <img src="./res/arrowIcon.png" onClick="showHide('publisher')" class="publisher-detailBtn"></div>
                <div class="subj-form">
                    <input type="text" name="publisherNameFind" placeholder="Search subject" class="subject-filter-search">
                    <input type="submit" class="subj-filter-submit" value="search">
                </div>
                <span style="display: none;">
                    <select id="subjects" name="publishers[]" multiple>
                    <?php $j = 0;?>
                    <?php while ($row = mysqli_fetch_assoc($resultSubjList2)) { ?>
                        <option value="<?php echo $row['subject'];?>" id="_<?= $j++?>"><?php echo $row['subject'];?></option>
                    <?php } ?>
                    </select>
                </span>

                <ul class="subject-items">
                <?php $i = 0;?>
                <?php while ($row = mysqli_fetch_assoc($resultSubjList)) { ?>
                    <li class="subject-item" id="<?= $i?>" onClick="subjFilterClick('<?= $i++ ?>')">
                        <?php echo $row['subject'];?>
                    </li>
                <?php } ?>
                </ul>
                
            </div>
        </form>


        <div class="main-container">

            <div class="search-section">
                <span class="search-wrap">
                    <div class="search-bar">
                        <span class="search-icon"><img src="./res/searchIcon.png" alt=""></span>
                        <input type="text" class="searchbar-input" name="search-name" placeholder="Search for book title"/>
                    </div>
                    <!-- <div class="search-type">
                        <span class="search-type-title">Search by:</span>
                        <ul class="search-type-item">
                            <li class="search-type-selected">Title</li>
                            <li>Subject</li>
                            <li>Publisher</li>
                        </ul>
                    </div> -->
                </span>
            </div>
            <div class="tableWrap">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th> <th>Subject</th> <th>Publisher</th> <th>Period</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['title'];?></td> 
                                <td><?php echo $row['Subject'];?></td> 
                                <td><?php echo $row['Publisher'];?></td> 
                                <td><?php echo $row['periodFrom'];?>-<?php echo $row['periodTo'];?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
<script>
    function subjFilterClick(id) {
        var item = document.getElementById(id);
        var option =document.getElementById("_" + id)

        if (item.classList.contains('selected-subject')) {
            item.classList.remove('selected-subject');
            option.selected = false;
        } else {
            item.classList.add('selected-subject');
            option.selected = true;
        }
    }
    function showHide(id) {
        var btn = document.getElementsByClassName(id+"-detailBtn")[0];
        var detailDiv = document.getElementsByClassName(id+ "-items")[0];
        if (detailDiv.style.display === 'none' || detailDiv.style.display === '') {
            btn.style.transform = 'rotate(180deg)';
            detailDiv.style.display = 'flex';
        } else {
            btn.style.transform = 'rotate(0deg)';
            detailDiv.style.display = 'none';
        }
    }
</script>
</html>