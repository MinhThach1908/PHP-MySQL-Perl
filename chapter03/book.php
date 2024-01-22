<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta charset="utf-8">
      <title></title>
  </head>
  <body>
  <?php
    $myDB = new mysqli('localhost','root','','bookstore');
    if ($myDB->connect_error) {
        die('Connect ErrorException: '. $myDB->connect_errno . ' ' . $myDB->connect_error);
    } else {
        echo "Connect Successfully";
    }
    $sql = "SELECT * FROM `books` WHERE `available` = 1 ORDER BY `title`";
    $result = $myDB -> query($sql);
    if ($result -> fetch_assoc()) {
        echo  '<br>load done';
    } else {
        echo '<br>load error';
    }
  ?>
  <h1>These books are currently available</h1>
  <table class="table table-striped">
      <thead>
         <tr>
           <th scope="col">BookID</th>
           <th scope="col">Title</th>
           <th scope="col">ISBN</th>
           <th scope="col">Publish Year</th>
         </tr>
      </thead>
   <tbody>
     <tr>
         <th scope="row">1</th>
       <th>Mark</th>
       <th>Otto</th>
       <th>@mdo</th>
     </tr>
     <?php
        while ($row = $result -> fetch_assoc()) {
          echo "<tr>";
          echo "<th scope='row'>";
          echo $row['bookid'];
          echo "</th>";
          echo "<td>";
          echo $row['title'];
          echo "</td>";
          echo "<td>";
          echo $row['ISBN'];
          echo "</td>";
          echo "<td>";
          echo $row['pub_year'];
          echo "</td>";
          echo "<td>";
        }
     ?>
   </tbody>
  </table>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965Dz00rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ60W/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>