<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRD | HWI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">HRD IT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/datamaster/employees" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/bpjs" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>BPJS</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./gaji_tunjangan.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>GAJI / TUNJANGAN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/promotions" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>PROMOSI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/demotions" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>DEMOSI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/mutations" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>MUTASI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/jobs" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>JOB LEVEL</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/departments" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>DEPARTEMEN</p>
              </a>
            </li>
          </ul>
        </li>

          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="../gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/e-commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../examples/login.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/register.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/forgot-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Forgot Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/recover-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../examples/blank.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-3">
      
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                      </div>
      
                      <h4 class="profile-username text-center">{{  $employee->number_of_employees  }}</h4>
                      <h4 class="profile-username text-center">{{  $employee->name  }}</h4>
                          <p class="text-muted text-center">{{ $employee->job->job_level }} <br>
                                {{ $employee->department->department }}
                          </p>
                          
                      <!-- <div class="form-group">
                            <select class="form-control">
                              <option>Karyawan baru</option>
                              <option>Mantan karyawan</option>
                            </select>
                          </div> -->
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Finger ID</b> <a class="float-right">{{  $employee->finger_id  }}</a>
                        </li>
                      </ul>
      
                      <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
      
                  <!-- About Me Box -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Identitas</h3>
                    </div>
                    
                    <div class="card-body mr-0">

                      <strong><i class="fas fa-address-card mr-1"></i> Kartu Tanda Penduduk</strong>
      
                      <!-- <p class="text-muted"> -->
                        <!-- NIK : 9823642304 <br>
                        TTL : Jepara, 1 januari 1990 <br>
                        Jenis Kelamin : M <br>              
                        Alamat : jalan, rt rw desa kecamatan kota, provinsi <br>
                        Agama : Islam <br>
                        Status nikah : Jomblo<br> -->
                        <table>
                            <tr>
                                <td valign="top">NIK</td>
                                <td valign="top">: {{  $employee->national_id  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">TTL</td>
                                <td valign="top">: {{  $employee->place_of_birth  }}, {{  $employee->date_of_birth  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">Jenis Kelamin</td>
                                <td valign="top">: {{  $employee->gender  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">Alamat</td>
                                <td valign="top">: {{  $employee->address_jalan  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">Agama</td>
                                <td valign="top">: {{  $employee->religion  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">Status nikah</td>
                                <td valign="top">: {{  $employee->marital_status  }}</td>
                              </tr>
                              <tr>
                                <td valign="top">Ibu Kandung</td>
                                <td valign="top">: {{  $employee->biological_mothers_name  }}</td>
                              </tr>
                        </table>

                      <!-- </p> -->
      
                      <hr>
                      <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>
                        <table>
                          <tr>
                            <td>Pend Terakhir</td>
                            <td>: {{  $employee->educate  }}</td>
                          </tr>
                          <tr>
                            <td>Jurusan</td>
                            <td>: {{  $employee->major  }}</td>
                          </tr>
                        </table>
                      <hr>
                      <strong><i class="fas fa-book mr-1"></i> Email & Phone</strong>
                        <table>
                          <tr>
                            <td>Email</td>
                            <td>: {{  $employee->email  }}</td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td>: {{  $employee->phone  }}</td>
                          </tr>
                        </table>
                      
      
<!--                       <hr>
      
                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
      
                      <p class="text-muted">Malibu, California</p>
      
                      <hr>
      
                      <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
      
                      <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                      </p>
      
                      <hr>
      
                      <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
      
                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                     -->
                    </div>
                    
                  </div>
                  
                </div>
                
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Informasi Karyawan</h3>
                        </div>
                        <div class="card-body">
                          <!-- Date -->
                          <form class="form-horizontal">
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-3 col-form-label">Nomer Induk Karyawan</label>
                              <div class="col-sm-3">
                                  <input type="email" class="form-control" id="inputName" placeholder="Name" value="{{  $employee->number_of_employees  }}" required>
                              </div>

                              <label for="end_of_contract" class="col-sm-3 col-form-label">End of Contract </label>
                              <div class="col-sm-3">
                                <input type="date" class="form-control" id="end_of_contract" name="end_of_contract" value="{{  $employee->end_of_contract  }}" required>
                              </div>
                            </div>
                              
                            <div class="form-group row">
                              <label for="hire_date" class="col-sm-3 col-form-label">Tanggal Masuk Kerja </label>
                              <div class="col-sm-3">
                                <input type="date" class="form-control" id="hire_date"   name="hire_date" value="{{  $employee->hire_date  }}" required>
                              </div>

                              <label for="out" class="col-sm-3 col-form-label">Date Out </label>
                              <div class="col-sm-3">
                                <input type="date" class="form-control" id="out"   name="out" value="{{  $employee->date_out  }}" required>
                              </div>

                            </div>
                                                                         
                            <div class="form-group row">
                              <label for="hire_date" class="col-sm-3 col-form-label">Tipe Karyawan</label>
                              <div class="col-sm-3">
                                    <input type="text" class="form-control" id="out"   name="out" value="{{  $employee->employee_type  }}" required>
                              </div>

                              <label for="exit_statement" class="col-sm-3 col-form-label">Out </label>
                              <div class="col-sm-3">
                                <input type="text" class="form-control" id="exit_statement" name="exit_statement" value="{{  $employee->employee_type  }}" required>
                              </div>
                            </div>
    
                          </form>
                        <!-- /.card-body -->
                      </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">BANK</h3>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label">Nama Bank</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{  $employee->bank_name  }}" required>
                            </div>
                            <label for="bank_account_name" class="col-sm-3 col-form-label">Nama Akun Bank</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="{{  $employee->bank_account_name  }}" required>
                            </div>

                          </div>
                          <div class="form-group row">
                            <label for="bank_branch" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="{{  $employee->bank_branch  }}" required>
                            </div>

                            <label for="bank_account_number" class="col-sm-3 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="{{  $employee->bank_account_number  }}" required>
                            </div>
                          </div>                                    

                        </div>
                    </div>

                    
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">BPJS</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">BPJS Ketenagakerjaan</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputName2" value="{{  $employee->bpjs_ketenagakerjaan  }}" placeholder="Name">
                                </div>
  
                                <label for="inputName2" class="col-sm-2 col-form-label">Tanggal gabung</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="inputName2" value="{{  $employee->date_bpjs_ketenagakerjaan  }}" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">BPJS Kesehatan</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputName2" value="{{  $employee->bpjs_kesehatan  }}" placeholder="Name">
                                </div>
                                <label for="inputName2" class="col-sm-2 col-form-label">Tanggal gabung</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="inputName2" value="{{  $employee->date_bpjs_kesehatan  }}" placeholder="Name">
                                </div>
                            </div>                       

                        </div>
                    </div>




                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Pajak</h3>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                              <label for="inputName2" class="col-sm-2 col-form-label">NPWP</label>
                              <div class="col-sm-4">
                                  <input type="number" class="form-control" id="npwp" name="npwp" value="{{  $employee->npwp  }}" required>
                              </div>

                              <label for="inputName2" class="col-sm-2 col-form-label">Kode PTKP</label>
                              <div class="col-sm-3">
                                  <select class="form-control" name="kode_ptkp" required>
                                      <option value="TK">TK</option>
                                      <option value="K/0">K/0</option>
                                      <option value="K/1">K/1</option>
                                      <option value="K/2">K/2</option>
                                    </select>
                              </div>
                          </div>
                          <div class="form-group row">                           
                              <label for="inputName2" class="col-sm-2 col-form-label">Tanggal PTKP</label>
                              <div class="col-sm-3">
                                  <input type="date" class="form-control" value="{{  $employee->year_ptkp  }}" id="inputName2" placeholder="Name">
                              </div>
                          </div>                       

                        </div>
                    </div>
                 
                    </div>    
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </section>

          <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.3-pre
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<script src="../../dist/js/scriptdewe.js"></script>

<!-- jquery-validation -->
<script>
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
    $('#quickForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        terms: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        terms: "Please accept our terms"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
  </script>
</body>
</html>
