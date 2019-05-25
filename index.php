<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Form Registerasi Developer</title>
</head>
<body>
    <div class="user">
        <form action="index.php" method="post" enctype="multipart/form-data" class="form">
            <div class="form_group">
                <input type="text" placeholder="Nama" class="form_input" name="nama" id="nama">
            </div>
            <div class="form_group">
                <input type="text" placeholder="Email" class="form_input" name="email" id="email">
            </div>
            <div class="form_group">
                <input type="text" placeholder="Bidang Dev" class="form_input" name="devclass" id="devclass">
            </div>
            <div class="form_group">
                <input type="text" placeholder="Favorite Language" class="form_input" name="favlang" id="favlang">
            </div>
            <!-- Button -->
            <input type="submit" name="submit" id="submit" value="Register" class="btn">
            <input type="submit" name="load" id="load" value="Tampilkan Data" class="btn">
        </form>
    </div>
    <!-- END OF FORM -->
    <!-- PHP CODE -->
    <?php 
        // deklarasi
        $host = "datauser.database.windows.net";
        $user = "aditya";
        $pass = "A@d1ty4&";
        $db = "User";

        try {
            $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            echo "Failed: " . $e;
        }
        
        if(isset($_POST['submit'])){
            try {
                $name = $_POST['nama'];
                $email = $_POST['email'];
                $devclass = $_POST['devclass'];
                $favlang = $_POST['favlang'];
                // insert data to db
                $sql_insert = "INSERT INTO User (nama, email, devclass, favlang) VALUES (?,?,?,?)";

                $stmt = $conn->prepare($sql_insert);
                $stmt->bindValue(1, $name);
                $stmt->bindValue(2, $email);
                $stmt->bindValue(3, $devclass);
                $stmt->bindValue(4, $favlang);
                $stmt->execute();
            }catch(Exception $e){
                echo "Failed: " . $e;
            }

            echo "<h3>Data sudah tersimpan pada sistem</h3>";
        } else if(isset($_GET['load'])){
            try {
                $sql_select = "SELECT * FROM User";
                $stmt = $conn->query($sql_select);
                $registrants = $stmt->fetchAll();
                if(count($users) > 0){
                    echo "<h2>User yang telah terdaftar pada sistem : ".count($registrants)."Orang</h2>";
                    echo "<table>";
                    echo "<tr><th>Nama</th>";
                    echo "<th>Email</th>";
                    echo "<th>Bidang Dev</th>";
                    echo "<th>Favorite Language</th></tr>";
                    foreach($registrants as $registrant){
                        echo "<tr><td>".$registrant['nama']."</td>";
                        echo "<tr><td>".$registrant['email']."</td>";
                        echo "<tr><td>".$registrant['devclass']."</td>";
                        echo "<tr><td>".$registrant['favlang']."</td>";
                    }
                    echo "</table";
                } else {
                    echo "<h3>Tidak ada user yang terdaftar!</h3>";
                }
            } catch(Exception $e){
                echo "Failed: " . $e;
            }
        }
    ?>
</body>
</html>