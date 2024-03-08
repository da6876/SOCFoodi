<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- base:css -->

    @include('admin.layouts.header_link_file')
</head>


<body>
<div class="container-scroller">

@include('admin.layouts.nav_bar_top')

<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">

                    <div class="col-lg-12 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6 mb-4 mb-xl-0">

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center justify-content-md-end">
                                            <div class="pe-1 mb-3 mb-xl-0">
                                                <button type="button" onclick="showModel()" class="btn btn-outline-inverse-info btn-icon-text">
                                                    Add New Product
                                                    <i class="mdi mdi-loupe btn-icon-append"></i>
                                                </button>
                                            </div>
                                            <div class="pe-1 mb-3 mb-xl-0">
                                                <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                                    Print
                                                    <i class="mdi mdi-printer btn-icon-append"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title">Product Info Data table</h4>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Product Short Desc</th>
                                                    <th>Product Desc</th>
                                                    <th>Current Price</th>
                                                    <th>Previous Price</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Update Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($ProductInfoData as $article)
                                                    <tr>
                                                        <td>{{$article->product_id}}</td>
                                                        <td>{{$article->product_name}}</td>
                                                        <td>{{$article->product_short_desc}}</td>
                                                        <td>{{$article->product_desc}}</td>
                                                        <td>{{$article->current_price}}</td>
                                                        <td>{{$article->previous_price}}</td>
                                                        <td>
                                                            @if($article->product_status=="A")
                                                                <label class="badge badge-success">Active</label>
                                                            @elseif($article->product_status=="I")
                                                                <label class="badge badge-warning">InActive</label>
                                                            @else
                                                                <label class="badge badge-danger">Pending</label>
                                                            @endif
                                                        </td>
                                                        <td>{{$article->create_info}}</td>
                                                        <td>{{$article->update_info}}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary" onclick="editProductInfo('{{$article->product_id}}')">View</button>
                                                            <button class="btn btn-outline-danger" onclick="deleteProductInfo('{{$article->product_id}}')">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="modal fade addProductInfo" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Product Add</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Name</label>
                                                <input type="hidden" id="inProductId" name="inProductId">
                                                <input type="text" class="form-control" id="inProductName" name="inProductName" placeholder="Product Product Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Status</label>
                                                <select id="slProductStatus" name="slProductStatus" class="form-control form-control-lg" required>
                                                    <option value="S">Select Product Status</option>
                                                    <option value="A">Active</option>
                                                    <option value="I">InActive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Product Type</label>
                                                <select id="slProductType" name="slProductType" class="form-control form-control-lg" required>
                                                    <option value="S">Select Product Type</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Product Category</label>
                                                <select id="slProductCategory" name="slProductCategory" class="form-control form-control-lg" required>
                                                    <option value="S">Select Category</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Product Sub-Category</label>
                                                <select id="slProductSubCategory" name="slProductSubCategory" class="form-control form-control-lg" required>
                                                    <option value="S">Select Product Sub-Category</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Short Desc</label>
                                                <input type="text" class="form-control" id="inProductShortDesc" name="inProductShortDesc">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Desc</label>
                                                <input type="text" class="form-control" id="inProductDesc" name="inProductDesc">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Current Price</label>
                                                <input type="text" class="form-control" id="inProductCurrentPrice" name="inProductCurrentPrice">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Product Previous Price</label>
                                                <input type="text" class="form-control" id="inProductPreviousPrice" name="inProductPreviousPrice">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="inProductImageOne">Image One</label>
                                                <input type="file" class="dropify" id="inProductImageOne" name="inProductImageOne"  />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inProductImageTwo">Image Two</label>
                                                <input type="file" class="dropify" id="inProductImageTwo" name="inProductImageTwo" />
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="addProductInfo()" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('admin.layouts.footer_bar')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('admin.layouts.footer_link_files')
<script>
    function showModel() {
        $('.addProductInfo form')[0].reset();
        $('.addProductInfo').modal('show');
    }

    function addProductInfo() {
        url = "{{ url('ProductInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".addProductInfo form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.addProductInfo').modal('hide');
                    swal("Success", dataResult.statusMsg).then((value) => {
                        window.location.reload();
                    });

                    $('.addProductInfo form')[0].reset();
                } else if (dataResult.statusCode == 201) {
                    swal({
                        title: "Oops",
                        text: dataResult.statusMsg,
                        icon: "error",
                        timer: '1500'
                    }).then((value) => {
                        window.location.reload();
                    });
                }
            }, error: function (data) {
                console.log(data);
                swal({
                    title: "Oops",
                    text: data.responseText,
                    icon: "error"
                });
            }
        });
        return false;
    };

    function editProductInfo(id) {
        $(".btnAdd").hide();
        $(".btnUpdate").show();
        $.ajax({
            url: "{{ url('ProductInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                SetSubCategorie(data[0].category_id);
                $('.addProductInfo').modal('show');
                $('.modal-titles').text(data[0].product_name + ' Information');
                $('#slProductType').val(data[0].product_type_id);
                $('#slProductCategory').val(data[0].category_id);
                $('#slProductSubCategory').val(data[0].sub_category_id);
                $('#inProductName').val(data[0].product_name);
                $('#inProductShortDesc').val(data[0].product_short_desc);
                $('#inProductDesc').val(data[0].product_desc);
                $('#inProductCurrentPrice').val(data[0].current_price);
                $('#inProductPreviousPrice').val(data[0].previous_price);
                $('#slProductStatus').val(data[0].product_status);

            }, error: function () {
                swal({
                    title: "Oops",
                    text: "aa",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

    function deleteProductInfo(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ url('ProductInfo') }}" + '/' + id,
                    type: "POST",
                    data: {'_method': 'DELETE', '_token': csrf_token},
                    success: function (data) {
                        console.log(data);
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            $('#Categories-dataTabel').DataTable().ajax.reload();
                            swal({
                                title: "Delete Done",
                                text: "Poof! Your data file has been deleted!",
                                icon: "success",
                                button: "Done"
                            }).then((value) => {
                                window.location.reload();
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    }, error: function (data) {
                        swal({
                            title: "Opps...",
                            text: "Error occured !",
                            icon: "error",
                            button: 'Ok ',
                        }).then((value) => {
                            window.location.reload();
                        });
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    };



    var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
    ShowProTypeForProductURL = "{{ url('ShowProTypeForProduct') }}";
    ShowCatForProductURL = "{{ url('ShowCatForProduct') }}";
    ShowSubCatForProductURL = "{{ url('ShowSubCatForProduct') }}";

    $.ajax({
        url: ShowProTypeForProductURL,
        type: 'POST',
        data: {"_token": csrf_tokens},
        datatype: 'JSON',
        success: function (data) {
            //console.log(data);
            var sub_cat = $.parseJSON(data);
            if (sub_cat != '') {
                var markup = "<option value=''>Select Product Type</option>";
                for (var x = 0; x < sub_cat.length; x++) {
                    markup += "<option value=" + sub_cat[x].product_type_id + ">" + sub_cat[x].product_type_name+ "</option>";
                }
                $("#slProductType").html(markup).show();
            } else {
                var markup = "<option value=''>Select Product Type</option>";
                $("#slProductType").html(markup).show();
            }


        },
        error: function (data) {
            swal({
                title: "Oops",
                text: "Some Thing Is .... !!",
                icon: "error",
                timer: '1500'
            });
        }
    });

    $.ajax({
        url: ShowCatForProductURL,
        type: 'POST',
        data: {"_token": csrf_tokens},
        datatype: 'JSON',
        success: function (data) {
            //console.log(data);
            var sub_cat = $.parseJSON(data);
            if (sub_cat != '') {
                var markup = "<option value=''>Select Product Category</option>";
                for (var x = 0; x < sub_cat.length; x++) {
                    markup += "<option value=" + sub_cat[x].category_id + ">" + sub_cat[x].category_name+ "</option>";
                }
                $("#slProductCategory").html(markup).show();
            } else {
                var markup = "<option value=''>Select Product Category</option>";
                $("#slProductCategory").html(markup).show();
            }


        },
        error: function (data) {
            swal({
                title: "Oops",
                text: "Some Thing Is .... !!",
                icon: "error",
                timer: '1500'
            });
        }
    });

    $("#slProductCategory").change(function () {
        var Categorie_id = $('#slProductCategory :selected').val();
        if (Categorie_id != "")
            SetSubCategorie(Categorie_id);
    });

    function SetSubCategorie(Categorie_id) {
        $.ajax({
            url: ShowSubCatForProductURL,
            type: 'POST',
            data: {'Cat_id': Categorie_id, "_token": csrf_tokens},
            datatype: 'JSON',
            success: function (data) {
                //console.log(data);
                var sub_cat = $.parseJSON(data);
                if (sub_cat != '') {
                    var markup = "<option value=''>Select Product Sub-Category</option>";
                    for (var x = 0; x < sub_cat.length; x++) {
                        markup += "<option value=" + sub_cat[x].sub_category_id + ">" + sub_cat[x].sub_category_name + "</option>";
                    }
                    $("#slProductSubCategory").html(markup).show();
                } else {
                    var markup = "<option value=''>Select Product Sub Category</option>";
                    $("#slProductSubCategory").html(markup).show();
                }


            },
            error: function (data) {
                swal({
                    title: "Oops",
                    text: "Some Thing Is .... !!",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
    }

</script>
</body>
</html>