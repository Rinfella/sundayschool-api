<x-admin-layout>
    <script>
        function submitForm() {
            document.getElementById('attendanceForm').submit()
        }
    </script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Entry</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/teachers">Zirtirtu</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/attendance/entry" method="post" id="attendanceForm">
                @csrf
                
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        autofocus 
                        name="department_id" id="department_id"
                        onchange="submitForm"
                        value="{{old('department_id')}}">
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('department_id') }}</div>
                </div>
                

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="group_id">Group</label>
                    <select
                        class="form-control col-3 @error('group_id') is-invalid @enderror"
                        autofocus 
                        name="group_id" id="group_id"
                        onchange="submitForm"
                        value="{{old('group_id')}}">
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('group_id') }}</div>
                </div>
                <div class="form-group row">
                    <input type="submit" value="submit" class="offset-3 mr-3 btn btn-primary">
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">Hming</th>
                        @foreach ($months as $month)
                            <th colspan="{{count($month['sundays'])}}" class="text-center">{{$month['name']}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($months as $month)
                            @foreach($month['sundays'] as $day)
                                <th  class="p-0 text-center">{{$day}}</th>
                            @endforeach
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach ($attendances as $enrollmentId => $attendance)
                        <tr>
                            <td>{{$enrollments[$enrollmentId]->user->name}}</td>
                            @foreach ($months as $monthNumber => $month)
                                @foreach($month['sundays'] as $day)
                                    @php
                                        $date = $year . '-' . str_pad($monthNumber, 2, 0, STR_PAD_LEFT) . '-' . str_pad($day, 2, 0, STR_PAD_LEFT);
                                        $status = isset($attendance[$date]) ? $attendance[$date][0]->status : '-';
                                    @endphp
                                    <td  @class([
                                        'p-0',
                                        'text-center',
                                        'font-weight-bold',
                                        'text-danger' => $status != 'Present',
                                        'text-success' => $status == 'Present'
                                        ])>
                                        {{substr($status, 0, 1)}}
                                    </td>
                                @endforeach
                            @endforeach
                        </tr>
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>
