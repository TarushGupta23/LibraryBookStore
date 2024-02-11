<link rel="stylesheet" href="./style/adminPanel.css">
<body>
<div class="wrap">
    <button id="logoutBtn">Logout</button>
        <form action="">
            <h2>Add Excel Data</h2>
            <input type="file" id="addDataFile" name="addDataFile" accept=".xls, .xlsx">
            <input type="submit" value="upload" class="submitBtn">
        </form>
        
        <br>
        <form action="">
            <h2>Remove Excel Data</h2>
            <input type="file" id="removeDataFile" name="removeDataFile" accept=".xls, .xlsx">
            <input type="submit" value="upload" class="submitBtn">
        </form>
        <br>
        <form action="">
            <h2>Extract Data</h2>
            <input type="submit" value="extract" class="submitBtn">
        </form>
        <br>
        <form action="">
            <h2>Execute Query</h2>
            <input type="text" id="queryInput" name="queryInput">
            <input type="submit" value="execute" class="submitBtn">

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