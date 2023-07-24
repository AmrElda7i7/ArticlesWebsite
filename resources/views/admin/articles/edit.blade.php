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
                            <form method="POST" action="{{ route('articles.update' ,$article->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("PATCH")
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" value=" {{$article->name}}">
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">body</label>
                                    <div class="col-sm-10">
                                        <textarea id="editor" name="editor" >{{$article->body}}</textarea>
                                        @error('editor')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">categories</label>
                                    <div class="col-sm-10">
                                        <select name="category" id="category" class="form-control-sm form-control">
                                            @foreach ($categories as $category)
                                                @if ($category == $article->category->name)
                                                <option  value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @else
                                                    <option  value="{{$category->id}}">{{$category->name}}</option>
                                                @endif
                                            @endforeach
                                           
                                        </select>
                                        @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="inputText" class="col-sm-2 col-form-label">image</label>
                                    <input type="file" id="file-input" name="image" class="form-control-file">
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector("#editor"), {
                extraPlugins: [SimpleUploadAdapterPlugin],
            })
            .then(editor => {
                // Simulate label behavior if textarea had a label
                if (editor.sourceElement.labels.length > 0) {
                    editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
                }
            })
            .catch(error => {
                console.error(error);
            });

     
        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }
    </script>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->
@endsection
