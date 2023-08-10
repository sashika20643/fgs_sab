@extends('student.layout.layout')

@section('content')

<div class="container ps-5 " style="max-width:80%">
    {{-- {{ route('results.update', [$user->id, $subject->id]) }} --}}

    <form action="{{ route('student.results.show') }}" method="GET">
        <label for="semester">Filter by Semester:</label>
        <select name="semester" id="semester">
             <option value="1-1">1st Year 1st Semester</option>
        <option value="1-2">1st Year 2nd Semester</option>
        <option value="2-1">2nd Year 1st Semester</option>
        <option value="2-2">2nd Year 2nd Semester</option>
        <option value="3-1">3rd Year 1st Semester</option>
        <option value="3-2">3rd Year 2nd Semester</option>
        <option value="4-1">4th Year 1st Semester</option>
        <option value="4-2">4th Year 2nd Semester</option>

        </select>
        <button type="submit">Filter</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Result</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>
                        @foreach ($subject->results as $result)
                            @if ($result->user_id == $user->id)
                                {{ $result->result }}
                            @endif
                        @endforeach
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>




</div>

@endsection
