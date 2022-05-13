@extends('layouts.main')

@section('container')
  
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
              <li class="breadcrumb-item active">Kayawan Page</li>
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
                        <!-- <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture"> -->
                        <!-- <img class="profile-user-img img-fluid img-circle" src="file://10.10.40.190/database%20foto%20karyawan/1604000017.jpg" alt="User profile picture"> -->
                        <!-- file://10.10.40.190/database%20foto%20karyawan/{{$employee->number_of_employees}}.jpg -->
                        <img class="profile-user-img img-fluid img-circle" src="http://10.10.100.148/hwi/Photo/10000/{{  $employee->number_of_employees  }}.jpg" alt="User profile picture">

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
      
                      <a href="#" class="btn btn-primary btn-block"><b>{{ $employee->status_employee }}</b></a>
                      
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
                            <td valign="top">Pend Terakhir</td>
                            <td valign="top">: {{  $employee->educate  }}</td>
                          </tr>
                          <tr>
                            <td valign="top">Jurusan</td>
                            <td valign="top">: {{  $employee->major  }}</td>
                          </tr>
                        </table>
                      <hr>
                      <strong><i class="fas fa-book mr-1"></i> Email & Phone</strong>
                        <table>
                          <tr>
                            <td valign="top">Email</td>
                            <td valign="top">: {{  $employee->email  }}</td>
                          </tr>
                          <tr>
                            <td valign="top">Phone</td>
                            <td valign="top">: {{  $employee->phone  }}</td>
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
                                <input type="text" class="form-control" id="exit_statement" name="exit_statement" value="{{  $employee->exit_statement  }}" required>
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
                          <h3 class="card-title">Gaji dan Tunjangan</h3>
                        </div>
                        <div class="card-body row">
                          <div class="col-md-6">                          
                            <div class="form-group row">
                                <label for="basic_salary" class="col-sm-5 col-form-label">Basic Salary</label>
                                <div class="col-sm-7">
                                  <input type="number" class="form-control" id="basic_salary" name="basic_salary" value="{{ $salary->basic_salary }}" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="positional_allowance" class="col-sm-5 col-form-label">Tunjangan Jabatan</label>
                                <div class="col-sm-7">
                                  <input type="number" class="form-control" id="positional_allowance" name="positional_allowance" value="{{ $salary->positional_allowance }}" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="transportation_allowance" class="col-sm-5 col-form-label">Tunjangan Transportasi</label>
                                <div class="col-sm-7">
                                  <input type="number" class="form-control" id="transportation_allowance" name="transportation_allowance" value="{{ $salary->transportation_allowance }}" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="attendance_allowance" class="col-sm-5 col-form-label">Tunjangan Kehadiran</label>
                                <div class="col-sm-7">
                                  <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" value="{{ $salary->attendance_allowance }}" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="hire_date" class="col-sm-5 col-form-label">Grade</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="grade_salary" required>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="grade_total" class="col-sm-5 col-form-label">Total Grade</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="grade_total" name="grade_total" required>
                                </div>
      
                                </div>
                              </div>

                                <hr>

                              <div class="col-md-6"> 
                                <div class="form-group row">
                                  <label for="basic_salary" class="col-sm-5 col-form-label">Basic Salary</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control" id="basic_salary" name="basic_salary" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="positional_allowance" class="col-sm-5 col-form-label">Tunjangan Jabatan</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control" id="positional_allowance" name="positional_allowance" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="transportation_allowance" class="col-sm-5 col-form-label">Tunjangan Transportasi</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control" id="transportation_allowance" name="transportation_allowance" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="attendance_allowance" class="col-sm-5 col-form-label">Tunjangan Kehadiran</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="attendance_allowance" class="col-sm-5 col-form-label">Gaji Akhir</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" required>
                                  </div>
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
          @endsection