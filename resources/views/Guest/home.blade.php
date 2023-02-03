@extends('layouts.guest')

@section('content')
<div class="container text-center">

  <h1 class="my-3 font-italic">Benvenuto!</h1>
  <a href="{{route('admin.home')}}" class="btn btn-outline-info">Vai al Login</a>
</div>

  <div id="app"></div>
@endsection