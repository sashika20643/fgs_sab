@extends('Admin.layout.layout')

@section('content')

<div class="d-flex justify-content-center align-items-center ps-5 " style="min-width:100%">
    <table class="table table-striped">
        <thead>
          <tr>
              <th>
                   Name
                </th>

                <th>
            Email
                 </th>
                 <th>
                    Role
                         </th>

            <th>
             Delete
            </th>


          </tr>
        </thead>
        <tbody>
@foreach ($data as $user )
    <tr>
        <td>
{{$user->name}}
        </td>

        <td>
            {{$user->email}}
        </td>
        <td>
            {{$user->rolename}}
                    </td>



<td>
    <a href="" class="btn btn-outline-danger" >Delete</a>
</td>
    </tr>
@endforeach

    </tbody>
      </table>



</div>

@endsection
