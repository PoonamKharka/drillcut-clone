@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Customers</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </div>
      <!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="y_dataTables" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Customer name</th>
                    <th>Location</th>
                    <th>Status</th>
                    {{-- <th>Customer</th>
                    <th>Total Price</th> --}} 
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script type="text/javascript">
$(function() { 
  $(document).ready( function () {
      $('#y_dataTables').DataTable({
             processing: false,
             serverSide: true,
             ajax: "{{ route('users.index') }}",
             columns: [
                      { data: 'customer_name', name: 'customer_name' },
                      { data: 'location', name: 'location' },
                      { data: 'status', name: 'status' },
                    //   { data: 'price', name: 'price' },
                    //   { data: 'status', name: 'status' },
                    //   { data: 'customer', name: 'customer' }
                   ]
          });
       });
});

  </script>
@endsection
