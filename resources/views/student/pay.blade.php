@extends('student.layout.layout')

@section('content')

<div class="container ps-5 " style="max-width:80%">
    <div class="card"style="background-color: rgb(193, 189, 182,.2)">
        <div class="card-body">
          <h2 class="card-title">Payment Details</h2>
          <p class="card-description">
           Add your Payment Details
          </p>
          <form class="forms-sample" method="POST" action="{{ route('pay') }}" enctype="multipart/form-data">
            @csrf
            <h5>Select Fee Category</h5>
            @foreach ($feeses as $fee )
            <div class="form-check form-check-success">
@if($state==1)
@if($fee->partial_fee->isEmpty())
<label class="form-check-label">
{{$fee->fee_type}}(rs {{$fee->fee}})


<input type="checkbox" checked=false  name="{{$fee->id}}"  onchange="addfee(this,{{$fee->fee}});" class="form-check-input" value="{{$fee->id}}">
</label>
@else
<h3>{{$fee->fee_type}}</h3>
<hr>
<ul style="list-style-type:none">
@foreach ($fee->partial_fee as $partial_fee )
<li>
<lable>
{{$partial_fee->fee_type}}(rs {{$partial_fee->fee}})
</lable>
<input type="checkbox" checked=false  name="{{$fee->id}}"  onchange="addfee(this,{{$partial_fee->fee}});" class="form-check-input" value="{{$fee->id}}">
<br>
</li>
@endforeach
</ul>


@endif

@else
<label class="form-check-label">
    {{$fee->fee_type}}(rs {{$fee->fee}})


    <input type="checkbox" checked=false  name="{{$fee->id}}"  onchange="addfee(this,{{$fee->fee}});" class="form-check-input" value="{{$fee->id}}">
    </label>
@endif


              </div>
            @endforeach

            <div class="form-group">
              <label for="exampleInputName1">Amount </label>
              <input type="text" class="form-control" id="amount"  name="amount" placeholder="amount">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Slip</label>
              <input type="file" name="slip" class="form-control" id="exampleInputEmail3" placeholder="slip">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail3">Date(paid) </label>
                <input type="date" name="date" class="form-control" id="exampleInputEmail3" placeholder="date">
              </div>



            <button type="submit" class="btn btn-primary me-2">Submit</button>

          </form>
        </div>
      </div>

    </div>

<script>
    var tot=0;
    document.getElementById("amount").value=tot;
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    for (var checkbox of checkboxes) {
        checkbox.checked = false;
    }

    function addfee(checkbox, price){
        if(checkbox.checked == true){

        tot+=price;
    }else{
      tot-=price;
   }
   console.log(tot);
   document.getElementById("amount").value=tot;


    }
</script>
@endsection
