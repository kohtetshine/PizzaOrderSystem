@extends('admin.layout.master')

@section('title')
<title>Category List</title>
@endsection

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('admin#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row align-middle">
                    @if (session('message'))
                    <div class="col-6 offset-1 text-center">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{session('message')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="col-3 offset-2">
                        <form action="{{route('admin#categorylist')}}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Category" name="searchdata" value="{{request('searchdata')}}">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="offset-9">
                        <form action="{{route('admin#categorylist')}}" method="get">
                            <div class="col-3 input-group">
                                <input type="text" class="form-control" placeholder="Search Category" name="searchdata" value="{{request('searchdata')}}">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="row mt-3">
                        <div class="col-3">
                            <h5>Total Category - {{$categories->total()}}</h5>
                        </div>
                    </div>
                </div>
                @if (count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Create Date</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{$category['id']}}</td>
                                <td>
                                    <span class="block-email"> {{$category['category_name']}}</span>
                                </td>
                                <td>{{$category['updated_at']->format("d/ F/ Y")}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('admin#editPage',$category['id'])}}" class="mx-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin#delete',$category['id']) }}" class="mx-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $categories->appends(request()->query())->links() }}
                    </div>
                </div>
                @else
                <div>
                    <h3 class="text-center text-muted mt-5">There is no Category Here.</h3>
                </div>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
