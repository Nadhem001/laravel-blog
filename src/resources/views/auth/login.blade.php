@extends('base')
@section('title', 'login')

@section('content')
<form action="{{ route('auth.login') }}" method="post" class="">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
      @error('email')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="password" >
      @error('password')
      {{ $message }}
  @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
