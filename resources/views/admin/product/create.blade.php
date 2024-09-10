@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">
                Product
            </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
        <a href="{{ route('products.index') }}"> <i class="fas fa-arrow-left"></i> Back </a>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            <div class="col-md-7">
                <!-- general form elements -->
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Short sleeve t-shirt" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="summernote" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">File input</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="productImage" name="productImage">
                            <label class="custom-file-label" for="productImage">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select" name=category>
                        <option selected="selected">E</option>
                        <option>Alaska</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{-- card 2nd --}}
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="pricing">Pricing</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pageTitle">Price</label><br>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" name="price">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pageTitle">Compare at price</label><br>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="tax" value="1">
                            <label for="tax" class="custom-control-label">Charge tax on this product</label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card 2nd --}}

            {{-- card Inventory --}}
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inventory">Inventory</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pageTitle">SKU (Stock Keeping Unit)</label><br>
                                <input type="text" class="form-control" name="sku">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pageTitle">Barcode (ISBN, UPC,GTIN,etc.)</label><br>
                                <input type="text" class="form-control" name="barcode">
                            </div>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="trackQuantity" value="1">
                        <label for="trackQuantity" class="custom-control-label">Track quantity</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="settingOutStock" value="1">
                        <label for="settingOutStock" class="custom-control-label">Continue selling when out of stock</label>
                    </div>
                </div>
            </div>
            {{-- end card Inventory --}}

            {{-- card Shipping --}}
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="inventory">Shipping</label>
                    </div>
                    <div class="form-group row">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="physicalProduc" value="1">
                            <label for="physicalProduc" class="custom-control-label">This is a physical product</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="weight" class="col-sm-4 col-form-label">Weight</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="col-sm-3">
                            <select class="custom-select">
                                <option value="lb">lb</option>
                                <option value="oz">oz</option>
                                <option selected="selected" value="kg">kg</option>
                                <option value="g">g</option>
                            </select>
                          </div>
                    </div>
                </div>
            </div>
            {{-- end card Inventory --}}

            {{-- card 3rd --}}
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="pricing">Metafields</label>
                    </div>
                    <div class="form-group row">
                        <label for="stockClassification" class="col-sm-4 col-form-label">Stock classification</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="stockClassification" name="stockClassification">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="downloadFileName" class="col-sm-4 col-form-label">Download File Names</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="downloadFileName" name="downloadFileName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stockClassification" class="col-sm-4 col-form-label">Sold Qty</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="stockClassification" name="stockClassification">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="inventoryLevel" class="col-sm-4 col-form-label">Inventory Level</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="inventoryLevel" name="inventoryLevel">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="drillcutFire" class="col-sm-4 col-form-label">Drillcut Fire</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="drillcutFire" name="drillcutFire">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="drillcutFire" class="col-sm-4 col-form-label">Logo</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="drillcutFire" name="drillcutFire">
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card 3rd --}}
            {{-- card 4th --}}
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="pricing">Search engine listing</label><br>
                        <caption>Add a title and description to see how this product might appear in a search engine listing</caption>
                    </div>
                    <div class="form-group">
                        <label for="pageTitle">Page title</label><br>
                        <input type="text" class="form-control" id="pageTitle" name="pageTitle">
                    </div>
                    <div class="form-group">
                        <label for="metaDescription">Meta description</label><br>
                        <input type="text" class="form-control" id="metaDescription" name="metaDescription">
                    </div>
                    <div class="form-group">
                        <label for="urlHandle">URL handle</label>
                        <input type="text" class="form-control" id="urlHandle" name="urlHandle">
                    </div>
                </div>
            </div>
            {{-- end card 4th --}}
            </div>
            <!--/.col (left) -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select" name="status">
                                <option selected="selected" value="1">Active</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Publishing</label>
                            <p>Sales channels</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <label>Product organization</label>
                        <div class="form-group">
                            <label for="productType">Product type</label>
                            <input type="text" class="form-control" id="productType" name="productType">
                        </div>
                        <div class="form-group">
                            <label for="vendor">Vendor</label>
                            <select class="custom-select" name="vendorName">
                                <option value="Abey">Abey</option>
                                <option value="Aftek">Aftek</option>
                                <option value="Alpha">Alpha</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="collection">Collections</label>
                            <select class="custom-select" name="collection">
                                <option selected="selected">Active</option>
                                <option>Draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="custom-select" name="tags">
                                <option selected="selected">Active</option>
                                <option>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <p for="tags">Theme template</p>
                            <select class="form-control select2" style="width: 100%;" name="tags">
                                <option selected="selected">Default product</option>
                                <option>Test</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="reset" class="btn btn-default" onclick="window.location='{{ route('products.index') }}'">Cancel</button>
            </div>
            <!-- /.card-footer -->
         </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('textarea'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>
@endsection