@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Menus</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Menus</li>
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
                <div class="card-tools">
                  <a href="{{ route('navigation.create') }}" class="btn btn-block btn-success btn-sm" >Add menu</a> 
                </div>
              </div>
              @if (session('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                    {{ session('success') }}
                </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table id="y_dataTables" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Menu items</th>
                    <th>Action</th>
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
             ajax: "{{ route('navigation.index') }}",
             columns: [
                      { data: 'title', name: 'title' },
                      { data: 'menu_items' , name: 'menu_items'},
                      { data: 'action', name: 'action', orderable: false, searchable: false},
                   ]
          });
       });
});

  </script>
@endsection
