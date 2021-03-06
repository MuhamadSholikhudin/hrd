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

  <form action="" class="form p-3" method="post">
    <textarea name="" id="" style="width:100;"></textarea>
    <br>
    <button type="submit">Proses</button>
  </form>
  <?php
    echo "<br/>";

    // $array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

    // print_r($array);

    $violationmigrations = DB::table('violationmigrations')
      ->select(
        'id as id',
        'date_of_violation as date_of_violation',
        'no_violation as no_violation',
        'violation_rom as violation_ROM',
        'date_end_violation as date_end_violation',
        'type_of_violation as type_of_violation',
        'violation_status as violation_status',
        'name as name',
        'number_of_employees as number_of_employees',
        'keterangan_lain as other_information',
        'pasal_yang_dilanggar as alphabet_id'
      )
      ->limit(20)
      ->get();

    $violation = DB::table('violations')
    ->leftJoin('employees', 'employees.id', '=', 'violations.employee_id')
      ->select( 'violations.id as id',
          'violations.date_of_violation as date_of_violation',
          'violations.no_violation as no_violation',
          'violations.violation_ROM as violation_ROM',
          'violations.date_end_violation as date_end_violation',
          'violations.type_of_violation as type_of_violation',
          'violations.violation_status as violation_status',
          'employees.name as name',
          'employees.number_of_employees as number_of_employees',
          'violations.other_information as other_information',
          'violations.alphabet_id as alphabet_id'
      )
        ->limit(20)
        ->get();

    $violations = $violation->merge($violationmigrations);

    var_dump($items);
    // exit;
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";



    <tr>
    <td>{{ $violation->id }}</td>
    <td><a href="/violations/{{ $violation->employee_id }}/edit" class="text-dark" >{{ number_of_employees($violation->number_of_employees); }}</a></td>
    <td><a href="/violations/{{ $violation->employee_id }}/edit" class="text-dark">{{ name($violation->employee_id); }}</a></td>
    <td>{{nomer_sp($violation->no_violation, $violation->id);}}           </td>
    <td> {{ tanggal_pelanggaran($violation->reporting_date); }} </td>
    <td>{{ tanggal_pelanggaran($violation->date_of_violation); }}  </td>
    <td>{{ tanggal_pelanggaran($violation->date_end_violation); }}  </td>
    <td>{{selang($violation->date_end_violation);}}</td>
    <td>{{ $violation->type_of_violation }}</td>
    <td> {{pasal($violation->alphabet_id);}} </td>
    <td>
     <!-- {{ pasal($violation->alphabet_id); }} -->
     <?php 
        if($violation->alphabet_accumulation !== NULL){
        echo pasal($violation->alphabet_accumulation);
        }else{
        }
     ?>
      </td>
    <td>{{ $violation->violation_status  }}</td>
    <td style="align:center;">
      <?php                
        $c_delivery = DB::table('deliveryletters')->where('id', $violation->id)->count();
      if($c_delivery > 0){ ?>
        <?php
        $delivery = DB::table('deliveryletters')->find($violation->id);
        $use = DB::table('users')->find($delivery->user_id);

        ?>
        <a href="#" class="text-dark deliveryedit" data-id="{{$delivery->id}}" data-sk="{{nomer_sp($violation->no_violation, $violation->id);}}" data-datedeliveryedit="<?= $delivery->date_delivery ?>" data-user="<?= $delivery->user_id ?>" data-toggle="modal" data-target="#edit_delivery">
            <i class="fa-solid fa-pen"></i> &nbsp;
        </a>
            <?= tanggal_pelanggaran($delivery->date_delivery) ?>, <?= $use->name ?>               
      <?php }else{ ?>
          <a href="" class="btn btn-info deliveryadd" data-id="{{$violation->id}}" data-toggle="modal" data-sk="{{nomer_sp($violation->no_violation, $violation->id);}}" data-target="#add_delivery" data-toggle="tooltip" data-placement="bottom" title="Tambah Penyampaian">
            <i class="fa-solid fa-clipboard-user"></i>
          </a>
      <?php } ?>             

    </td>                
    <td>
        <a href="/violations/{{$violation->id }}" target="_blank" class="btn  btn-outline-primary">
          Cetak                    
        </a>
        <form action="{{route('cancelviolations')}}" method="POST" class="d-inline ">
          @csrf
          <input type="hidden" name="id" value="{{$violation->id }}">
          <button type="submit" class="btn btn-outline-success" onclick="return confirm(' Are you sure process violation data ?')"> 
            <?php if($violation->violation_status == 'active'){  ?>
              Cancel
            <?php }else{ ?>
              Activate
            <?php } ?>
          </button>
        </form> 
        
        
        <a href="/hiviolations/{{$violation->id }}/getedit" class="btn  btn-outline-warning">
          Edit
        </a>
        <form action="{{route('deleteviolations')}}" method="POST" class="d-inline ">
          @csrf
          <input type="hidden" name="id" value="{{$violation->id }}">
          <button type="submit" class="btn btn-outline-danger" onclick="return confirm(' Are you sure delete data ?')"> 
            Delete
          </button>
        </form> 
    </td>
  </tr>




  // $violationmigrations = DB::table('violationmigrations') 
  //   ->select(
  //     'id as id',
  //       'date_of_violation as date_of_violation',
  //       'no_violation as no_violation',
  //       'violation_rom as violation_ROM',
  //       'date_end_violation as date_end_violation',
  //       'type_of_violation as type_of_violation',
  //       'violation_status as violation_status',
  //       'name as name',
  //       'number_of_employees as number_of_employees',
  //       'keterangan_lain as other_information',
  //       'pasal_yang_dilanggar as alphabet_id'
  //   )
  //   ->orderByDesc('violationmigrations.id')
  //   ->limit(1)
  //   ->get()
  //   ;
  //   var_dump($violationmigrations);

  // $violations1 = DB::table('violations')
  //   ->leftJoin('employees', 'employees.id', '=', 'violations.employee_id')
  //   ->select( 'violations.id as id',
  //       'violations.date_of_violation as date_of_violation',
  //       'violations.no_violation as no_violation',
  //       'violations.violation_ROM as violation_ROM',
  //       'violations.date_end_violation as date_end_violation',
  //       'violations.type_of_violation as type_of_violation',
  //       'violations.violation_status as violation_status',
  //       'employees.name as name',
  //       'employees.number_of_employees as number_of_employees',
  //       'violations.other_information as other_information',
  //       'violations.alphabet_id as alphabet_id'
  //    )
  //   ->orderByDesc('violations.id')
  //   ->limit(1)
  //   ->get()
  //    ;

  // $violations = Arr::collapse($violationmigrations, $violations1);
  echo "<br/>";
  // print_r($violationmigrations);

  $array1 = array("id1" => "value1");

  $array2 = array("id2" => "value2", 
  "id3" => "value3",
   "id4" => "value4");
  //  print_r($array2);
  $array3 = array_merge($array1, $array2/*, $arrayN, $arrayN*/);
  echo '<pre>';
  // var_dump($violations1);

  /*
    array(4) {
      ["id1"]=>
      string(6) "value1"
      ["id2"]=>
      string(6) "value2"
      ["id3"]=>
      string(6) "value3"
      ["id4"]=>
      string(6) "value4"
    }

  */


  ?>

  <table border="1" class="table">
    <tr>
        <th>ID violation</th>
        <th>employee ID</th>
        <th>Array</th>
    </tr>
    <?php
      // DB::table('startworks')
      //   ->where('employee_id', 'employee_id')
      //   ->update([
      //     "department_id" => "department",
      //     "job_id" => "job",
      //     "bagian" => "bagian",
      //     "cell" => "cell",
      //     "hire_date" => "date"
      //   ]);
    ?>
    <?php 
      // DB::table('violationmigrations')->upsert([
       
        
      // ],
      //   ['number_of_employees' ,'employee_id','name' ,'date_of_violation','date_end_violation','no_violation','month_of_violation','violation_rom','reporting_day' ,'reporting_date','job_level','department','violation_status' ,'type_of_violation','	pasal_yang_dilanggar' ,'bunyi_pasal_pelanggaran_jika_pernah_sp' ,'bunyi_pasal_pelanggaran' ,'pelanggaran_sekarang_jiks_pernah_dapat_sp' ,'bunyi_pasal_pelanggarang_sekarang' ,'keterangan_lain' ,'ketengan_lain_2' ,'keterangan_lain_1' ,'pelanggaran_sebelumnya' ,'keterangan' ,'rekap_sesuai_dengan_laporan_pelanggaran' ,'tambahan_ket_1' ,'tambahan_keterangan' ,'tambahan_ket_2' ,'tambahan_ket_3' ,'an_hrd','tanggal_penyampaian_sp']);
  
      // include 'migrasi.php';
     

      //  INSERT BATCH
      // DB::table('violationmigrations')->upsert([
      
      // ],
      // ['number_of_employees' ,'employee_id','name' ,'date_of_violation','date_end_violation','no_violation','month_of_violation','violation_rom','reporting_day' ,'reporting_date','job_level','department','violation_status' ,'type_of_violation','	pasal_yang_dilanggar' ,'bunyi_pasal_pelanggaran_jika_pernah_sp' ,'bunyi_pasal_pelanggaran' ,'pelanggaran_sekarang_jiks_pernah_dapat_sp' ,'bunyi_pasal_pelanggarang_sekarang' ,'keterangan_lain' ,'ketengan_lain_2' ,'keterangan_lain_1' ,'pelanggaran_sebelumnya' ,'keterangan' ,'rekap_sesuai_dengan_laporan_pelanggaran' ,'tambahan_ket_1' ,'tambahan_keterangan' ,'tambahan_ket_2' ,'tambahan_ket_3' ,'an_hrd','tanggal_penyampaian_sp']);
    
    ?>

        <!-- <tr>
            <td>Robby</td>
            <td>76</td>
            <td>80</td>
            <td>81</td>
        </tr>
        <tr>
            <td>Rendi</td>
            <td>84</td>
            <td>70</td>
            <td>75</td>
        </tr>
        <tr>
            <td>Alfian</td>
            <td>96</td>
            <td>70</td>
            <td>71</td>
        </tr> -->
    </table>



  <?php

    $tanggal1 = "2022-05-08";
    $tanggal2 = "2022-05-09";

    echo(strtotime($tanggal1) . "<br>");
    echo(strtotime($tanggal2) . "<br>");

    $keluar1 = strtotime($tanggal1);
    $keluar2 = strtotime($tanggal2);
    $klu = $keluar1 - $keluar2;

    if($klu > 0){
      echo 1;
    }elseif($klu < 1){
      echo $klu;
    }

    echo '<br>';

    echo tanggal_pelanggaran(date('Y-m-d'));

    // $cari_vio_alpha_not_null = DB::table('violations')->where('alphabet_accumulation' , '!=' , NULL)->get();

    // DB::table('violations')->where('alphabet_accumulation' , '!=' , NULL)->orderBy('id')->chunk(100, function ($violations) {
    //     foreach ($violations as $violation) {
    //         //

    //         $c_violations = DB::table('violations')
    //             ->where('employee_id',  $violation->employee_id)
    //             ->where('id', '<', $violation->id)
    //             ->count();

    //         if($c_violations > 0){
    //           $get_violations = DB::table('violations')
    //               ->where('employee_id',  $violation->employee_id)
    //               ->where('id', '<', $violation->id)
    //               ->latest()
    //               ->first();

    //             DB::table('violations')
    //               ->where('id', $violation->id)
    //               ->update([
    //                   'violation_accumulation'=> $get_violations->id
    //               ]);

    //         }else{
              

    //         }
    //     }
    // });


        
    // VIOLATION_ACCUMULATION2
    // DB::table('violations')->where('violation_accumulation' , '!=' , NULL)->orderBy('id')->chunk(100, function ($violations) {
    //   foreach ($violations as $violation) {
    //     $c_violations = DB::table('violations')
    //         ->where('employee_id',  $violation->employee_id)
    //         ->where('id', '<', $violation->id)
    //         ->count();

    //     if($c_violations > 0){
    //       $get_violations = DB::table('violations')
    //         ->where('employee_id',  $violation->employee_id)
    //         ->where('id', '<', $violation->id)
    //         ->orderBy('id', 'desc')
    //         ->first();
    //       if($get_violations->date_end_violation > $violation->reporting_date){

    //           $c_violation2 = DB::table('violations')
    //             ->where('employee_id',  $violation->employee_id)
    //             ->where('id', '<', $get_violations->id)
    //             ->count();

    //             if($c_violation2 > 0){
    //               $get_violations2 = DB::table('violations')
    //                 ->where('employee_id',  $violation->employee_id)
    //                 ->where('id', '<', $get_violations->id)
    //                 ->orderBy('id', 'desc')
    //                 ->first();

    //                 if($get_violations2->date_end_violation > $get_violations->reporting_date){

    //                 DB::table('violations')
    //                   ->where('id', $violation->id)
    //                   ->update([
    //                       'violation_accumulation2'=> $get_violations2->id
    //                   ]);
    //                 }
    //             }else{

    //             }
    //       }else{

    //       }                       

    //     }else{
    //     }
    //   }
    // });



    // // VIOLATION_ACCUMULATION3
    // DB::table('violations')->where('violation_accumulation2' , '!=' , NULL)->orderBy('id')->chunk(100, function ($violations) {
    //   foreach ($violations as $violation) {

    //     // Cari accumulation2 dari terakhir 
    //     $c_violations = DB::table('violations')
    //         ->where('employee_id',  $violation->employee_id)
    //         ->where('violation_accumulation2' , '!=' , NULL)        
    //         ->where('id', '<', $violation->id)
    //         ->count();

    //     if($c_violations > 0){

    //        // menampilkan accumulation2 dari terakhir 
    //       $get_violations = DB::table('violations')
    //         ->where('employee_id',  $violation->employee_id)
    //         ->where('id', '<', $violation->id)
    //         ->where('violation_accumulation2' , '!=' , NULL)
    //         ->orderBy('id', 'desc')
    //         ->first();

    //       if($get_violations->date_end_violation > $violation->reporting_date){

    //           $c_violation2 = DB::table('violations')
    //             ->where('employee_id',  $violation->employee_id)
    //             ->where('id', '<', $get_violations->id)
    //             ->where('violation_accumulation' , '!=' , NULL)
    //             ->count();

    //             if($c_violation2 > 0){
    //               $get_violations2 = DB::table('violations')
    //                 ->where('employee_id',  $violation->employee_id)
    //                 ->where('id', '<', $get_violations->id)
    //                 ->where('violation_accumulation' , '!=' , NULL)
    //                 ->orderBy('id', 'desc')
    //                 ->first();

    //                 if($get_violations2->date_end_violation > $get_violations->reporting_date){

    //                 DB::table('violations')
    //                   ->where('id', $violation->id)
    //                   ->update([
    //                       'violation_accumulation3'=> $get_violations->violation_accumulation2
    //                   ]);
    //                 }
    //             }else{

    //             }
    //       }else{

    //       }                       

    //     }else{
    //     }
    //   }
    // });


    // // MEMBUAT KARYAWAN TIDAK AKTIF
    // DB::table('employees')->where('date_out' , '!=' , NULL)->orderBy('id')->chunk(1000, function ($employees) {
    //   foreach ($employees as $employee) {
    //     DB::table('employees')
    //       ->where('id', $employee->id)
    //       ->update([
    //           'status_employee'=> 'notactive'
    //       ]);                
    //     }
    // });

    echo '<br>';
    // $cari_pasal_akumulasi = DB::table('alphabets')
    //             ->join('paragraphs', 'alphabets.paragraph_id', '=', 'paragraphs.id')
    //             ->join('articles', 'paragraphs.article_id', '=', 'articles.id')
    //             ->where('paragraphs.type_of_verse', 'Surat Peringatan Terakhir')
    //             ->where('alphabet_accumulation', 'like', '%' . 'Surat Peringatan Pertama' . '%')
    //             ->select('alphabets.id as id')
    //             ->first();
    // $cari_pasal_akumulasi = ['id' => 93];  
    // echo $cari_pasal_akumulasi['id'];  


      // DB::table('violations')->where('id', '>', 8028)->delete();

      // $hapus_vio = DB::table('violations')->where('id' , '>' , 8028)-get();
      // foreach ($hapus_vio as $hapus) {
      //   DB::table('employees')
      //     ->where('id', $employee->id)
      //     ->update([
      //         'status_employee'=> 'notactive'
      //     ]);                
      //   }
  ?>
    <h1>Hello, world!</h1>
    <div class="container">

    <img src="{{ asset('storage/') . '/img/HWASEUNG.png' }}" alt="" width="100%" height="80px">


    <div class="d-flex justify-content-center" style="">
    <div class="spinner-border spinner-border-sm" style="width: 6rem; height: 6rem; display:none;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
  </div>



  <input type="file" >

<br>

<?php

  // $arr_a = [1, 2, 3, ....., 5000];


  // DB::table('employees')->orderBy('id')->chunk(100, function ($employees) {
  //   foreach ($employees as $employee) {
  //       //
  //       echo $employee->id;
  //   }
  // });

?>


<?php

  echo  "<br>";

  $a = 32;
  echo "a is " . is_numeric($a) . "<br>";

  $b = "";
  echo "b is " . is_numeric($b) . "<br>";

  $c = 32.5;
  echo "c is " . is_numeric($c) . "<br>";

  $d = "32s";
  echo "d is " . is_string($d) . "<br>";

  $e = true;
  echo "e is " . is_numeric($e) . "<br>";

  $f = null;
  echo "f is " . is_numeric($f) . "<br>";

  $g = 34242;
  echo "g is " . is_numeric($g) . "<br>";
?>


  <br>
  <?php
    $string = "apple123";
    
    $isThereNumber = false;
    for ($i = 0; $i < strlen($string); $i++) {
        if ( ctype_digit($string[$i]) ) {
            $isThereNumber = true;
            break;
        }
    }
    
    if ( $isThereNumber ) {
        echo "\"{$string}\" has number(s).";
    } else {
        echo "\"{$string}\" does not have number(s).";
    }
 
  ?>


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

