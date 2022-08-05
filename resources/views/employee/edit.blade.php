<!-- Begin Page Content -->
<div class="container-fluid">

   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Room 
                <a href="{{ url('company') }}" class="float-right btn btn-success btn-sm">View All</a>   
            </h6>
        </div>
        
        @if (Session::has('success'))
        
        <p class="text-success"> {{ Session('success') }}</p>

        @endif
        <div class="card-body">
            <div class="table-responsive">
                <form  method="POST" enctype="multipart/form-data" action="{{ url('employee/$employee->id') }}">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <tr>
                            <th>Employee name</th>
                            <td><input name="name" type="text" class="form-control"></td>
                          
                        </tr>

                        <tr>
                            <th>Employee email</th>
                            <td><input name="email" type="email" class="form-control"></td>
                        </tr>

                         <tr>
                            <th>Company ID</th>
                            <td><input name="company_id" type="text" class="form-control"></td>
                        </tr>

                         <tr>
                            <th>Employee image</th>
                            <td><input name="image" type="file" class="form-control"></td>
                        </tr>

                        

                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-primary">
                            </td>
                        </tr>

                </table>
                </form>
                
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
