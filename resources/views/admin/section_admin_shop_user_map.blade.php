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
                                                <button type="button" onclick="showModel()"
                                                        class="btn btn-outline-inverse-info btn-icon-text">
                                                    New Shop User Map
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

                                <h4 class="card-title">Shop User Map Data table</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Shop Name</th>
                                                    <th>User Name</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Update Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($ShopUserMap as $article)
                                                    <tr>
                                                        <td>{{$article->shopusermap_id}}</td>
                                                        <td>{{$article->shop_name}}</td>
                                                        <td>{{$article->user_name}}</td>
                                                        <td>
                                                            @if($article->map_status=="A")
                                                                <label class="badge badge-success">Active</label>
                                                            @elseif($article->map_status=="I")
                                                                <label class="badge badge-warning">InActive</label>
                                                            @else
                                                                <label class="badge badge-danger">Pending</label>
                                                            @endif
                                                        </td>
                                                        <td>{{$article->create_info}}</td>
                                                        <td>{{$article->update_info}}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary"
                                                                    onclick="editShopUserMap('{{$article->shopusermap_id}}')">
                                                                View
                                                            </button>
                                                            <button class="btn btn-outline-danger"
                                                                    onclick="deleteShopUserMap('{{$article->shopusermap_id}}')">
                                                                Delete
                                                            </button>
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


                    <div class="modal fade addUserType" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Shop User Add</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">User List</label>
                                                <input type="hidden" id="inShopUserMapId" name="inShopUserMapId">
                                                <select id="slUser" name="slUser"
                                                        class="form-control form-control-lg" required>
                                                    <option value="S">Select User</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Shop List</label>
                                                <select id="slShop" name="slShop"
                                                        class="form-control form-control-lg" required>
                                                    <option value="S">Select Shop</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1"> Status</label>
                                                <select id="slStatus" name="slStatus"
                                                        class="form-control form-control-lg" required>
                                                    <option value="S">Select User Type</option>
                                                    <option value="A">Active</option>
                                                    <option value="I">InActive</option>
                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="addShopUserMap()" class="btn btn-success">Submit
                                    </button>
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

    var csrf_tokens = document.querySelector('meta[name="csrf-token"]').content;
    url = "{{ url('ShowShopList') }}";
    $.ajax({
        url: url,
        type: 'POST',
        data: {"_token": csrf_tokens},
        datatype: 'JSON',
        success: function (data) {
            //console.log(data);
            var sub_cat = $.parseJSON(data);
            if (sub_cat != '') {
                var markup = "<option value=''>Select Shop</option>";
                for (var x = 0; x < sub_cat.length; x++) {
                    markup += "<option value=" + sub_cat[x].shop_id + ">" + sub_cat[x].shop_name+' || '+sub_cat[x].ower_name + "</option>";
                }
                $("#slShop").html(markup).show();
            } else {
                var markup = "<option value=''>Select Shop</option>";
                $("#slShop").html(markup).show();
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
    url = "{{ url('ShowUserList') }}";
    $.ajax({
        url: url,
        type: 'POST',
        data: {"_token": csrf_tokens},
        datatype: 'JSON',
        success: function (data) {
            //console.log(data);
            var sub_cat = $.parseJSON(data);
            if (sub_cat != '') {
                var markup = "<option value=''>Select User</option>";
                for (var x = 0; x < sub_cat.length; x++) {
                    markup += "<option value=" + sub_cat[x].user_info_id + ">" + sub_cat[x].user_name +' || '+ sub_cat[x].phone_no+ "</option>";
                }
                $("#slUser").html(markup).show();
            } else {
                var markup = "<option value=''>Select User</option>";
                $("#slUser").html(markup).show();
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


    function showModel() {
        $('.addUserType').modal('show');
        $('.addUserType form')[0].reset();
    }

    function addShopUserMap() {
        url = "{{ url('ShopUserMap') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".addUserType form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.addUserType').modal('hide');
                    swal("Success", dataResult.statusMsg).then((value) => {
                        window.location.reload();
                    });
                    ;
                    $('.addUserType form')[0].reset();
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

    function editShopUserMap(id) {
        $(".btnAdd").hide();
        $(".btnUpdate").show();
        $.ajax({
            url: "{{ url('ShopUserMap') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.addUserType').modal('show');
                $('.modal-titles').text(data[0].user_type_name + ' Information');
                $('#inShopUserMapId').val(data[0].shopusermap_id);
                $('#slShop').val(data[0].shop_id);
                $('#slUser').val(data[0].user_id);
                $('#slStatus').val(data[0].map_status);
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

    function deleteShopUserMap(id) {
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
                    url: "{{ url('ShopUserMap') }}" + '/' + id,
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
</script>
</body>
</html>