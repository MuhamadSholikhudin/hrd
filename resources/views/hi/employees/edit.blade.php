

<!-- Main content -->
<section class="content">

    <div  class="row">
            <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Add Employees</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="/hi/employees/{{  $employee->id  }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Number Of Employees</label>
                                <input type="number" class="form-control" name="number_of_employees" value="{{  $employee->number_of_employees  }}" id="exampleInputPassword1" placeholder="Password">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{  $employee->email  }}" id="exampleInputEmail1" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name" value="{{  $employee->name  }}" id="name" placeholder="Name">
                                </div>
                              <div class="form-group">
                                  <label for="phone_number">Phone Number</label>
                                  <input type="text" class="form-control" name="phone_number" value="{{  $employee->phone_number  }}" id="phone_number" placeholder="Phone Number">
                                </div>
                          {{-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div> --}}
                          {{-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div> --}}
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
        
                  </div>
    </div>



</section>
<!-- /.content -->

