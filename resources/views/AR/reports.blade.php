@extends('Admin.layout.layout')

@section('content')
<div class="container">
    <form action="{{route('report.generate')}}" type="Post">
@csrf

        <div class="form-group">
            <label for="select-element">Select Course</label>
            <select class="form-control" id="select-course" name="course" onChange="loaddata()">
                @foreach ($courses as $course )
                <option value="{{$course->course_id}}">{{$course->course_title}}</option>

                @endforeach

            </select>
          </div>
          <div class="form-group">
            <label for="select-element">Select Intake</label>
            <select class="form-control" id="select-element" name="intake">
                @foreach ($intakes as $intake )
                <option value="{{$intake->name}}">{{$intake->name}}</option>

                @endforeach

            </select>
          </div>




<button class="btn btn-success">Generate</button>

    </form>



</div>
<script>

    function loaddata() {
    $("#fee").show();
    var course_id = $('#select-course').val();
    console.log(course_id);
    $.ajax({
        url: "{{route('getfees','1')}}",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

        type: 'GET',
        success: function(data) {
            console.log(data);
            var select = $('#select-fee');
            select.empty();
            $.each(data, function(key, value) {
                select.append('<option value="' + value.id + '">' + value.fee_type + '</option>');
            });

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);


        }
    });
}


</script>

@endsection
