<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard - Shop Info</title>
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
                                                    Add New Shop
                                                    <i class="mdi mdi-loupe btn-icon-append"></i>
                                                </button>
                                            </div>
                                            <div class="pe-1 mb-3 mb-xl-0">
                                                <button type="button"
                                                        class="btn btn-outline-inverse-info btn-icon-text">
                                                    Print
                                                    <i class="mdi mdi-printer btn-icon-append"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <h4 class="card-title">Data table</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Shop Info</th>
                                                    <th>Owner Info</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Update Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($ShopInfoData as $article)
                                                    <tr>
                                                        <td>{{$article->shop_id}}</td>
                                                        <td>{{$article->shop_name}}<br>{{$article->shop_phone}}
                                                            || {{$article->shop_email}}</td>
                                                        <td>{{$article->ower_name}}<br>{{$article->ower_number}}</td>
                                                        <td>{{$article->shop_address}}<br>
                                                            <small>Trade
                                                                Licence: {{$article->shop_trade_licence}}</small>
                                                        </td>
                                                        <td>
                                                            @if($article->shop_status=="A")
                                                                <label class="badge badge-success">Active</label>
                                                            @elseif($article->shop_status=="I")
                                                                <label class="badge badge-warning">InActive</label>
                                                            @else
                                                                <label class="badge badge-danger">Pending</label>
                                                            @endif
                                                        </td>
                                                        <td>{{$article->create_date}}</td>
                                                        <td>{{$article->update_date}}</td>
                                                        <td>
                                                            <button class="btn btn-outline-primary"
                                                                    onclick="editUserType('{{$article->shop_id}}')">View
                                                            </button>
                                                            <button class="btn btn-outline-danger"
                                                                    onclick="deleteUserType('{{$article->shop_id}}')">
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

                    <div class="modal fade addNewShop" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Shop Add</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Shop Name</label>
                                                <input type="text" class="form-control" id="inshopname"
                                                       name="inshopname" placeholder="Enter Shop Name">
                                                <input type="hidden" id="inshopid" name="inshopid">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Shop Address</label>
                                                <input type="text" class="form-control" id="inshopaddress"
                                                       name="inshopaddress" placeholder="Enter Shop Address">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Shop Email</label>
                                                <input type="text" class="form-control" id="inShopEmail"
                                                       name="inShopEmail" placeholder="Enter Shop Email">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Shop Phone</label>
                                                <input type="text" class="form-control" id="inShopPhone"
                                                       name="inShopPhone" placeholder="Enter Shop Phone">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Shop Trade Licence NO</label>
                                                <input type="text" class="form-control" id="inshoptradelicence"
                                                       name="inshoptradelicence" placeholder="Enter Trade Licence NO">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Owner Name</label>
                                                <input type="text" class="form-control" id="inOwnerName"
                                                       name="inOwnerName" placeholder="Enter Owner Nam">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Owner Phone</label>
                                                <input type="text" class="form-control" id="inOwnerPhone"
                                                       name="inOwnerPhone" placeholder="Enter Owner Phone">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputUsername1">Shop Status</label>
                                                <select id="slShopStatus" name="slShopStatus"
                                                        class="form-control form-control-lg" required>
                                                    <option value="">Select Shop Status</option>
                                                    <option value="A">Active</option>
                                                    <option value="I">InActive</option>
                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="addNewShop()" class="btn btn-success">Submit</button>
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
        $('.addNewShop').modal('show');
    }

    function addNewShop() {
        url = "{{ url('ShopInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".addNewShop form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.addNewShop').modal('hide');
                    swal("Success", dataResult.statusMsg).then((value) => {
                        window.location.reload();
                    });
                    ;
                    $('.addNewShop form')[0].reset();
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

    function editUserType(id) {
        $(".btnAdd").hide();
        $(".btnUpdate").show();
        $.ajax({
            url: "{{ url('ShopInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.addNewShop').modal('show');
                $('.modal-titles').text(data[0].shop_name + ' Information');
                $('#inshopid').val(data[0].shop_id);
                $('#inshopname').val(data[0].shop_name);
                $('#inshopaddress').val(data[0].shop_address);
                $('#inShopEmail').val(data[0].shop_email);
                $('#inShopPhone').val(data[0].shop_phone);
                $('#inshoptradelicence').val(data[0].shop_trade_licence);
                $('#inOwnerName').val(data[0].ower_name);
                $('#inOwnerPhone').val(data[0].ower_number);
                $('#slShopStatus').val(data[0].shop_status);
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

    function deleteUserType(id) {
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
                    url: "{{ url('ShopInfo') }}" + '/' + id,
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