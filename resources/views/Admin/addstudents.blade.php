@extends('Admin.layout.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center ps-5 " style="min-width:100%">
    <div class="card p-5" style="background-color: rgb(214, 197, 166 ); min-width:80%" >
       <h4>{{$count}}found</h4>
       @if ($count!=0)

        <a href=" AddstudentstoUser" class="btn btn-primary">
            Add All Students
        </a>


    @else
    <button class="btn btn-primary" disabled>
        Add All Students
       </button>
       @endif

      </div>

    </div>

@endsection
