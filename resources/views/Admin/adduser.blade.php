@extends('Admin.layout.layout')

@section('content')
<div class="container ps-5 " style="max-width:80%">
    <div class="card" style="background-color: rgb(214, 197, 166)">
        <div class="card-body">
          <h4 class="card-title">Add User</h4>
          <p class="card-description">
            fill form fields
          </p>
          <form class="forms-sample" method="POST" action="{{ route('Controller.adduser') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Email</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
            </div>
            <div class="form-group" >
                <label for="">User Type</label>
            <select name="role" class="form-select" aria-label="Default select example">
@foreach ($data as $role )
<option value="{{$role->roleid}}">{{$role->rolename}}</option>

@endforeach

              </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail3">Password</label>
                <input type="password" name="pw" class="form-control" id="exampleInputEmail3" placeholder="Email">
              </div>


            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
          </form>
        </div>
      </div>

    </div>

@endsection
