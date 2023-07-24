@extends('user.layouts.master')
@section('content')
        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="portfolio row">
                                @foreach ( $category->articles as $article)
                                    
                             @if ($article->status=='published')
                                 
                             <div class="pitem item-w1 item-h1">
                                 <div class="blog-box">
                                     <div class="post-media">
                                            
                                            <a href="{{route('show_article',$article->id)}}" title="">
                                                <img src="{{asset('uploads/'.$article->id.'/'.$article->image->name)}}" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <span class="bg-grey"><a href="{{route('show_article',$article->id)}}" title="">{{$category->name}}</a></span>
                                            <h4><a href="{{route('show_article',$article->id)}}" title="">{{$article->name}}</a></h4>
                                            <small><a href="blog-author.html" title="">By: {{$article->user->name}}</a></small>
                                            <small><a href="#" title="">{{$article->created_at->format('Y-m-d')}}</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                                @endif
                                @endforeach
                            </div><!-- end portfolio -->
                        </div><!-- end page-wrapper -->

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
@endsection()