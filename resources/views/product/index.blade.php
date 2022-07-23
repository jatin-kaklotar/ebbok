@extends('layouts.main')
@section('style')

@endsection
@section('content')

<div class="main-div">
    
    <div class="p-5 bg-secondary text-white text-center">
        <h1>Packt Books</h1>
        <p>Get all the quality content you'll ever need to stay ahead with a Packt subscription - access over 7,500 online books and videos on everything in tech</p> 
    </div>
    
    <div class="container my-5">
        <div class="row">
            @forelse ($data as $item)
            <div class="col-md-4 p-2">
                <div class="card  h-100" >
                    <div class="card-body">
                        <h5 class="card-title text-info">  {{ $item['title'] }} </h5>
                        <div class="card-text pt-3 mt-auto mx-auto">
                            <div class="text-muted">
                                By :   {{ $item['authors_name'] }}
                            </div>
                            <div>
                                {{ $item['publication_date'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2 text-center">
                <h3>No books found.</h3>
            </div>
            @endforelse
        </div>

        @if ($data)
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination justify-content-center">
                    <li class="page-item @if (!$prevPageNumber) disabled @endif"><a class="page-link" href="?page={{ $prevPageNumber }}">Previous</a></li>
                    <li class="page-item @if (!$nextPageNumber) disabled @endif"><a class="page-link" href="?page={{ $nextPageNumber }}">Next</a></li>
                  </ul> 
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
