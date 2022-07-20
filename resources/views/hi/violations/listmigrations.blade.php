@extends('layouts.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Pelanggaran Lama</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pelanggaran Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                @if (session()->has('success'))
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Success</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{ session('success') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                @elseif(session()->has('danger'))
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Peringatan !</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{ session('danger') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                @else
                @endif
            </div>


            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                           
                    <div class="card-tools">
                        <form action="/hiviolations/oldsp">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>NO ID</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>NO SP</th>
                                <th>Tanggal Laporan</th>
                                <th>Tanggal SP</th>
                                <th>Tanggal Berakhir</th>
                                <th>Selang </th>
                                <th>Pelangaran</th>
                                <th>Pasal</th>
                                <th>Pasal Akumulasi</th>
                                <th>Status </th>
                                <th>Penyampain</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($violations as $violation)
                                <tr>
                                    <td>{{ $violation->id }}</td>
                                    <td><a href="/violations/{{ $violation->employee_id }}/edit"
                                            class="text-dark">{{ number_of_employees($violation->employee_id) }}</a>
                                    </td>
                                    <td><a href="/violations/{{ $violation->employee_id }}/edit"
                                            class="text-dark">{{ name($violation->employee_id) }}</a></td>
                                    <td>
                                        <?php 
                                            $date_y = date_create($violation->date_of_violation);
                                            $date_year = date_format($date_y,"Y"); 
                                        ?>
                                        {{  $violation->no_violation.'/SP-HRD/'. $violation->violation_ROM.'/'.$date_year }} 
                                    </td>
                                    <td> {{ tanggal_pelanggaran($violation->reporting_date) }} </td>

                                    <td>{{ tanggal_pelanggaran($violation->date_of_violation) }} </td>
                                    <td>{{ tanggal_pelanggaran($violation->date_end_violation) }}</td>
                                    <td>{{ $violation->type_of_violation }}</td>
                                    <td> {{ pasal($violation->alphabet_id) }} </td>
                                    <td>
                                        <!-- {{ pasal($violation->alphabet_id) }} -->
                                        <?php if ($violation->alphabet_accumulation !== null) {
                                            echo pasal($violation->alphabet_accumulation);
                                        } else {
                                        } ?>
                                    </td>
                                    <td>{{ $violation->violation_status }}</td>
                                    <td style="align:center;">


                                    </td>
                                    <td>
                                        <a href="/violations/{{ $violation->id }}" target="_blank"
                                            class="btn  btn-outline-primary">
                                            Cetak
                                        </a>
                                        <form action="{{ route('cancelviolations') }}" method="POST"
                                            class="d-inline ">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $violation->id }}">
                                            <button type="submit" class="btn btn-outline-success"
                                                onclick="return confirm(' Are you sure process violation data ?')">
                                                <?php if (
                                            $violation->violation_status ==
                                            'active'
                                        ) { ?>
                                                Cancel
                                                <?php } else { ?>
                                                Activate
                                                <?php } ?>
                                            </button>
                                        </form>

                                        <a href="/hiviolations/{{ $violation->id }}/getedit"
                                            class="btn  btn-outline-warning">
                                            Edit
                                        </a>
                                        <form action="{{ route('deleteviolations') }}" method="POST"
                                            class="d-inline ">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $violation->id }}">
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm(' Are you sure delete data ?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <h3 class="card-title">Total : {{ $count }}</h3>
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $violations->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
    </div>


    </section>
    <!-- /.content -->
@endsection
