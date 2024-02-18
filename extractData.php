<?php include './partials/connection.php'; ?>
<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=library.xls");
$query = "Select * from books";
$result = $conn->query($query);
?>
<table border="1" style="width: 100%;">
    <thead>
        <tr>
            <th>Title</th> <th>Period</th> <th>Subject</th> <th>Publisher</th>  <th>Link</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['periodFrom']; ?>-<?php echo $row['periodTo']; ?></td>
            <td><?php echo $row['Subject']; ?></td> 
            <td><?php echo $row['Publisher']; ?></td> 
            <td><?php echo $row['link']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>