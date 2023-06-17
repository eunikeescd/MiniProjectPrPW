
<?php
include("connect.php");


$errsalah='';

if($_POST) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $hasil = mysqli_query($conn, $query);
    
   
   if(mysqli_num_rows($hasil) == 1) {
    session_start();
    $row = mysqli_fetch_array($hasil);
    $nama = $row['nama'];
    setcookie('nama',  $nama, time() + 60);
   
    $_SESSION['username'] = $username;
    header("Location: kalender.php");

    exit();
    } else {
       $errsalah = "Username atau password anda salah!";
        
    }
  }
  mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="stylelogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Tambah Kegiatan</title>
</head>

<body>
   
<header>
        Kalender 2023
        
    </header>

    <main>

        <div id="containerlogin">
            <form method="POST" action="login_kalender.php">
                <h3>Tambah Kegiatan</h3>
                <?php
            echo '<p class="logsalah">'.$errsalah.'</p>';
            ?>

                <div>
                    <label for="username">Nama</label>
                    <input type="text" id="username" placeholder="Enter your username" name="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" name="password">
                </div>
                <button name="" value="" type="submit">Sign in</button>
            </form>
            <div class="divlogsalah">
            <br>
            
            </div>
        </div>
        

    </main>

    <footer>
        © Kelompok 5 PrakProgweb
    </footer>
    <script>
            nama = document.getElementById("username");

    </script>
</body>
</html>