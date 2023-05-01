@extends('Admin.layout.layout')

@section('content')





<div class="container ps-5 pe-5"  style="">

    <div class="d-flex mb-3 " style="width:100%">
        <a href="{{route('Studentview',$student->stu_email)}}" class="btn btn-outline-success me-3"> Basic Details</a>
        <a href="{{route('StudentPaymentView',$student->stu_email)}}" class="btn btn-success"> Payment Details</a>

    </div>


    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>

              <th>
                Fee Catagory
              </th>
              <th>
                Amount
              </th>
              <th>
                Status
              </th>

            </tr>
          </thead>
          <tbody>
    @foreach ( $feeses as $fee )




            <tr>
                @if($state==0 || $fee->partial==0)
                   <td>
                    {{$fee->fee_type}}

              </td>


              <td>
                {{$fee->fee}}
              </td>

              @php
                  $st=0;
              @endphp
              @foreach ($stu_fee as $stu )

        @if ($fee->id==$stu->feeid)
        @php
        $st=1;
        $status=$stu->status;
    @endphp
    @endif
              @endforeach
              @if ($st)
    @if( $status=="pending")
              <td >
                <button class="btn btn-outline-warning">
                    {{$status}}
                </button>

              </td>
    @else
    <td >
        <button class="btn btn-outline-success">
            {{$status}}
        </button>

      </td>
      @endif
    @else

              <td>
                <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
                    yet to pay
                </a>

                    </td>
              @endif


              @else

              {{-- partial  --}}

              <td>
                {{$fee->fee_type}}-part I

          </td>


          <td>
            {{$fee->fee/2}}
          </td>

          @php
              $st=0;
          @endphp
          @foreach ($stu_fee as $stu )

    @if ($fee->id==$stu->feeid)
    @php
    $st=1;
    $status=$stu->status;

    @endphp




          @endif
          @endforeach
          @if ($st)
    @if( $status=="pending")
          <td >
            <button class="btn btn-outline-warning">
                {{$status}}
            </button>

          </td>
    @else
    <td >
    <button class="btn btn-outline-success">
        {{$status}}
    </button>

    </td>
    @endif
          @else
          <td>
            <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
                yet to pay
            </a>

                </td>
          @endif
            </tr>
            <tr>

              {{-- partial p2 --}}

              <td>
                {{$fee->fee_type}}-part II

          </td>


          <td>
            {{$fee->fee/2}}
          </td>

          @php
              $st=0;
          @endphp
          @foreach ($stu_fee as $stu )

    @if ($fee->id==$stu->feeid && $stu->full_payment==1)
    @php
    $st=1;
    $status=$stu->status;

    @endphp




          @endif
          @endforeach
          @if ($st)
    @if( $status=="pending" )
          <td >
            <button class="btn btn-outline-warning">
                {{$status}}
            </button>

          </td>
    @else
    <td >
    <button class="btn btn-outline-success">
        {{$status}}
    </button>

    </td>
    @endif
          @else
          <td>
            <a href="{{route('addpayment')}}" class="btn btn-outline-danger">
                yet to pay
            </a>

                </td>
          @endif
              @endif
            </tr>


            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex align-items-center mt-3">
        <h5>Enable partial payment for this student </h5>
     @if ($student->p_type==0)
     <a href="{{route('changePType',$student->stu_email)}}" class="ms-3 btn btn-primary">Enable </a>

     @else

     <a href="{{route('changePType',$student->stu_email)}}" class="ms-3 btn btn-warning">Disable </a>

     @endif
      </div>
    </div>
    @endsection
