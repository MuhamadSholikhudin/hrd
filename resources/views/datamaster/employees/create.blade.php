@extends('layouts.main')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Karyawan</h1>
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

                <h3 class="profile-username text-center">Nama Karyawan</h3>
                <p class="text-muted text-center">
                  Jabatan <br>
                  Departemen
                </p>
                <div class="form-group">
                      <select class="form-control">
                        <option>Karyawan baru</option>
                        <option>Mantan karyawan</option>
                      </select>
                    </div>
                <!-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> -->

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

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
              </div>
              
            </div> -->
            
          </div>
          

          <!-- NAV PILLS -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <!-- <li class="nav-item"><a class="nav-link active" href="#input_personal" data-toggle="tab">Personal</a></li> -->
                    <li class="nav-item"><a class="nav-link active" href="#input_personal" data-toggle="tab">Personal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_identitas" data-toggle="tab">Identitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_pendidikan" data-toggle="tab">Pendidikan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_keluarga" data-toggle="tab">Keluarga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_informasi_karyawan" data-toggle="tab">Informasi Karyawan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_bank" data-toggle="tab">BANK</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_bpjs" data-toggle="tab">BPJS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_gaji" data-toggle="tab">Gaji</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_pajak" data-toggle="tab">Pajak</a></li>
                    <li class="nav-item"><a class="nav-link" href="#input_konfirmasi" data-toggle="tab">Konfirmasi</a></li>
                    <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                </ul>
              </div><!-- /.card-header -->
            <form role="form" action="/datamaster/employees" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="input_personal">
                        @csrf
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                            @error('name') 
                            <div  class="invalid-feedback">
                           {{ $message }}.
                         </div>
                           @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="place_of_birth" class="col-sm-2 col-form-label">Tempat lahir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                        </div>
                        <label for="place_of_birth" class="col-sm-2 col-form-label">Tanggal lahir</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="place_of_birth" name="date_of_birth" required > 
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                          <div class="col-sm-10">
                              <div class="col-sm-6">
                                  <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                          <input type="radio" id="male" name="gender" value="M" checked="">
                                          <label for="male"> Male
                                          </label>
                                      </div>
                                      <div class="icheck-primary d-inline">
                                          <input type="radio" id="female" name="gender" value="F">
                                          <label for="female"> Female
                                          </label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="religion" required>
                            <option value="MOSLEM">MOSLEM</option>
                            <option value="BUDHIST">BUDHIST</option>
                            <option value="CATHOLIC">CATHOLIC</option>
                            <option value="CHRISTIAN">CHRISTIAN</option>
                            <option value="HINDU">HINDU</option>
                            <option value="KEPERCAYAAN">KEPERCAYAAN</option>
                            <option value="NONE">NONE</option>
                          </select>                                      
                        </div>
                      </div>
                  </div>
                  
                  <div class="tab-pane" id="input_identitas">
                      <div class="form-group row">
                          <label for="national_id" class="col-sm-2 col-form-label">Nomer KTP</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="national_id" name="national_id" placeholder="Nomer KTP" required>
                          </div>
                        </div>               
                    
                    <div class="form-group row">
                      <label for="address_province" class="col-sm-2 col-form-label">Provinsi </label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="address_province"   name="address_province" required>
                      </div>
                      <label for="address_city" class="col-sm-2 col-form-label">Kota </label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="address_city" name="address_city" required>
                      </div>
                      <label for="address_district" class="col-sm-2 col-form-label">Kecamatan </label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="address_district" name="address_district" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="address_village" class="col-sm-2 col-form-label">Desa </label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="address_rw"   name="address_rw" required>
                      </div>
                      <label for="address_rt" class="col-sm-1 col-form-label">RT </label>
                      <div class="col-sm-1">
                        <input type="text" class="form-control" id="address_rt" name="address_rt" required>
                      </div>
                      <label for="address_rt" class="col-sm-1 col-form-label">RW </label>
                      <div class="col-sm-1">
                        <input type="text" class="form-control" id="address_rw" name="address_rw" required>
                      </div>

                    </div>
                    <div class="form-group row">
                        <label for="address_jalan" class="col-sm-2 col-form-label">Alamat Jalan</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="address_jalan" name="address_jalan" required>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="phone" class="col-sm-2 col-form-label">Nomer Telephone</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email </label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="input_pendidikan">
                  <div class="form-group row">
                    <label for="hire_date" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="educate" required>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">Sarjana / S-1</option>
                        <option value="S2">Magister / S-2</option>
                      </select>
                    </div>
                    <label for="major" class="col-sm-2 col-form-label">Jurusan </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="major" name="major" >
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="input_keluarga">
                  <div class="form-group row">
                    <label for="biological_mother_name" class="col-sm-4 col-form-label">Nama Ibu Kandung</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="biological_mother_name" name="biological_mother_name" required>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="input_informasi_karyawan">
                  <div class="tab-pane" id="">
                    <div class="form-group row">
                      <label for="number_of_employees" class="col-sm-3 col-form-label">Nomor Induk Karyawan</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="number_of_employees" name="number_of_employees" placeholder="Nomer Induk Karyawan" required>
                      </div>
                      <label for="finger_id" class="col-sm-2 col-form-label">Finger ID</label>
                      <div class="col-sm-3">
                          <input type="text" class="form-control" id="finger_id" name="finger_id" placeholder="Finger ID" required>
                      </div>
                    </div>
                    <div class="form-group row">

                      </div> 
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Job level</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" style="width: 100%;" name="job_id">
                            <option value="">Pilih</option>
                            @foreach ($jobs as $job)
                              <option value="{{ $job->id }}">{{ $job->code_job_level }} / {{ $job->job_level }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <label for="inputName" class="col-sm-2 col-form-label">Departemen</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" name="department_id" style="width: 100%;">
                              <option value="">Pilih</option>
                              @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->department }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">

                    </div>
                    
                      <div class="form-group row">
                        <label for="hire_date" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="bagian"   name="bagian" required>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="hire_date" class="col-sm-3 col-form-label">cELL</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="cell" name="cell" required>
                        </div>
                      </div> 
                      
                      
                      <div class="form-group row">
                        <label for="hire_date" class="col-sm-3 col-form-label">Tanggal Masuk Kerja </label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" id="hire_date"   name="hire_date" required>
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <label for="hire_date" class="col-sm-3 col-form-label">Tipe Karyawan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="employee_type" required>
                              <option value="1-Permanent">1-Permanent</option>
                              <option value="5-Probation">5-Probation</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="end_of_contract" class="col-sm-3 col-form-label">End of Contract </label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" id="end_of_contract"   name="end_of_contract" required>
                        </div>
                      </div>    
                      <div class="form-group row">
                        <label for="out" class="col-sm-3 col-form-label">Date Out </label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" id="out"   name="date_out" >
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="exit_statement" class="col-sm-3 col-form-label">Out </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exit_statement" name="exit_statement" required>
                        </div>
                      </div> 
                    </div>
                </div>
                
                <div class="tab-pane" id="input_bpjs">
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-3 col-form-label">BPJS Ketenagakerjaan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="bpjs_ketenagakerjaan" id="inputName2" placeholder="Name">
                    </div>
                    <label for="inputName2" class="col-sm-2 col-form-label">Tanggal gabung</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="date_bpjs_ketenagakerjaan" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-3 col-form-label">BPJS Kesehatan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="bpjs_kesehatan" id="inputName2" placeholder="Name">
                    </div>
                    <label for="inputName2" class="col-sm-2 col-form-label">Tanggal gabung</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="date_bpjs_kesehatan" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="input_bank">
                  <div class="form-group row">
                    <label for="bank_name" class="col-sm-3 col-form-label">Nama Bank</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank_branch" class="col-sm-3 col-form-label">Cabang Bank</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="bank_branch" name="bank_branch" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank_account_name" class="col-sm-3 col-form-label">Nama Akun Bank</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank_account_number" class="col-sm-3 col-form-label">Nomer Rekening</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" required>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="input_gaji">
                  <div class="form-group row">
                    <label for="basic_salary" class="col-sm-3 col-form-label">Basic Salary</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="basic_salary" name="basic_salary" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="positional_allowance" class="col-sm-3 col-form-label">Tunjangan Jabatan</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="positional_allowance" name="positional_allowance" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="transportation_allowance" class="col-sm-3 col-form-label">Tunjangan Transportasi</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="transportation_allowance" name="transportation_allowance" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="attendance_allowance" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" required>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="hire_date" class="col-sm-3 col-form-label">Grade</label>
                      <div class="col-sm-2">
                          <select class="form-control" name="grade_salary" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>
                      </div>
                      <label for="grade_total" class="col-sm-2 col-form-label">Total Grade</label>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" id="grade_total" name="grade_total" required>
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-primary "><i class="fas fa-arrows-rotate"></i> Generate</button>
                      </div>

                    </div>

                    <hr>
                    {{-- <div class="form-group row mt-3">
                        <label for="basic_salary" class="col-sm-3 col-form-label">Basic Salary</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="basic_salary" name="basic_salary" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="positional_allowance" class="col-sm-3 col-form-label">Tunjangan Jabatan</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="positional_allowance" name="positional_allowance" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="transportation_allowance" class="col-sm-3 col-form-label">Tunjangan Transportasi</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="transportation_allowance" name="transportation_allowance" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="attendance_allowance" class="col-sm-3 col-form-label">Tunjangan Kehadiran</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" required>
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="attendance_allowance" class="col-sm-3 col-form-label">Gaji Akhir</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="attendance_allowance" name="attendance_allowance" required>
                          </div>
                        </div> --}}
                
                      </div>

                <div class="tab-pane" id="input_pajak">
                  <div class="form-group row">
                      <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
                      <div class="col-sm-4">
                          <input type="number" class="form-control" id="npwp" name="npwp" required>
                      </div>
                      <label for="kode_ptkp" class="col-sm-2 col-form-label">Kode PTKP</label>
                      <div class="col-sm-4">
                          <select class="form-control" name="kode_ptkp" required>
                            <option value="TK">TK</option>
                            <option value="K/0">K/0</option>
                            <option value="K/1">K/1</option>
                            <option value="K/2">K/2</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="year_ptkp" class="col-sm-2 col-form-label">Tanggal PTKP</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="year_ptkp" name="year_ptkp" required>
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="input_konfirmasi">
                    <button type="submit" class="btn btn-primary col start">
                        <i class="fas fa-plus"></i>
                        <span>Simpan</span>
                      </button>

                </div>
                </div>

              </div>
            </form>
            </div>

          </div>
        </div>

      </div>
</section>



</div>

@endsection