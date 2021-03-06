<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</head>
<body>

<!-- Image and text -->

<body>



<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-warning" href="#">Pottr</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav text-warning">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown text-light">
          <a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Most recent scans</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <?php 
                      /// Database access
                      $db = new SQLite3('../pees.db');

                      /// Count number of rows from Virus Total table, check if empty, print count
                      $rescount = $db->query("SELECT COUNT(*) as count FROM peesreport GROUP BY id ORDER BY currenttime DESC");
                      if(!empty($rescount)){
                        $sqlcountarrayvt = $rescount->fetchArray();
                        $numRowsvt = $sqlcountarrayvt['count'];
                        //echo "Virus Total results: " . $numRowsvt;
                        //echo 'Virus total results <span class="badge bg-secondary">' . $numRowsvt . '</span>';
                        //echo '<a class="nav-link text-light" aria-current="page" href="#">'. 'Virus Total: ' . $numRowsvt .'</a></li>';
                        echo '<li><a class="dropdown-item" href="#">Virus Total: ' . $numRowsvt . '</a></li>';

                      }
                      echo '<li class="nav-item">';
                      $rescount2 = $db->query("SELECT COUNT(*) as count FROM shodanreport");
                      if(!empty($rescount2)){
                        // Variable is not empty and is set
                        $sqlcountarrayshodan = $rescount2->fetchArray();
                        $numRowsshodan = $sqlcountarrayshodan['count'];
                        echo '<li><a class="dropdown-item" href="#">Shodan: ' . $numRowsshodan . '</a></li>';

                        //echo '<a class="nav-link text-light" aria-current="page" href="#">'. 'Shodan: ' . $numRowsshodan .'</a>';
                      }

                      ?>
                 <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item disabled" href="#">Live CVE updates (coming soon)</a></li>
              

            </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="#">About</a>
        </li>

        
       
      </ul>
    </div>
  </div>
</nav>

<h3>
Pottr:<small class="container-fluid text-muted">Real time threats</small>
</h3>
<img width="50px" class="rounded mx-auto" src="svg/honey.svg"><h1>COMB beta</h1>
<?php 
/// Database access
$db = new SQLite3('../pees.db');



$res = $db->query('SELECT * FROM peesreport GROUP BY id ORDER BY currenttime DESC');
$res2 = $db->query('SELECT * FROM shodanreport');



$counter = 0;
//$max = 100;
  //echo $row2['server'];

while ($row2 = $res2->fetchArray($counter < $numRowsshodan)) { 



while ($row = $res->fetchArray($counter < $numRowsvt)) {
    
    $counter++;
    $bitdif = json_decode($row['BitDefenderresult']);
    $kasdif = json_decode($row['Kasperskyresult']);
    $spamdif = json_decode($row['Spamhausresult']);

    

    

    echo "<br>";
    echo '<div class="card bg-dark text-white container-md">';
    echo '<div class="card-header bg-dark text-white">';
    echo "<h3>" . "<kbd>" . $row['id'] . "</kbd>" . "</h3>";
    echo "<h3>" . "<mark>" . "Date of scan: " . $row['currenttime'] . "</mark>" . "</h3>";
    echo '</div>';
      echo '<div class="card-body bg-dark text-white">';
      echo '<span class="badge rounded-pill bg-success">'. 'Total scans: ' . $row['totalscans'] .'</span>';
      echo '<span class="badge rounded-pill bg-success">'. 'BitDefender Result: ' . $bitdif->{'result'} .'</span>';
      echo '<span class="badge rounded-pill bg-success">'. 'Kaspersky Result: ' . $kasdif->{'result'} .'</span>';
      echo '<span class="badge rounded-pill bg-success">'. 'SpamHaus result: ' . $spamdif->{'result'} .'</span>';
      //echo $bitdif['result'];
      if ($row['id'] == $row2['id']){
        //echo $row['id'];
        //echo $row2['id'];
        echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Host sever : ' . $row2['server'] .'</span>';
        echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Host sever : ' . $row2['id'] .'</span>';
        echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Last update : ' . $row2['lastupdate'] .'</span>';
        echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Country : ' . $row2['countryname'] .'</span>';
        echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Known Domains : ' . $row2['domains'] .'</span>';


      
          $myArray = json_decode($row2['vulns'], true);
          #echo $myArray;   
          foreach($myArray as $result) {
            echo '<span class="badge rounded-pill bg-warning text-dark">'. 'CVE : ' . ($result) .'</span>';
          }
          #echo '<span class="badge rounded-pill bg-warning text-dark">'. 'CVE : ' . ($myArray) .'</span>';

        
        echo '<br>';
        

      }
      echo '<hr>';
      
         
      echo '<p>';
            
      echo '<a href=' . $row['permalink'].  'class="btn btn-primary btn-dark btn-outline-warning">Virus Total Scan</a>';
      echo '<div class="card-footer text-muted">';
      echo "VT Scan date: " . $row['scandate'];
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '<br>';
      ////// If statement for more than 7 positives
      if ($row['positives'] > 7) {
        echo "<br>";
        echo '<div class="card bg-dark text-white container-md">';
        echo '<div class="card-header bg-dark text-white">';
          echo '<div class="alert alert-danger" role="alert">';
            echo  $row['positives'] . " positives found.";
          echo '</div>';
          echo "<h3>" . "<kbd>" . $row['id'] . "</kbd>" . "</h3>";
          echo '</div>';
          echo '<div class="card-body bg-dark text-white">';
          echo '<span class="badge rounded-pill bg-success">'. 'Total scans: ' . $row['totalscans'] .'</span>';
          echo '<span class="badge rounded-pill bg-warning text-dark">'. 'BitDefender Result: ' . $bitdif->{'result'} .'</span>';
          echo '<span class="badge rounded-pill bg-warning text-dark">'. 'Kaspersky Result: ' . $kasdif->{'result'} .'</span>';
          echo '<span class="badge rounded-pill bg-warning text-dark">'. 'SpamHaus result: ' . $spamdif->{'result'} .'</span>';
          echo '<hr>';
          echo '<button class="btn btn-secondary btn-dark btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'. $counter . '" aria-expanded="false" aria-controls="collapse'. $counter . '">';
            echo "IP location";
          echo "</button>";
      echo '</p>';
        echo '<div class="collapse" id="collapse'. $counter . '">';
          echo '<div class="card card-body bg-dark text-white">';
          echo "<p>" . "Country: ". "<mark>" . $row2['countryname'] . "</mark>" . "</p>" ;
          echo "<p>" . "Latitude: " . "<mark>" . $row2['latitude'] . "</mark>" . "</p>";
          echo "<p>" . "Longitude: " . "<mark>" . $row2['longitude'] . "</mark>" . "</p>";
          echo '</div>';
        echo '</div>';
            echo '<a href=' . $row['permalink'].  'class="btn btn-primary btn-dark btn-outline-warning">Virus Total Scan</a>';
            echo '<div class="card-footer text-muted">';
            echo "VT Scan date: " . $row['scandate'];
            echo '</div>';
          echo '</div>';
        echo '</div>';
          echo '<br>';
        }
        
      }
    
     

 
    
}

echo "<p>" . "<mark>". $counter . "</mark>" . " IP's analyzed" . "</p>";

?>
</div>
</table>
</div>
