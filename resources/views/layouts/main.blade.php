<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRD | HWI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link rel="icon" href="{{ asset('img/favicon.ico') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

                      {{-- TRIX EDOTIR --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/trix.css') }}">
  <script type="text/javascript" src="{{ asset('dist/js/trix.js') }}"></script>

<style>
  trix-toolbar [data-trix-button-group="file-tools"]{
    display: none;
  }
</style>


</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include('layouts.navbar')

  <!-- Main Sidebar Container -->
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
    @yield('container')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.3-pre
    </div>
    <strong>Copyright &copy; 2022-<?= date('Y') ?> </strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="{{asset('plugins/jquery/jquery.js') }}"></script> -->
<script src="{{asset('plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js') }}"></script>


<!-- jquery-validation -->
 <!-- <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>  -->

<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js') }}"></script>

<!-- <script src=//code.jquery.com/jquery-3.5.1.min.js integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin=anonymous></script> -->


<script src="{{ asset('dist/js/scriptdewe.js') }}"></script> 

<!-- jquery-validation -->
<script>
  $('#pil_karyawan').change(function() {
    var pil_kar = $(this).val();
    if( pil_kar == 'karyawan_lama'){
      // alert("karyawan lama");
      $('#t_karyawan_lama').append("<select class='form-control select2bs4' style='width: 100%;' id='car_kar' name='job_id'><option value='nama' selected>Nama karyawa / no ktp</option></select>" );
    }else{
      $( "#car_kar" ).remove();
    }
  });

///ALPHABET
  $('#alphabet_type').change(function() {
    var pil_type = $(this).val();
    if( pil_type == 'accumulation'){
      // alert("karyawan lama");
      $('#check_acummulation').show();
    }else{
      $( "#check_acummulation" ).hide();
      // $( ".chk" ).hide();
      $(".chk").prop('checked', false);
    }
  });

  $('#alphabet_type_edit').change(function() {
    var pil_type = $(this).val();
    if( pil_type == 'accumulation'){
      // alert("karyawan lama");
      $('#check_acummulation2').hide();
      $('#check_acummulation1').show();
    }else{
      $( "#check_acummulation1" ).hide();
      $( "#check_acummulation2" ).show();
      // $( ".chk" ).hide();
      $(".chkdsb").prop('disabled', true);
    }
  });

  

  // Signature

  $('#signature_employee').change(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var signature_employee = $(this).val();
    // alert(signature_employee);
    $.ajax({
          type: "POST",
          url: "{{route('get_signature')}}",
          // async: true,
          dataType: 'json',
          data: {
            signature_employee: signature_employee
          },
          success: function(data) {
            // alert(data);
            $("#signature_name").val(data[0]);
            $("#signature_department").val(data[1]);
            $("#signature_part").val(data[2]);
          },error(){
            alert("error");
          }

    });
  });
  
    // Proses pencarian pelanggaran
  $('#btn_proses_testedit').on('click', function() {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var status_violant_last = document.getElementById("last_vio").value;
    var id_emp = document.getElementById("id_emp").value;
    var violation_now = document.getElementById("select_violation_last").value;
    var last_type = document.getElementById("last_type").value;
    var last_accumulation = document.getElementById("last_accumulation").value;
    // var keyword = $(this).val();
    // alert(status_violant_last + id_emp + violation_now + last_type + last_accumulation);
    // alert("POST");  

  $.ajax({
    type: "POST",
    url: "{{route('get_type_teatviolation')}}",
    // async: true,
    dataType: 'json',
    data: {
      violation_now: violation_now,
      id_emp : id_emp,
      status_violant_last : status_violant_last,
      last_type: last_type,
      last_accumulation: last_accumulation

      
    },
    success: function(data) {
      // alert(data);
      document.getElementById("btn_modal_click1").click();
      $("#jpn1").val(data[0]);
      $("#pkb1").html(data[1]);
      $("#remainder1").text(data[2]);
      $("#remainder2").text(data[3]);
      $("#alphabet_id").val(violation_now);
      console.log(data);
    },
    // complete:function(data){
    //   // Hide image container
    //   $("#loader").hide();
    // },
    error(){
      alert("Inputan error");
    }

  });
});


    // Proses pencarian pelanggaran
    $('#btn_proses_edit').on('click', function() {

$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
  });

var violation_id = document.getElementById("violation_id").value;;
var status_violant_last = document.getElementById("last_vio").value;
var id_emp = document.getElementById("id_emp").value;
var violation_now = document.getElementById("select_violation_last").value;
var last_type = document.getElementById("last_type").value;
var last_accumulation = document.getElementById("last_accumulation").value;
// var keyword = $(this).val();

$.ajax({
  type: "POST",
  url: "{{route('get_type_hiviolation')}}",
  // async: true,
  dataType: 'json',
  data: {
    violation_id: violation_id,
    violation_now: violation_now,
    id_emp : id_emp,
    status_violant_last : status_violant_last,
    last_type: last_type,
    last_accumulation: last_accumulation
  },
  // beforeSend: function(){
  //   // Show image container
  // $("#loader").show();
  //   // alert(violation_id + status_violant_last + id_emp + violation_now + last_type + last_accumulation);
  // },
  success: function(data) {
    // alert(data);
    // document.getElementById("btn_modal_click1").click();
    $("#jpn1").val(data[0]);
    $("#pkb1").html(data[1]);
    $("#remainder1").text(data[2]);
    $("#remainder2").text(data[3]);
    $("#alphabet_id").val(violation_now);
  },
  // complete:function(data){
  //   // Hide image container
  //   $("#loader").hide();
  // },
  error(){
    alert("Inputan error");
  }

});
});


  // Proses pencarian pelanggaran
    $('#btn_proses').on('click', function() {

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        //  var select_violation = 'notviolation';
        var status_violant_last = document.getElementById("last_vio").value;
        var id_emp = document.getElementById("id_emp").value;
        var violation_now = document.getElementById("select_violation_last").value;
        var last_type = document.getElementById("last_type").value;
        var last_accumulation = document.getElementById("last_accumulation").value;
        // var keyword = $(this).val();
        // alert(status_violant_last + id_emp + violation_now + last_type + last_accumulation);

        $.ajax({
          type: "POST",
          url: "{{route('get_type_violation')}}",
          // async: true,
          dataType: 'json',
          data: {
            violation_now: violation_now,
            id_emp : id_emp,
            status_violant_last : status_violant_last,
            last_type: last_type,
            last_accumulation: last_accumulation
          },
          success: function(data) {
            // alert(data);
            document.getElementById("btn_modal_click1").click();
            $("#jpn1").val(data[0]);
            $("#pkb1").html(data[1]);
            $("#remainder1").text(data[2]);
            $("#remainder2").text(data[3]);
            $("#alphabet_id").val(violation_now);

            // if (data[0] == 'terima_kasih') {
            //     document.getElementById("terima_kasih").play();
            // } else if (data[0] == 'coba_lagi') {
            //     document.getElementById("coba_lagi").play();

            // } else if (data[0] == 'data_tidak_terdaftar') {
            //     document.getElementById("data_tidak_terdaftar").play();

            // } else {

            // }
          },error(){
            alert("Inputan error");
          }

        });
    });

    $('.deliveryadd').on('click', function() {
        var id = $(this).data('id');
        var sk = $(this).data('sk');
        
        $('#violation_id').val(id);
        $('#deladd').html(sk);

    });

    $('.deliveryedit').on('click', function() {
        var id = $(this).data('id');
        var sk = $(this).data('sk');
        var user = $(this).data('user');
        var datedeliveryedit = $(this).data('datedeliveryedit');

        $('#editformdel').attr('action', '/deliveryletters/' + id);
        $('#delsk').html(sk);
        $('#id_edit').val(id);
        $('#datedeliveryedit').val(datedeliveryedit);
        $('#user_id_edit').val(user);
        
    });


  // PHK Mencari Pasal PHK
  $('#pasal_phk').change(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    // alert("Pasal ");
    var pasal_phk = $(this).val();
    // alert(pasal_phk);
    $.ajax({
          type: "POST",
          url: "{{route('get_pasal_phk')}}",
          dataType: 'json',
          data: {
            pasal_phk: pasal_phk
          },
          success: function(data) {
            // alert(JSON.stringify(data));
            // $("#isi_text").html(data[0]);

            var op = JSON.stringify(data[1]);
            // var op = data[1];
            const obj = JSON.parse(op);
            var html = '';
            var i;
            for(i=0; i < obj.length; i++){
                  html += '<option value="' + obj[i].id +'">'+ obj[i].number_of_employees +' ' + obj[i].name +'</option>';
            }
              $('#karyawan_phk').html(html);
              $('#isi_text').val(data[0]);

              // $('#karyawan_phk').html('<option value="get3" id="karyawan_phk3" >Pilih3</option>');
              // $('#karyawan_phk').append('<option value="get3" id="karyawan_phk3" >Pilih3</option>');

          },error(){
            alert("error");
          }

    });
  });

  function car_kar(){

    var input_kar = document.getElementById("cari_karyawan_phk").value;

    if(input_kar == ""){
      $("#output_cari_karyawan").html("KOSONG");
    }else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: "POST",
          url: "{{route('get_karyawan_phk')}}",
          dataType: 'json',
          data: {
            karyawan_phk: input_kar
          },
          success: function(data) {
            // alert(data);
            $("#nama_phk").html(data[0]);
            $("#sml").val(data[0]);
            $("#bagian_phk").html(data[1]);
            $("#id_no_phk").html(data[2]);
            $("#department_phk").html(data[3]);
            $("#job_phk").html(data[4]);
            $("#hire_date_phk").html(data[5]);


            $("#output_cari_karyawan").html(data[0]);

          },error(){
            alert("error");
          }
      });

      
    }
  }

function keydowncari() {
  document.getElementById("cari_karyawan_phk").style.backgroundColor = "red";
}

 //Menampilkan karyawan PHK
 $('#cari_karyawan_phk').keyup(function() {
    // alert("oke");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var input_kar = document.getElementById("cari_karyawan_phk").value;

    if(input_kar == ""){

    }else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: "POST",
          url: "{{route('get_karyawan_phk')}}",
          dataType: 'json',
          data: {
            karyawan_phk: input_kar
          },
          success: function(data) {
            // alert(data);
            $("#nama_phk").html(data[0]);
            $("#sml").val(data[0]);
            $("#bagian_phk").val(data[1]);
            $("#id_no_phk").html(data[2]);
            $("#department_phk").val(data[3]);
            $("#job_phk").val(data[4]);
            $("#hire_date_phk").html(data[5]);

            $("#output_cari_karyawan").html(data[0]);

            var btn_phk = data[0];

            if(btn_phk == "NULL"){
              $('#button_php').attr('disabled','true');
            }else{
              $('#button_php').removeAttr('disabled');

            }
          },error(){
            alert("error");
          }
      });

      
    }
  document.getElementById("cari_karyawan_phk").style.backgroundColor = "white";
});

 //Menampilkan karyawan PHK
//  $('#cari_karyawan_phk').on( "change", function() {
//     // alert("oke");
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     var input_kar = document.getElementById("cari_karyawan_phk").value;

//     if(input_kar == ""){
//       $("#output_cari_karyawan").html("KOSONG");
//     }else{

//       $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//           }
//       });

//       $.ajax({
//           type: "POST",
//           url: "{{route('get_karyawan_phk')}}",
//           dataType: 'json',
//           data: {
//             karyawan_phk: input_kar
//           },
//           success: function(data) {
//             // alert(data);
//             $("#nama_phk").html(data[0]);
//             $("#sml").val(data[0]);
//             $("#bagian_phk").html(data[1]);
//             $("#id_no_phk").html(data[2]);
//             $("#department_phk").html(data[3]);
//             $("#job_phk").html(data[4]);
//             $("#hire_date_phk").html(data[5]);


//             $("#output_cari_karyawan").html(data[0]);

//           },error(){
//             alert("error");
//           }
//       });

      
//     }
    
//   });


  //Menampilkan karyawan PHK
  $('#karyawan_phk').on( "change", function() {
    // alert("oke");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var karyawan_phk = $(this).val();
    $.ajax({
          type: "POST",
          url: "{{route('get_karyawan_phk')}}",
          dataType: 'json',
          data: {
            karyawan_phk: karyawan_phk
          },
          success: function(data) {
            // alert(data);
            $("#nama_phk").html(data[0]);
            $("#sml").val(data[0]);
            $("#bagian_phk").html(data[1]);
            $("#id_no_phk").html(data[2]);
            $("#department_phk").html(data[3]);
            $("#job_phk").html(data[4]);
            $("#hire_date_phk").html(data[5]);

          },error(){
            alert("error");
          }
      });
  });

  //Signature Menampilkan data karyawan
  $('#modal_signature').on('click', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
          type: "GET",
          url: "{{route('get_signature_employee')}}",
          dataType: 'json',
          success: function(data) {
            // alert(JSON.stringify(data));
            // $("#isi_text").html(data[0]);

            var op = JSON.stringify(data);
            // var op = data[1];
            const obj = JSON.parse(op);
            var html = '';
            var i;
            for(i=0; i < obj.length; i++){
                  html += '<option value="' + obj[i].id +'">'+ obj[i].number_of_employees +' ' + obj[i].name +'</option>';
            }
              $('#signature_employee').html(html);
              // $('#isi_text').text(data[0]);

              // $('#karyawan_phk').html('<option value="get3" id="karyawan_phk3" >Pilih3</option>');
              // $('#karyawan_phk').append('<option value="get3" id="karyawan_phk3" >Pilih3</option>');

          },
          error(){
            alert("error");
          }

    });
  });

  //ROLE ACCESS
  $('.form-check-input').on('click', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: "{{route('changeaccess')}}",
        type: 'POST',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
          document.location.href = "/roles/"+roleId+"/edit" ;
        },error(){
          alert("Coba lagi");
        }
    });
  });

  // Methods 
  $('.method').on('click', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    const roleId = $(this).data('role');
    const methodId = $(this).data('method');
    const val = $(this).val();

    $.ajax({
        url: "{{route('changeaccess_method')}}",
        type: 'POST',
        data: {
            methodId: methodId,
            val: val
        },
        success: function() {
            document.location.href = "/roles/"+roleId+"/edit" ;
        },error(){
            alert("Coba lagi");
        }
    });
  });


    // Histories 
  $('.histories').on('click', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    const id = $(this).data('id');

    $.ajax({
        url: "{{route('histories_view')}}",
        type: 'POST',
        data: {
          id: id,
        },
        success: function(data) {

            $('#proses_date').html(data[0]);
            $('#proses_action').html(data[1]);
            $('#proses_keterangan').html(data[2]);
            $('#proses_oleh').html(data[3]);
            $('#proses_bagian').html(data[4]);

        },error(){
            alert("Coba lagi");
          }
    });
   

  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  });
 
  </script>


</body>
</html>
