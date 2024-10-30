@extends('layouts.app2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card-columns">
                    @foreach ($files as $file)
                        <div class="card">
                            <img class="card-img-top" src="{{asset($file->url)}}" alt="">
                        </div>
                    @endforeach
                </div>
                {{$files->links()}}
            </div>
        </div>
    </div>
@endsection