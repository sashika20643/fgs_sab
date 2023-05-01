@extends('Admin.layout.layout')

@section('content')
<div class="d-flex flex-column  ps-5 " style="min-width:100%">
<div class="d-flex mb-3 " style="width:100%">
    <a href="" class="btn btn-success me-3"> Basic Details</a>
    <a href="{{route('StudentPaymentView',$student->stu_email)}}" class="btn btn-outline-success"> Payment Details</a>

</div>
 <table class="table  table-striped">
    <tr>
        <td style="fontweight:bold;font-size:20px;">
ID :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_id}}
        </td>
    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
Name :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_title}} {{$student->stu_name}}
        </td>
    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
NIC :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_nic_passport}}
        </td>
    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
Primary number :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_primary_no}}
        </td>
    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
Mobile number :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_mobile_no}}
        </td>
    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
Email :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_email}}
        </td>

    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
Address :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_add_line1}},{{$student->stu_add_line2}},{{$student->stu_add_line3}}
        </td>

    </tr>


    <tr>
        <td style="fontweight:bold;font-size:20px;">
City :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_add_city}}
        </td>

    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
State :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_add_state}}
        </td>

    </tr>

    <tr>
        <td style="fontweight:bold;font-size:20px;">
Country :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_add_country}}
        </td>

    </tr>


    <tr>
        <td style="fontweight:bold;font-size:20px;">
Postal Code :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->stu_add_pcode}}
        </td>

    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
Course :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->course_title}}
        </td>

    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
Intake :
        </td>
        <td style="color: green;font-size:20px;">
{{$student->intake}}
        </td>
    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
           Submit Date :
                    </td>
                    <td style="color: green;font-size:20px;">
            {{$student->submit_date}}
                    </td>

    </tr>
    <tr>
        <td style="fontweight:bold;font-size:20px;">
           Ref No :
                    </td>
                    <td style="color: green;font-size:20px;">
            {{$student->stu_reference_no}}
                    </td>

    </tr>
 </table>

</div>




</div>


@endsection
