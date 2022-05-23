<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Example</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container">

    <img src="{{ asset('storage/') . '/img/HWASEUNG.png' }}" alt="" width="100%" height="80px">


    <div class="d-flex justify-content-center" style="">
    <div class="spinner-border spinner-border-sm" style="width: 6rem; height: 6rem; display:none;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
  </div>

  <br>
  <br>
  <?php 

$nilai = 0.5;

$xnilai = 10 * $nilai;
if ($nilai == 0.9) {
  echo " $xnilai Selamat, siswa !";
}else{
  echo "$xnilai gagal";
}
echo '<br>';

$date_check = "2012-09-17 00:00:08";

// if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_check))

// Date "2012-09-17 00:00:08"
if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date_check))
    {
        // return true;
      echo 'true';
    }else{
      echo 'false';
        // return false;
    }

echo '<br>';
$pembelian = [
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 10,
      'harga_satuan' => 5000
  ],
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 1,
      'harga_satuan' => 5900
  ],
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 1,
      'harga_satuan' => 5900
  ],
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 1,
      'harga_satuan' => 5900
  ],
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 1,
      'harga_satuan' => 5900
  ],
  [
      'pembelian_id' =>  4,
      'barang_id'    => 2,
      'jumlah'    => 1,
      'harga_satuan' => 5900
  ]
];

$jumlahTotal = 0;
foreach ($pembelian as $data) {
  //  $jumlahTotal += $data['jumlah'];
   $jumlahTotal += 1;
};
echo 'total '. $jumlahTotal;
echo '<br>';

  echo $url_xtz;
$date = new DateTime('2000-01-01 00:00:00.0');
echo $result = $date->format('Y-m-d');


// function sum($satu, $dua){
//   if ($satu == 'Satu'){
    
//     echo "ini ". $satu;
//   }
//   echo '<br>';
//   if ($dua == 'Dua'){
    
//     echo "ini". $satu;
//   }
//   // echo "ini ". $dua;
// }

$cari_pasal_akumulasi = DB::table('alphabets')
    ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
    ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
    ->where('paragraphs.type_of_verse', 'Pemutusan Hubungan Kerja')
    ->get();

    // echo $cari_pasal_akumulasi;



?>



  <?php

/*inisialisasi variabel kalimat */
$kalimat = "Hallo, apa kabar";
$kalimat1= "http://127.0.0.1:8000/datamaster/employees";

/*ganti karakter " " dengan karakter "+"*/
echo strtr( $kalimat, " ", "+" );
echo '<br>';
echo strtr( $kalimat1, "/", "+" );


echo '<br>';
$url_now = url()->current();

echo  $url_sc = substr($url_now, 21); 
// echo $open_url_now = $url_sc.'*';
echo '<br>';

$str = $url_now;
 $prefix = 'http://127.0.0.1:8000';
 if (substr($str, 0, strlen($prefix)) === $prefix) {
     $str = substr($str, strlen($prefix));
 }
 //hasil
 echo $str;
 echo '<br>';


    // if (isset($_GET['user']))
    // {
    //   $user = $_GET['user'];
    //   $skinURL = "http://s3.amazonaws.com/MinecraftSkins/".$user.".png";
    // } 
    //   $user = $_GET['user'];
      // $user = '1604000001';

      // $skinURL = "http://10.10.100.148/hwi/Photo/10000/".  $user  .".jpg";
    
    // $debugImage = imagecreatefrompng("http://10.10.100.148/hwi/Photo/10000/".  $user  .".jpg");
    // if (empty($debugImage)) // here it checks if $debugImage is empty (doesn't work)
    // {
    //     $skinURL = 'http://www.minecraft.net/images/char.png';
    // }
    // $skin = imagecreatefrompng($skinURL);

    // if (file_exists("http://10.10.100.148/hwi/Photo/10000/1604000001.png"))
    //   {
    //       $skinURL = 'http://www.minecraft.net/images/char.png';
    //   }else{
    //     echo 'gagal';
    //   }
?>
  <br>


    <?php

            // file:///Y:/1604000001.JPG
            define('IMAGE_FOLDER', 'file:///Y:/');
            if (file_exists('http://10.10.100.148/hwi/Photo/10000/1604000001.jpg')) {
                echo 'Yes';
            echo '<br>';
            echo     file_exists('file:///Y:/1604000001.JPG');

          
            } else {
                echo 'No';
            }
            echo '<br>';

            echo $tanggal_hari_ini = date('Y-m-d');// pendefinisian tanggal awal
            echo '<br>';
            echo $countdown_date1 = date('Y-m-d', strtotime('-93 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
            echo '<br>';
            echo $countdown_date2 = date('Y-m-d', strtotime('-120 days', strtotime($tanggal_hari_ini))); //operasi penjumlahan tanggal sebanyak 6 hari
            echo '<br>';


          // data actual
          echo $hari_apa = date('Y-m-d');

          $date_violation = new \DateTime($hari_apa .' 00:00:00');
          echo '<br>';
          echo $date_year = date_format($date_violation, "Y"); //for Display Year
          echo '<br>';
          echo $date_month =  date_format($date_violation, "m"); //for Display Month
          echo '<br>';
          echo $date_day = date_format($date_violation, "d"); //for Display Date
          echo '<br>';

          echo $d_l = date("d", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';
          echo $n_l = date("n", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';
          echo $y_l = date("Y", gmmktime(0,0,0, $date_month, $date_day, $date_year));
          echo '<br>';

          echo $tw = $d_l + $n_l + $y_l;


          $data_hari = $d_l;
          $data_bulan = $n_l;
          $data_tahun = $y_l;

          //data manipulasi
          $jumlah_bulan = $data_bulan + 6;
          if($jumlah_bulan > 12){
            $cari_bulan = $jumlah_bulan - 12;
            $m_bulan = $cari_bulan;
            $m_tahun = $data_tahun + 1;
            $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun);
          }else{
            $m_bulan = $jumlah_bulan;
            $m_tahun = $data_tahun;
            $m_day = cal_days_in_month(CAL_GREGORIAN, $m_bulan, $m_tahun); 
          }

          // manipulasi hari
          if($data_hari == 1 AND $m_bulan == 1){
            $bulan_fix = 12;
            $tahun_fix =  $m_tahun - 1;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }elseif($data_hari == 1){
            $bulan_fix = $m_bulan - 1;
            $tahun_fix = $m_tahun;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }elseif($data_hari <= $m_day){
            $bulan_fix = $m_bulan;
            $tahun_fix = $m_tahun;
            $hari_fix = $data_hari - 1;
          }elseif($data_hari > $m_day){
            $bulan_fix = $m_bulan;
            $tahun_fix = $m_tahun;
            $hari_fix = cal_days_in_month(CAL_GREGORIAN, $bulan_fix, $tahun_fix);
          }
          // 
            // $number_day = cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31
            // echo "There were {$number_day} days in August 2003";
            echo '<br>';
            // $test = new DateTime('02/31/2011');

            if(strlen($hari_fix) == '1'){
              $hari_s = '0'. $hari_fix;
            }elseif(strlen($hari_fix) == '2'){
              $hari_s = $hari_fix;
            }

            if(strlen($bulan_fix) == '1'){
              $bulan_s = '0'. $bulan_fix;
            }elseif(strlen($bulan_fix) == '2'){
              $bulan_s = $bulan_fix;
            }


            echo '<br>';
            echo $te = $bulan_s. "/".$hari_s."/".$tahun_fix;
 
            echo '<br>';            
            $test = new DateTime($te);
            echo date_format($test, 'Y-m-d'); 
            echo '<br>';
            
          ?>
          {{ $hari_fix. " ". $bulan_fix ." ". $tahun_fix}}

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

