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
                                                    Add Category
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

                                <h4 class="card-title">Category Data table</h4>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name</th>
                                                    <th>Status</th>
                                                    <th>Create Date</th>
                                                    <th>Update Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($categoryData as $article)
                                                <tr>
                                                    <td>{{$article->category_id}}</td>
                                                    <td>{{$article->category_name}}</td>
                                                    <td>
                                                        @if($article->category_status=="A")
                                                            <label class="badge badge-success">Active</label>
                                                        @elseif($article->category_status=="I")
                                                            <label class="badge badge-warning">InActive</label>
                                                        @else
                                                            <label class="badge badge-danger">Pending</label>
                                                        @endif
                                                    </td>
                                                    <td>{{$article->create_info}}</td>
                                                    <td>{{$article->update_info}}</td>
                                                    <td>
                                                        <button class="btn btn-outline-primary" onclick="editCategory('{{$article->category_id}}')">View</button>
                                                        <button class="btn btn-outline-danger" onclick="deleteCategory('{{$article->category_id}}')">Delete</button>
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


                    <div class="modal fade addCategory" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Category Add</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" method="post" action="#" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1">Category Name</label>
                                                <input type="hidden" id="inCategoryId" name="inUserTypeId">
                                                <input type="text" class="form-control" id="inCategoryName" name="inCategoryName" placeholder="User Type Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleInputUsername1"> Status</label>
                                                <select id="slCategoryStatus" name="slCategoryStatus" class="form-control form-control-lg" required>
                                                    <option value="S">Select User Type</option>
                                                    <option value="A">Active</option>
                                                    <option value="I">InActive</option>
                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="addCategory()" class="btn btn-success">Submit</button>
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
        $('.addCategory').modal('show');
    }

    function addCategory() {
        url = "{{ url('CategoryInfo') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".addCategory form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    $('.addCategory').modal('hide');
                    swal("Success", dataResult.statusMsg).then((value) => {
                        window.location.reload();
                    });
                    ;
                    $('.addCategory form')[0].reset();
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

    function editCategory(id) {
        $(".btnAdd").hide();
        $(".btnUpdate").show();
        $.ajax({
            url: "{{ url('CategoryInfo') }}" + '/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('.addCategory').modal('show');
                $('.modal-titles').text(data[0].category_name + ' Information');
                $('#inCategoryId').val(data[0].category_id);
                $('#inCategoryName').val(data[0].category_name);
                $('#slCategoryStatus').val(data[0].category_status);
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

    function deleteCategory(id) {
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
                    url: "{{ url('CategoryInfo') }}" + '/' + id,
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