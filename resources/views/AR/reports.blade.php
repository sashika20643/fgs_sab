@extends('Admin.layout.layout')

@section('content')
<div class="container">
    <form action="">


        <div class="form-group">
            <label for="select-element">Select Course</label>
            <select class="form-control" id="select-element" onChange="loaddata()">
                @foreach ($courses as $course )
                <option value="{{$course->id}}">{{$course->course_title}}</option>

                @endforeach

            </select>
          </div>
          <div class="form-group">
            <label for="select-element">Select Intake</label>
            <select class="form-control" id="select-element">
                @foreach ($intakes as $intake )
                <option value="{{$intake->id}}">{{$intake->name}}</option>

                @endforeach

            </select>
          </div>

          <div class="form-group" id="fee" style="display:none;">
            <label for="select-element">Select Fee</label>
            <select class="form-control" id="select-fee">


            </select>
          </div>

          <div class="form-group">
            <label for="select-element">Select Paid</label>
            <select class="form-control" id="select-element">
              <option value="option1">Paid</option>
              <option value="option2">Not Paid</option>
              <option value="option3">All</option>

            </select>
          </div>


<button class="btn btn-success">Generate</button>

    </form>



</div>
<script>

    function loaddata() {
    $("#fee").show();
    var course_id = 1;
    $.ajax({
        url: "{{route('getfees','1')}}",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

        type: 'GET',
        success: function(data) {
            console.log(data);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            $('#select-fee').html('    <option value="option1">Option 1</option>')
        }
    });
}


</script>

@endsection
