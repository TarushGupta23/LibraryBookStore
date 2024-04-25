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

// --------------------------------------------------------------------------------------------------------
    if (isset($_POST['subjNameFind']) && $_POST['subjNameFind'] != "") {
        $subjQuery = "select distinct subject from books where subject LIKE '%" . $_POST['subjNameFind'] . "%' ORDER BY subject ASC";
        $subjNameCondition = "subject LIKE '%" . $_POST['subjNameFind'] . "%'";
    } else {
        $subjQuery = "select distinct subject from books ORDER BY subject ASC";
        $subjNameCondition = "1";
    }
    $resultSubjList = $conn->query($subjQuery);
    $resultSubjList2 = $conn->query($subjQuery);

    if (isset($_POST['pubNameFind']) && $_POST['pubNameFind'] != "") {
        $pubQuery = "select distinct Publisher from books where Publisher LIKE '%" . $_POST['pubNameFind'] . "%' ORDER BY Publisher ASC";
    } else {
        $pubQuery = "select distinct Publisher from books ORDER BY Publisher ASC";
    }
    $resultPubList = $conn->query($pubQuery);
    $resultPubList2 = $conn->query($pubQuery);
// --------------------------------------------------------------------------------------------------------
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

    if (isset($_POST['publishers'])) {
        $selectedPublishers = $_POST['publishers'];
        $condition2 = "Publisher IN ('" . implode("', '", $selectedPublishers) . "')";
    } else {
        $condition2 = "1";
    }

    if (isset($_POST['searchName']) && $_POST['searchName'] != "") {
        $nameCondition = "title LIKE '%".$_POST['searchName']."%'";
    } else {
        $nameCondition = "1";
    }
    $queryFinal = $query . " and " . $condition . " and " . $condition2 . " and " . $nameCondition . " and " . $subjNameCondition;
    $result = $conn->query($queryFinal);


?>
<body>
    <div class="flex-container">
        <form class="sidebar" action="./books.php" method="POST">
            <div class="sidebar-title">Filter by: 
                <div class="filter-btn-container">
                    <input type="submit" value="apply" name="filterSubmit" class="filter-submit">
                    <input type="submit" value="Clear" name="filterSubmit" class="filter-submit"> <!-- they both do same thing but for ease of user to reset, clear button is added -->
                </div>
            </div>

            <div class="sidebar-filter-item">
                <div class="filter-title">Title</div>
                <input type="text" class="searchbar-input" name="searchName" placeholder="Search for book title"/>
            </div>

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
                <div class="pub-form">
                    <input type="text" name="pubNameFind" placeholder="Search Publisher" class="publisher-filter-search">
                    <input type="submit" class="pub-filter-submit" value="search">
                </div>
                <span style="display: none;">
                    <select id="publishers" name="publishers[]" multiple>
                    <?php //$j = 0;?>
                    <?php while ($row = mysqli_fetch_assoc($resultPubList2)) { ?>
                        <option value="<?php echo $row['Publisher'];?>" id="_<?= $j++?>"><?php echo $row['Publisher'];?></option>
                    <?php } ?>
                    </select>
                </span>

                <ul class="publisher-items">
                <?php // $i = 0;?>
                <?php while ($row = mysqli_fetch_assoc($resultPubList)) { ?>
                    <li class="subject-item" id="<?= $i?>" onClick="subjFilterClick('<?= $i++ ?>')">
                        <?php echo $row['Publisher'];?>
                    </li>
                <?php } ?>
                </ul>
                
            </div>
        </form>


        <div class="main-container">

            <div class="search-section">
                <span class="search-wrap">
                    <!-- This was the search by title menu which was supposed to be on top as navbar but i placed it at side now -->
                    <!-- <div class="search-bar">
                        <span class="search-icon"><img src="./res/searchIcon.png" alt=""></span>
                            <input type="text" class="searchbar-input" name="searchName" placeholder="Search for book title"/>
                    </div> -->
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
                    <table id="clickableTable">
                        <thead>
                            <tr>
                                <th>Title</th> <th>Subject</th> <th>Publisher</th> <th>Period</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr data-href="<?= $row['link']?>">
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
    document.addEventListener("DOMContentLoaded", function() {
        var table = document.getElementById("clickableTable");
        var rows = table.getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            rows[i].addEventListener("click", function() {
                var link = this.getAttribute("data-href");
                if (link) {
                    window.location.href = link;
                }
            });
        }
    });
</script>
</html>