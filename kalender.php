

<?php
include("connect.php");
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_kalender.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login_kalender.php');
}

?> 
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
    <title>Document</title>
</head>

<body>
    <header>
        <div>

          Kalender 2023 
        
   
    </header>
    <ul class="breadcrumb">
        <li><a href="">Halaman Utama</a></li>
        

      </ul>
    <aside>
        
        <div id="kontainerharitanggal">
            
            <h1 id="haritanggal">Kamis</h1>
            <p>23 </p>
            <p>Mar</p>
        </div>

        <h1 id="event">Kegiatan</h1>

        <div id="kontainerevents">
        <div id="eventbox">
            <ul>

                <li><a>Keterangan : 
                    <ul>
                        <li id="biasa"><a>Biasa</a></li>
                        <li id="sedang"><a>Sedang</a></li>
                        <li id="penting"><a>Sangat Penting</a></li>


                    </ul>
                </a></li>



                <!-- <div >
                <li id="penting"><a href="kegiatan2.html" id="bisa_diklik" >1 : Mulai Projek</a></li>

            <li id="sedang"><a href="kegiatan1.html" id="bisa_diklik" >2 : Bootcamp</a></li>
            <li id="penting"><a  href="kegiatan4.html" id="bisa_diklik">8 : UTS PrakProgweb</a></li>

            <li id="biasa"><a  href="kegiatan3.html" id="bisa_diklik">11 : Ulang Tahun</a></li>

            <li id="penting"><a  href="kegiatan2.html" id="bisa_diklik">13 : Deadline Projek</a></li>
            <li id="biasa"><a  href="kegiatan5.html" id="bisa_diklik">14 : Turnamen E-sport</a></li>
            <li ><a href="tambah_kegiatan.php" id="bisa_diklik"  >Tambah Kegiatan</a></li>
                    </div> -->
                    <div>
                        <?php
                        $sql = "SELECT * FROM kegiatan";
                        $result = $conn->query($sql);
                        
                    while($row = $result->fetch_assoc()) {
    echo"<li id=".$row["prioritas"]."><a href='kegiatan.php?id=".$row["id"]."' id='bisa_diklik' >".date('d',strtotime($row["waktu_mulai"]))." : ".$row["nama"]."</a></li>";

    //  "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
  
  mysqli_close($conn);

  ?>
              <li ><a href="tambah_kegiatan.php" id="bisa_diklik"  >Tambah Kegiatan</a></li>



                    </div>




        </ul>
        </div>

        </div>

    </aside>


    <main>
        <br>
        <div id="containerkalender">
            <h1 id="bulan"> <span id="left">&lt</span> Maret <span id="right">&gt</span></h1>
            <div id="kalender">
                <table id="tabeltanggal">
                    <tr id="minggu">
                        <th>Minggu</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                    </tr>
                    <tr id="angka">
                        <td id="prev">26<div class="reminder"></div>
                        </td>
                        <td id="prev">27<div class="reminder"></div>
                        </td>
                        <td id="prev">28<div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><a href="kegiatan2.html" id="bisa_diklik_membesar" >1</a></div>
                            <div class="reminder" id="active_penting"></div>
                        </td>
                        <td>
                            <div class="num"><a href="kegiatan1.html" id="bisa_diklik_membesar" >2</a></div>
                            <div class="reminder" id="active_sedang"></div>
                        </td>
                        <td>
                            <div class="num">3</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">4</div>
                            <div class="reminder"></div>
                        </td>
                    </tr>

                    <tr id="angka">
                        <td>
                            <div class="num">5</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">6</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">7</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><a  href="kegiatan4.html" id="bisa_diklik_membesar">8</a></div>
                            <div class="reminder" id="active_penting"></div>
                        </td>
                        <td>
                            <div class="num">9</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">10</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><a  href="kegiatan3.html" id="bisa_diklik_membesar">11</a></div>
                            <div class="reminder" id="active_biasa"></div>
                        </td>
                    </tr>

                    <tr id="angka">
                        <td>
                            <div class="num">12</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num"><a href="kegiatan2.html" id="bisa_diklik_membesar">13</a></div>
                            <div class="reminder" id="active_penting"></div>
                        </td>
                        <td>
                            <div class="num"><a href="kegiatan5.html" id="bisa_diklik_membesar">14</a></div>
                            <div class="reminder" id="active_biasa"></div>
                        </td>
                        <td>
                            <div class="num">15</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">16</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">17</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">18</div>
                            <div class="reminder"></div>
                        </td>
                    </tr>

                    <tr id="angka">
                        <td>
                            <div class="num">19</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">20</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">21</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">22</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div  id="tanggalSekarang"  >23</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">24</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">25</div>
                            <div class="reminder"></div>
                        </td>
                    </tr>

                    <tr id="angka">
                        <td>
                            <div class="num">26</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">27</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">28</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">29</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">30</div>
                            <div class="reminder"></div>
                        </td>
                        <td>
                            <div class="num">31</div>
                            <div class="reminder"></div>
                        </td>
                        <td id="next">1<div class="reminder"></div>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </main>
 <!-- nambah logout  di kanan atas -->
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