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
          <div class="col-sm-6 mx-auto">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add Navigation Menu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
              <form class="form-horizontal" method="POST" action="{{ route('navigation.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="slug" placeholder="Enter Slug" name="slug">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mainMenu" class="col-sm-2 col-form-label">Main Menu</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="parent_id">
                            <option value = 0 >None</option>
                            @if ($getMenus)
                                @foreach ($getMenus as $menu)
                                    <option value = {{ $menu->id }} >{{ $menu->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create</button>
                  <button type="reset" class="btn btn-default" onclick="window.location='{{ route('navigation.index') }}'">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
              <!-- form ends-->
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
@endsection
