@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Company</h1>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                            @if(count($errors))
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$error}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        <div class="chart-area">
                            <!-- Form -->
                            <form class="form-validate" id="company" action="/companies" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-name">Name</label>
                                            <input type="text" id="dt_update"
                                                   class="name form-control" name="name"
                                                   />
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-email">Email</label>
                                            <input type="text" id="email"
                                                   class="email form-control" name="email"
                                                   />
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-2">
                                            <label for="blog-edit-website">Website Url</label>
                                            <input type="text" id="website"
                                                   class="website form-control" name="website"
                                                   />
                                            <span class="text-danger error-text website_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column mt-6">
                                        <button type="submit"
                                                class="save_company btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">
                                            Save changes
                                        </button>
                                    </div>
                                </div>

                            </form>
                            <!--/ Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white" style="width:100%;
    position:fixed; bottom:0;">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; DTech-Assignment 2023</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

@endsection

@section('page-script')
    <!-- BEGIN: Page JS-->

    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>


    <!-- END: Page JS-->

@endsection
