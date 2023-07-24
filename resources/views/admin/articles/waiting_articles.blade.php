@extends('admin.layouts.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
               {{session()->get('error')}}
            </div>
            @endif
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
               {{session()->get('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>title</th>
                                    <th>category</th>
                                    <th>views</th>
                                    <th>details</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0 ;
                                @endphp
                                @foreach ($waitingArticles as $article)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$article->id}}</td>
                                        <td>{{$article->name}}</td>
                                        <td>{{$article->category->name}}</td>
                                        <td>{{$article->views}}</td>
                                        <td><a href="{{route('articles.show',$article->id)}}" class="btn btn-outline-primary">details</a></td>
                                        
                                        <td>
                                            <form action="{{url('accept_article/'.$article->id)}}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="submit" class="btn btn-outline-success" value="accept"></input>
                                            </form>
                                            <form action="{{url('reject_article/'.$article->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-outline-danger" value="reject"></input>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
