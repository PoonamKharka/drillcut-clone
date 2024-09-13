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
          <div class="col-sm-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Modify Navigation Menu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="title" value="{{  $menuDetails->title }}" name="title" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Menu Items</label>
                  </div>
                  <div class="form-group row">
                    <table  class="table table-bordered table-hover">
                      <thead>
                        <th>Title</th>
                        <th>Slug</th>
                      </thead>
                      <tbody>
                        @foreach ($getMenus as $menus)
                          <tr>
                            <td>
                              {{ $menus->title  }}
                            </td>
                            <td>
                              {{ $menus->slug  }}
                            </td>
                            <td>
                              <button class="btn btn-sm btn-primary detail-btn" data-toggle="modal" data-target="#myModal" data-id="{{ $menus->id }}"><i class="fas fa-pencil-alt" ></i></button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="reset" class="btn btn-default" onclick="window.location='{{ route('navigation.index') }}'">Back</button>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Button trigger modal -->
          <!-- Modal starts-->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Menu item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <form id="menuForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="menu-id" name="id">
                    <div class="form-group">
                      <label for="menu_title" class="col-form-label">Title</label>
                      <input type="text" class="form-control" id="menu-title" name="title">
                    </div>
                    <div class="form-group">
                      <label for="menu_slug" class="col-form-label">Slug</label>
                      <input type="text" class="form-control" id="menu-slug" name="slug">
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
                {{-- <div class="modal-footer">
                  
                </div> --}}
              </div>
            </div>
          </div>
          <!--Modal ends-->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
  
  $(document).ready(function() {
    $('.detail-btn').click(function() {
      const id = $(this).attr('data-id');
      var url = '{{ route("navigation.show", ":id") }}';
      url = url.replace(':id',id);
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          "id": id
        },
        success:function(data) {
          $('#menu-id').val(data.id);
          $('#menu-title').val(data.title);
          $('#menu-slug').val(data.slug);
        }
      })
    });

    $('#menuForm').submit(function(e){
      e.preventDefault();
      var itemId = $('#menu-id').val();
      var formData = $(this).serialize(); // Collect form data
      var urlupdate = '{{ route("navigation.update", ":id") }}';
      urlupdate = urlupdate.replace(':id',itemId);
      
      $.ajax({
        type: "POST",
        url: urlupdate,
        data: formData,
        success: function(response) {
                alert('Record updated successfully!');
                location.reload(true);
                $('#myModal').modal('hide');

            },
            error: function(err) {
                alert('Error updating record');
            }
      });
    });
  });
</script>
@endsection
