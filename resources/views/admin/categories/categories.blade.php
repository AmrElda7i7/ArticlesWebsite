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
            <a href="{{route('categories.create')}}" class="btn btn-primary btn-lg btn-block">add category</a>
            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0 ;
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-primary">edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-outline-danger" value="delete"></input>
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
