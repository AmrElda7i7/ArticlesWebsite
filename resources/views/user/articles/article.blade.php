@extends('user.layouts.master')
@section('content')
        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-wrapper">
                            <div class="blog-title-area text-center">
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                                    <li class="breadcrumb-item active">{{$article->name}}</li>
                                </ol>

                                <span class="color-aqua"><a href="{{route('show_category',$article->category->id)}}" title="">{{$article->category->name}}</a></span>

                                <h3>{{$article->name}}</h3>

                                <div class="blog-meta big-meta">
                                    <small><a href="single.html" title="">{{$article->created_at->format('Y-m-d')}}</a></small>
                                    <small><a href="blog-author.html" title="">by {{$article->user->name}}</a></small>
                                    <small><a href="#" title=""><i class="fa fa-eye"></i> {{$article->views}}</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="upload/menu_08.jpg" alt="" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                                    
                                    {!! $article->body !!}
                                </div><!-- end pp -->
                            </div><!-- end content -->


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-spot clearfix">
                                        <div class="banner-img">
                                            <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                                        </div><!-- end banner-img -->
                                    </div><!-- end banner -->
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <hr class="invis1">

                          

                            <hr class="invis1">

                 

                            <hr class="invis1">

                       

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">{{$article->comments->count()}} comments</h4>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                            @foreach ($article->comments as $comment)
                                            <div class="media">
                                                
                                                    
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name"> {{$comment->user->name}} <small>5 days ago</small></h4>
                                                    <p>{{$comment->body}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                          
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Reply</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper" method="post" action="{{url('add_comment/'.$article->id)}}">
                                            @csrf
                                            <textarea class="form-control" placeholder="Your comment" name="comment"></textarea>
                                            @error('comment')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
@endsection