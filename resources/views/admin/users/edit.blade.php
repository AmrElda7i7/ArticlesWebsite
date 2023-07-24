@extends('admin.layouts.master')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Elements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">General Form Elements</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('users.update',$user->id) }}">
                                @csrf
                                @method("PATCH")
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" value="{{old('password')}}">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              

                                <div class="row mb-3">
                                    <div class="col-sm-10">

                                        @foreach ($roles as $role)
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="selectSm" class=" form-control-label">roles</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="role" id="SelectLm" class="form-control-smform-control">
                                                    @if ($user->getRoleNames()->first()==$role)
                                                        
                                                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                                        
                                                    @else
                                                        
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                            @endforeach
                                            @error('roles')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="submit" class="btn btn-primary" value="submit"></input>


                                    </div>
                                </div>



                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->
@endsection
