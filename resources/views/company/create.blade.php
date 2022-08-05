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
                <form  method="POST" enctype="multipart/form-data" action="{{ url('company') }}">
                    @csrf
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <tr>
                            <th>Company name</th>
                            <td><input name="name" type="text" class="form-control"></td>
                          
                        </tr>

                        <tr>
                            <th>Company address</th>
                            <td><input name="address" type="text" class="form-control"></td>
                        </tr>

                         <tr>
                            <th>Company logo</th>
                            <td><input name="logo" type="file" class="form-control"></td>
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
