
<?php
include("connect.php");

if(isset($_FILES["upload"]["name"]))
    {
        $isValid = true;
        $fileType = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {
            $isValid = false;
            echo "File yang diupload bukan gambar";
        }

      
        if($isValid){
         

            $uploadfile = "image/".$_FILES["upload"]["name"];
            if(move_uploaded_file($_FILES["upload"]["tmp_name"], $uploadfile)){
                $nama = $_POST["nama"];
                $waktu_mulai = $_POST["waktu_mulai"];
                $waktu_selesai = $_POST["waktu_selesai"];
                $prioritas = $_POST["prioritas"];
                $lokasi = $_POST["lokasi"];
                $link_lokasi = $_POST["link_lokasi"];
                $username = $_GET["username"];

                $query = "INSERT INTO kegiatan(id,nama, waktu_mulai, waktu_selesai, prioritas, lokasi, link_lokasi, username) 
                VALUES ('NULL'," . $nama . "', " . $waktu_mulai . ",'" . $uploadfile . "', " . $waktu_selesai . "', " . $prioritas . "
                ', " . $lokasi . "', " . $link_lokasi . "', " . $username . "')";
                $res = mysqli_query($conn, $query);
                header("Location: kalender.php");
            }
            else{
                echo "<br> Status: gagal upload".$_FILES["upload"]["error"];
            }
        }
    }
    else
        echo "masih kosong";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="styleAdd.css">
    <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Tambah Kegiatan</title>
</head>

<body>
   
<header>
        Kalender 2023
        
    </header>

    <main>

        <div id="containerlogin">
            <form method="POST" action="tambah_kegiatan.php">
                <h3>Tambah Kegiatan</h3>
                <?php
            ?>

                <div>
                    <label for="username">Nama</label>
                    <input type="text" id="name" placeholder="Masukkan nama kegiatan" name="name">
                </div>
                <div>
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="datetime-local" id="waktu_mulai" placeholder="Masukkan waktu mulai" name="waktu_mulai">
                </div>
                <div>
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="datetime-local" id="waktu_selesai" placeholder="Masukkan waktu selesai" name="waktu_selesai">
                </div>
                <div>
                    <label for="prioritas">Prioritas</label>
                    <select class="form-control" name=""  >
                                <?php
                                                                                echo"<option value=biasa >"."Biasa"."</option>";

                                            echo"<option value=sedang >"."Sedang"."</option>";
                                            echo"<option value=penting >"."Sangat Penting"."</option>";

                                        ?>
                                

                                    </select>
                </div>
                <div>
                    <label for="lokasi">Lokasi</label>
                    <textarea type="text" id="lokasi" placeholder="Masukkan lokasi" name="lokasi"></textarea>
                </div>
                <div>
                    <label for="link_lokasi">Link Lokasi</label>
                    <textarea type="text" id="link_lokasi" placeholder="Masukkan link lokasi" name="link_lokasi"></textarea>
                </div>
<div>
                <label for="gambar">Gambar </label>
        <input type="file" name="upload" id="gambar"/>
</div>
                <button name="" value="" type="submit">Tambah</button>
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
<?php
  mysqli_close($conn);

?>