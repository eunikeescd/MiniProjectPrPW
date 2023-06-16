<<<<<<< HEAD

<?php
include("connect.php");
include("session.php");

$tgl = explode("-", $_GET['tgl']);
$hari = $tgl[2];
$bulan = $tgl[1];
if (strlen($bulan) == 1) {
    $bulan = "0" . $bulan;
}
if (strlen($hari) == 1) {
    $hari = "0" . $hari;
}
$bulan = $NAMA_BULAN[$bulan];
$tahun = $tgl[0];

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tglMulai = "$tahun-" . $tgl[1] . "-$hari";
    $tglSelesai = $_POST['selesai'];
    $level = $_POST['level'];
    $durasi = $_POST['durasiJam'] . " jam " . $_POST['durasiMenit'] . " menit";
    $lokasi = $_POST['lokasi'];
    if (($_FILES['img']['name'] == ''))
    {
        $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`, `username`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', 'pp', '$pengguna')";
        mysqli_query($conn, $sql);
        $sql = "SELECT * FROM `kegiatan` WHERE username = '$pengguna' ORDER BY `kegiatan`.`id` DESC limit 1";
        $result = mysqli_query($conn, $sql);
        $id=mysqli_fetch_assoc($result)['id'];
        // header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);
        header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);
    }
    else {
        $extension = pathinfo($_FILES['img']['name'])['extension'];
        $uploadfile = "upload/" . time() .".".$extension;
        $filetype = explode('/', $_FILES['img']['type'])[0];
        if ($filetype != 'image') {
            echo "<script>
            alert('GAGAL UPLOAD FILE')
        </script>";
        }
        // var_dump($_FILES['img']['type']);
        else if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile) && $filetype=='image') {

            $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`, `username`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', '$uploadfile', '$pengguna')";
            mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `kegiatan` WHERE username = '$pengguna' ORDER BY `kegiatan`.`id` DESC limit 1";
            $result = mysqli_query($conn, $sql);
            $id=mysqli_fetch_assoc($result)['id'];
            header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);

        }

    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kakom</title>
<link rel="stylesheet" href="style.css?v=<?php echo time();?>">
<link rel="icon" type="image/x-icon" href="../gambar/fav.png">

</head>
<style>
.kegiatan td:nth-child(even){
opacity: 1;
text-align: center;
}
.wajib {
    color: red;
}


</style>
<body>
<header>
    <nav>
        <div class="brand">
            Kalender
        </div>
        <ul>
            <li><a href="">Hello, <?php echo $_SESSION['username'];?></a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class ="container">
        <form action="" method="POST" onsubmit="return validation()" enctype= multipart/form-data>
            <table class="kegiatan">
            <tr>
                <th colspan="7" class = "tgl-bulan-tahun">
                    <h3><?php echo "$hari $bulan $tahun"?></h3>
                </th>
            </tr>
            <tr class ="hari-hari">
                <th colspan="7">
                    <input id="errorKegiatan" type="text" name="nama" placeholder="Masukkan nama kegiatan">
                    <span class='wajib'>*</span>
                </th>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\penting.png" alt="">
                    &nbsp; Level Penting 
                </td>
                <td>
                    <select name="level" id="">
                        <option value="kurang">kurang</option>
                        <option value="sedang">sedang</option>
                        <option value="penting">penting</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Mulai
                </td>
                <td id = "mulai">
                    <?php if (strlen($tgl[1]) == 1) {
                        $tgl[1] = "0" . $tgl[1];
                    }
                    ?>
                    <?php echo "$tahun-".$tgl[1] . "-$hari"?>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Selesai
                </td>
                <td>
                    <input id = "selesai" type="date" name="selesai">
                    <script>
                        document.getElementById("mulai").addEventListener('change', function () {
                            document.getElementById("selesai").min = document.getElementById("mulai").innerHTML.trim();
                            if (document.getElementById("selesai").value < document.getElementById("mulai").innerHTML.trim()){
                                document.getElementById("selesai").value = document.getElementById("mulai").innerHTML.trim();
                            }
                        })
                        document.getElementById("selesai").min = document.getElementById("mulai").innerHTML.trim();
                        document.getElementById("selesai").value = document.getElementById("mulai").innerHTML.trim();
                    </script>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\jam.png" alt="">
                    &nbsp; Durasi

                </td>
                <td>
                    <input style="max-width:30px;" min="0" type="number" name="durasiJam" value="0">&nbsp;Jam
                    <input style="max-width:30px;" min = "0" type="number" name="durasiMenit" value="0" >&nbsp;Menit
                </td>
            </tr>
            
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\gps.png" alt="">
                    &nbsp; Lokasi
                </td>
                <td>
                    <input id="errorLokasi" type="text" name="lokasi" placeholder="Masukkan lokasi">
                    <span class='wajib'>*</span>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="file" name="img" id="img" accept="image/*">
                </td>
            </tr>
            <tr>
                <!-- <td class = "go-back">
                    <a href="../to-kegiatan/delapanbelas.html">Go Back</a>
                </td> -->
                <td class="go-back">
                    <a href="../index.php">
                        <img class = "simbol-penting" src="../gambar/home.png" alt="">
                        
                    </a>
                    

                </td>
                <td>
                    <input type="submit" value="Kirim" name="submit">
                </td>

            </tr>

            </table>
        </form>
            <!-- <table class="kegiatan">
                <tr>
                    <td>
                        <img class ="gambar-kakom" src="../gambar/didaktos.png" alt="">
                    </td>
                </tr>
            </table> -->
        
    </div>
</main>
<!-- <footer>
    <img class="ukdw" src="../gambar/33.UKDW.png" alt="">
    <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
</footer> -->
<script>
    function validation () {
        kegiatan =document.getElementById('errorKegiatan');
        lokasi =document.getElementById('errorLokasi');
        errors = [kegiatan, lokasi];
        wajib = document.getElementsByClassName('wajib');
        isValid = true;
        for (i = 0; i < errors.length ; i++)
        {
            if (errors[i].value == '') {
                wajib[i].innerHTML = 'Tidak Boleh Kosong';
                isValid = false;
            }
            else {
                if (wajib[i].innerHTML = 'Tidak Boleh Kosong') {
                    wajib[i].innerHTML = "*";
                }
            }

        }
        return isValid;
    }
</script>




</body>
=======

<?php
include("connect.php");
include("session.php");

$tgl = explode("-", $_GET['tgl']);
$hari = $tgl[2];
$bulan = $tgl[1];
if (strlen($bulan) == 1) {
    $bulan = "0" . $bulan;
}
if (strlen($hari) == 1) {
    $hari = "0" . $hari;
}
$bulan = $NAMA_BULAN[$bulan];
$tahun = $tgl[0];

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tglMulai = "$tahun-" . $tgl[1] . "-$hari";
    $tglSelesai = $_POST['selesai'];
    $level = $_POST['level'];
    $durasi = $_POST['durasiJam'] . " jam " . $_POST['durasiMenit'] . " menit";
    $lokasi = $_POST['lokasi'];
    if (($_FILES['img']['name'] == ''))
    {
        $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`, `username`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', 'pp', '$pengguna')";
        mysqli_query($conn, $sql);
        $sql = "SELECT * FROM `kegiatan` WHERE username = '$pengguna' ORDER BY `kegiatan`.`id` DESC limit 1";
        $result = mysqli_query($conn, $sql);
        $id=mysqli_fetch_assoc($result)['id'];
        // header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);
        header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);
    }
    else {
        $extension = pathinfo($_FILES['img']['name'])['extension'];
        $uploadfile = "upload/" . time() .".".$extension;
        $filetype = explode('/', $_FILES['img']['type'])[0];
        if ($filetype != 'image') {
            echo "<script>
            alert('GAGAL UPLOAD FILE')
        </script>";
        }
        // var_dump($_FILES['img']['type']);
        else if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile) && $filetype=='image') {

            $sql = "INSERT INTO `kegiatan` (`id`, `nama`, `tglMulai`, `tglSelesai`, `level`, `durasi`, `lokasi`, `gambar`, `username`) VALUES (NULL, '$nama', '$tglMulai', '$tglSelesai', '$level', '$durasi', '$lokasi', '$uploadfile', '$pengguna')";
            mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `kegiatan` WHERE username = '$pengguna' ORDER BY `kegiatan`.`id` DESC limit 1";
            $result = mysqli_query($conn, $sql);
            $id=mysqli_fetch_assoc($result)['id'];
            header("location:../kegiatan/rplbo2.php?id=".$id."&tgl=".$_GET['tgl']);

        }

    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kakom</title>
<link rel="stylesheet" href="style.css?v=<?php echo time();?>">
<link rel="icon" type="image/x-icon" href="../gambar/fav.png">

</head>
<style>
.kegiatan td:nth-child(even){
opacity: 1;
text-align: center;
}
.wajib {
    color: red;
}


</style>
<body>
<header>
    <nav>
        <div class="brand">
            Kalender
        </div>
        <ul>
            <li><a href="">Hello, <?php echo $_SESSION['username'];?></a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class ="container">
        <form action="" method="POST" onsubmit="return validation()" enctype= multipart/form-data>
            <table class="kegiatan">
            <tr>
                <th colspan="7" class = "tgl-bulan-tahun">
                    <h3><?php echo "$hari $bulan $tahun"?></h3>
                </th>
            </tr>
            <tr class ="hari-hari">
                <th colspan="7">
                    <input id="errorKegiatan" type="text" name="nama" placeholder="Masukkan nama kegiatan">
                    <span class='wajib'>*</span>
                </th>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\penting.png" alt="">
                    &nbsp; Level Penting 
                </td>
                <td>
                    <select name="level" id="">
                        <option value="kurang">kurang</option>
                        <option value="sedang">sedang</option>
                        <option value="penting">penting</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Mulai
                </td>
                <td id = "mulai">
                    <?php if (strlen($tgl[1]) == 1) {
                        $tgl[1] = "0" . $tgl[1];
                    }
                    ?>
                    <?php echo "$tahun-".$tgl[1] . "-$hari"?>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\kalender.png" alt="">
                    &nbsp; Selesai
                </td>
                <td>
                    <input id = "selesai" type="date" name="selesai">
                    <script>
                        document.getElementById("mulai").addEventListener('change', function () {
                            document.getElementById("selesai").min = document.getElementById("mulai").innerHTML.trim();
                            if (document.getElementById("selesai").value < document.getElementById("mulai").innerHTML.trim()){
                                document.getElementById("selesai").value = document.getElementById("mulai").innerHTML.trim();
                            }
                        })
                        document.getElementById("selesai").min = document.getElementById("mulai").innerHTML.trim();
                        document.getElementById("selesai").value = document.getElementById("mulai").innerHTML.trim();
                    </script>
                </td>
            </tr>
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\jam.png" alt="">
                    &nbsp; Durasi

                </td>
                <td>
                    <input style="max-width:30px;" min="0" type="number" name="durasiJam" value="0">&nbsp;Jam
                    <input style="max-width:30px;" min = "0" type="number" name="durasiMenit" value="0" >&nbsp;Menit
                </td>
            </tr>
            
            <tr>
                <td>
                    <img class = "simbol-penting" src="..\gambar\gps.png" alt="">
                    &nbsp; Lokasi
                </td>
                <td>
                    <input id="errorLokasi" type="text" name="lokasi" placeholder="Masukkan lokasi">
                    <span class='wajib'>*</span>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="file" name="img" id="img" accept="image/*">
                </td>
            </tr>
            <tr>
                <!-- <td class = "go-back">
                    <a href="../to-kegiatan/delapanbelas.html">Go Back</a>
                </td> -->
                <td class="go-back">
                    <a href="../index.php">
                        <img class = "simbol-penting" src="../gambar/home.png" alt="">
                        
                    </a>
                    

                </td>
                <td>
                    <input type="submit" value="Kirim" name="submit">
                </td>

            </tr>

            </table>
        </form>
            <!-- <table class="kegiatan">
                <tr>
                    <td>
                        <img class ="gambar-kakom" src="../gambar/didaktos.png" alt="">
                    </td>
                </tr>
            </table> -->
        
    </div>
</main>
<!-- <footer>
    <img class="ukdw" src="../gambar/33.UKDW.png" alt="">
    <span>&nbsp &#169; Dipundamel dening Bobi, Gian, Yandi :v</span>
</footer> -->
<script>
    function validation () {
        kegiatan =document.getElementById('errorKegiatan');
        lokasi =document.getElementById('errorLokasi');
        errors = [kegiatan, lokasi];
        wajib = document.getElementsByClassName('wajib');
        isValid = true;
        for (i = 0; i < errors.length ; i++)
        {
            if (errors[i].value == '') {
                wajib[i].innerHTML = 'Tidak Boleh Kosong';
                isValid = false;
            }
            else {
                if (wajib[i].innerHTML = 'Tidak Boleh Kosong') {
                    wajib[i].innerHTML = "*";
                }
            }

        }
        return isValid;
    }
</script>




</body>
>>>>>>> d4d40ea0a4e5409b71cd79d57c4f9038a07bee3d
</html>