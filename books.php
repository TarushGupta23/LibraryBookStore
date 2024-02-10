<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/books.css">
</head>
<body>
    <div class="flex-container">
        <div class="sidebar">
            <div class="sidebar-title">Filter by: </div>
            <div class="sidebar-filter-item">
                <div class="filter-title">Period</div>
                <div class="year-wrap">
                    <input type="text" pattern="d{4}" class="filter-year" name='yearFrom' placeholder="from" />
                    <input type="text" pattern="d{4}" class="filter-year" name='yearbetween' placeholder="around" />
                    <input type="text" pattern="d{4}" class="filter-year" name="yearTo" placeholder="to" />
                </div>
            </div>
            <div class="sidebar-filter-item">
                <div class="filter-title">Subject</div>
                <ul class="subject-items">
                    <li class="subject-item selected-subject">Science</li>
                    <li class="subject-item">Cyber Security</li>
                    <li class="subject-item">IT</li>
                    <li class="subject-item">Data Analysis and Algorithms</li>
                    <li class="subject-item">Digital Catalog</li>
                    <li class="subject-item selected-subject">Library Science</li>
                    <li class="subject-item">Mathematics</li>
                    <li class="subject-item">OOPs</li>
                </ul>
                
            </div>
        </div>


        <div class="main-container">

            <div class="search-section">
                <span class="search-wrap">
                    <div class="search-bar">
                        <span class="search-icon"><img src="./res/searchIcon.png" alt=""></span>
                        <input type="text" class="searchbar-input" name="search-name">
                    </div>
                    <div class="search-type">
                        <span class="search-type-title">Search by:</span>
                        <ul class="search-type-item">
                            <li class="search-type-selected">Title</li>
                            <li>Subject</li>
                            <li>Publisher</li>
                        </ul>
                    </div>
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

        </div>
    </div>
</body>
</html>