@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Company Management</h1>

            <div class="add-task">
                <a href="/companies/create" class="btn btn-primary btn-block">Add Company</a>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Details Table -->
                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($companies as $data)
                                        <tr>
                                            <td width="20%">{{ $data->name }}</td>
                                            <td width="20%">{{ $data->email }}</td>
                                            <td width="20%">{{ $data->website }}</td>
                                            <td>
                                                <div class="btn btn-success mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                    <input type="text" hidden id="id" name="id" value="{{$data->id }}">
                                                    <a href="companies/{{$data->id}}/edit"
                                                       >EDIT </a>
                                                </div>
                                                <div class="btn btn-danger ">
                                                    <form action="{{ route('companies.destroy', $data->id) }}" method="post"
                                                          class="">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>Delete</button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex">
                                        {!! $companies->links() !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; DTech-Assignment 2023</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Custom scripts for all pages-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this company?",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

@endsection
