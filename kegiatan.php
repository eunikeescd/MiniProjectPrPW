<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="stylekalender.css">
    <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylekegiatan.css">

    <title>Document</title>
</head>

<body>
<?php
include("connect.php");
$id_itu=$_GET["id"];
$sql = "SELECT * FROM kegiatan where id=$id_itu";
                        $result = $conn->query($sql);
?>
    <header>
        Kalender 2023

    </header>
    <ul class="breadcrumb">
        <li><a href="kalender.php">Halaman Utama</a></li>
        <li><a href="">Detail Kegiatan</a></li>


      </ul>
      <main2 id="main2">
        <h1 id="headKegiatan">Detail Kegiatan</h1>

        <br>

        <div id="containerkegiatan">
            <div id="bgKegiatan">
                <table id="tabeltanggal">
                    <tr id="minggu">
                        <th colspan="3"><img src="<?php  while($row = $result->fetch_assoc()) {
                             echo $row["gambar"]
                             ;
                             ?>" id="gambarKegiatan" width="414" height="310" alt="Kegiatan Bootcamp"></th>
                        
                    </tr>
                    <!-- <tr id="kegiatan">
                        <td >Nama Kegiatan<div class="reminder"></div>
                        </td>
                        <td >Bootcamp<div class="reminder"></div>
                        </td>
                      
                    </tr>

                    <tr id="kegiatan">
                        <td>
                            <div class="num">Tanggal  </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">2 Maret 2023</div>
                            <div class="reminder"></div>
                        </td>
                     
                    </tr>

                    <tr id="kegiatan">
                        <td>
                            <div class="num">Prioritas </div>
                            <div class="reminder"></div>
                        </td>
                        
                        <td>

                            <div class="prioritas_sedang">Sedang</div>
                            
                        </td>
                       
                    </tr>

                    <tr id="kegiatan">
                        <td>
                            <div class="num">Lokasi </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">Jl. Ring Road Utara no. 34, Maguwoharjo

                                Yogyakarta, Yogyakarta 55282, ID</div>
                            <div class="reminder"></div>
                        </td>
                        
                    </tr> -->
                    <tr id="kegiatan">
                        <td ><div class="num"> <img src="event.png" alt="icon tanggal"  width="20" class="icon">Nama Kegiatan</div><div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td ><div class="num">
                            <?php
                                              

                            echo $row["nama"]
                            ;
                  

                            ?></div><div class="reminder"></div>
                        </td>
                      
                    </tr>

                    <tr id="kegiatan">
                        <td>
                            <div class="num"><img src="clock.png" alt="icon tanggal" width="20" class="icon">Waktu Mulai </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">
                                <?php
                                                                               

                                                                                    echo $row["waktu_mulai"];
                                ?>
                            </div>
                            <div class="reminder"></div>
                        </td>
                     
                    </tr>
                    <tr id="kegiatan">
                        <td>
                            <div class="num"><img src="clock.png" alt="icon tanggal" width="20" class="icon">Waktu Selesai</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><?php
                                    echo $row["waktu_selesai"];

                            ?></div>
                            <div class="reminder"></div>
                        </td>
                     
                    </tr>
                    <!-- <tr id="kegiatan">
                        <td>
                            <div class="num"><img src="clock.png" alt="icon tanggal" width="20" class="icon">Waktu</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> 15.00-19.00</div>
                            <div class="reminder"></div>
                        </td>
                        
                    </tr> -->

                    <tr id="kegiatan">
                        <td>
                            <div class="num"><img src="R.png" alt="icon tanggal" width="20" class="icon">Prioritas </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td>

                            <span class=<?php echo"prioritas_".$row["prioritas"];
                            ?>>
                                <?php
                        echo $row["prioritas"];
                                                
                                ?>
                            </span>
                            
                        </td>
                       
                    </tr>

                    <tr id="kegiatan">
                        <td>
                            <div class="num"><img src="location.png" alt="icon tanggal" width="20" class="icon">Lokasi </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"> : </div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><a id="bisa_diklik" href="<?php  echo $row["link_lokasi"];
?>"><?php                        echo $row["lokasi"];}
?> </a></div>
                            <div class="reminder"></div>
                        </td>
                        
                    </tr>
          

          

                </table>
            </div>
        </div>
    </main2>
    <ul class="logdiv">
        <li>
             <form  method="post" action="kalender.php" >
           <input class= "butlogout" type="submit" name="logout" value="Logout" ></input>
         </form>
         </li>
         </div>
       </ul>

<footer>
    © Kelompok 5 PrakProgweb
</footer>
    
</body>

</html>