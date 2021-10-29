<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="fixed-nav sticky-footer bg-light" id="page-top">
<!-- Decide to which file go include-->
<div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>  {{ __('Movies List') }}
                <a class="btn btn-primary btn-sm" type="button" data-target="#CreateProductModal" style="color:whitesmoke;float: right; font-weight: 900;" data-toggle="modal">ADD MOVIE</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Time</th>
                            <th>Language</th>
                            <th>Release Date</th>
                            <th>Release Country</th>
                            <th>Rate</th>
                            <th>Action</th>

                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Time</th>
                            <th>Language</th>
                            <th>Release Date</th>
                            <th>Release Country</th>
                            <th>Rate</th>
                            <th>Action</th>

                        </tr>
                        </tfoot>

                        <tbody>

                        @foreach($movies as $movie)
                            <tr>
                            <td>{{$movie->id}}</td>
                            <td>{{$movie->category->category_title}}</td>
                            <td>{{$movie->movie_title}}</td>
                            <td>{{$movie->movie_time}}</td>
                            <td>{{$movie->movie_language}}</td>
                            <td>{{$movie->movie_rel_date}}</td>
                            <td>{{$movie->movie_rel_country}}</td>
                            <td>{{$movie->rate_of_movie}}</td>
                              <td>
                                  <div class="btn-group">
                                  <a href="" class="btn btn-success btn-sm" id="getEditProductData" data-id="{{$movie->id}}">Edit</a>&nbsp;
                                <a href="" data-id="{{$movie->id}}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</a>
                                  </div>
                              </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->

<!-- /.content-wrapper-->


{{--THIS ARE FOR CRUD STUFF--}}
<main class="py-4">
    <!-- Create Product Modal -->
    <div class="modal" id="CreateProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Movie Create</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Success!</strong>Movie was added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>



                    <div class="form-group">
                        <label for="movie_title">Movie Title:</label>
                        <input type="text" class="form-control" name="movie_title" id="movie_title" >
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category ID:</label>
                        <input type="text" class="form-control" name="category_id" id="category_id">
                    </div>

                    <div class="form-group">
                        <label for="movie_time">Movie Time:</label>
                        <input type="text" class="form-control" name="movie_time" id="movie_time" >
                    </div>

                    <div class="form-group">
                        <label for="movie_language">Movie Language:</label>
                        <input type="text" class="form-control" name="movie_language" id="movie_language" >
                    </div>

                    <div class="form-group">
                        <label for="movie_rel_date">Movie Release Date:</label>
                        <input type="date" class="form-control" name="movie_rel_date" id="movie_rel_date" >
                    </div>

                    <div class="form-group">
                        <label for="movie_rel_country">Movie Release Country:</label>
                        <input type="text" class="form-control" name="movie_rel_country" id="movie_rel_country">
                    </div>

                    <div class="form-group">
                        <label for="rate_of_movie">Rate of Movie:</label>
                        <input type="text" class="form-control" name="rate_of_movie" id="rate_of_movie">
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitCreateProductForm">Create</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal" id="EditProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Movie Edit</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Success!</strong>Product was added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="EditProductModalBody">

                    </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="SubmitEditProductForm">Update</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div class="modal" id="DeleteProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Movie Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Are you sure want to delete this movie?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="SubmitDeleteProductForm">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script>

    $(document).ready( function () {
        $('#dataTable').DataTable({

        });
    } );

    $('#SubmitCreateProductForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: "{{ route('movies.store') }}",
            method: 'post',
            data: {
                movie_title: $('#movie_title').val(),
                category_id: $('#category_id').val(),
                movie_time: $('#movie_time').val(),
                movie_language: $('#movie_language').val(),
                movie_rel_date: $('#movie_rel_date').val(),
                movie_rel_country: $('#movie_rel_country').val(),
                rate_of_movie: $('#rate_of_movie').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#CreateProductModal').modal('hide');
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    // Get single product in EditModel
    $('.modelClose').on('click', function(){
        $('#EditProductModal').hide();
    });
    var id;
    $('body').on('click', '#getEditProductData', function(e) {
        e.preventDefault();
        $('.alert-danger').html('');
        $('.alert-danger').hide();
        id = $(this).data('id');
        $.ajax({
            url: "movies/"+id+"/edit",
            method: 'GET',
            // data: {
            //     id: id,
            // },
            success: function(result) {
                console.log(result);
                $('#EditProductModalBody').html(result.html);
                $('#EditProductModal').show();
            }
        });
    });

    // Update product Ajax request.
    $('#SubmitEditProductForm').click(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: "movies/"+id,
            method: 'PUT',
            data: {
                movie_title: $('#edit_movie_title').val(),
                category_id: $('#edit_category_id').val(),
                movie_time: $('#edit_movie_time').val(),
                movie_language: $('#edit_movie_language').val(),
                movie_rel_date: $('#edit_movie_rel_date').val(),
                movie_rel_country: $('#edit_movie_rel_country').val(),
                rate_of_movie: $('#edit_rate_of_movie').val(),
            },
            success: function(result) {
                if(result.errors) {
                    $('.alert-danger').html('');
                    $.each(result.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                    });
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.datatable').DataTable().ajax.reload();
                    setInterval(function(){
                        $('.alert-success').hide();
                        $('#EditProductModal').hide();
                    }, 2000);
                }
            }
        });
    });

    // Delete product Ajax request.
    var deleteID;
    $('body').on('click', '#getDeleteId', function(){
        deleteID = $(this).data('id');
    })
    $('#SubmitDeleteProductForm').click(function(e) {
        e.preventDefault();
        var id = deleteID;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "movies/"+id,
            method: 'DELETE',
            success: function(result) {
                setInterval(function(){
                    $('.datatable').DataTable().ajax.reload();
                    $('#DeleteProductModal').hide();
                }, 1000);
            }
        });
    });

</script>
</body>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Custom scripts for this page-->
<script src="js/sb-admin-datatables.min.js"></script>

</html>