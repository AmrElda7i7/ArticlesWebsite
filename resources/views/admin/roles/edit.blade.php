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
                            <form method="POST" action="{{ route('roles.update' ,$role->id) }}">
                                @csrf
                                @method('patch')
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{$role->name}}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">permissions</legend>
                                    <div class="col-sm-10">

                                        @foreach ($permissions as $permission)
                                        @if ($role->Permissions->contains($permission))
                                            
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                name="permissions[]" value="{{ $permission->id }}" checked>
                                            <label class="form-check-label" for="gridCheck1">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                name="permissions[]" value="{{ $permission->id }}">
                                            <label class="form-check-label" for="gridCheck1">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @endif 
                                    
                                          
                                            @endforeach
                                            @error('permissions')
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
