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
            <form action="/admin/attendance" method="post" id="attendanceForm">
                @csrf

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="date">Date</label>
                    <input
                        class="form-control col-3 @error('date') is-invalid @enderror"
                        type="date"
                        autofocus
                        name="date" id="date"
                        onchange="submitForm"
                        value="{{old('date', date('Y-m-d'))}}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('date') }}</div>
                </div>


                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        name="department_id" id="department_id"
                        onchange="submitForm"
                        value="{{old('department_id')}}">

                        <option @if ($departmentId) disabled @endif value="">Select Department</option>

                        @foreach ($departments as $department)
                            <option {{ $departmentId && $departmentId != $department->id ? 'disabled' : ''}}
                                {{old('department_id', $departmentId) == $department->id ? 'selected' : ''}}
                                value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
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

                        @if ($currentStep < 2) disabled @endif

                        <option @if ($groupId) disabled @endif value="">Select Group</option>

                        @foreach ($groups as $group)
                            <option {{$groupId && $groupId != $group->id ? 'disabled' : ''}}
                                {{old('group_id', $groupId) == $group->id ? 'selected' : ''}}
                                value="{{$group->id}}">{{$group->name}}</option>

                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('group_id') }}</div>
                </div>

                <fieldset>
                    <legend>Zirlaite</legend>
                    @foreach ($enrollments as $enrollment)
                    <div class="form-group row ">
                        <label class="form-label col-3 text-right" for="students[][id]">{{$enrollment->user->name}} {{$enrollment->status}}</label>
                        <div class="col-3">
                            <div class="form-group clearfix">
                                <div class="form-check">
                                    <input class="form-check-input" id="students_{{$enrollment->id}}_present" @checked($enrollment->status == 'Present') type="radio" name="students[{{$enrollment->id}}]" value="Present">
                                    <label class="form-check-label" for="students_{{$enrollment->id}}_present">Present</label>
                                </div>
                                <div class="form-check">
                                    <input id="students_{{$enrollment->id}}_absent" class="form-check-input" @checked($enrollment->status == 'Absent') type="radio" name="students[{{$enrollment->id}}]" value="Absent">
                                    <label for="students_{{$enrollment->id}}_absent" class="form-check-label">Absent</label>
                                </div>
                                @foreach ($absentTypes as $type)
                                <div class="form-check">
                                    <input id="students_{{$enrollment->id}}_{{$type}}" class="form-check-input"  @checked($enrollment->status == $type) type="radio" name="students[{{$enrollment->id}}]" value="{{$type}}">
                                    <label for="students_{{$enrollment->id}}_{{$type}}" class="form-check-label">{{$type}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                </fieldset>

                <div class="form-group row">
                    <input type="hidden" name="currentStep" value="{{ $currentStep }}">
                    <input type="submit" value="submit" class="offset-3 mr-3 btn btn-primary">
                    <a href="/admin/attendance/entry" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
    </section>
    @section('bottomResources')
        <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
        <script src="/plugins/select2/js/select2.full.min.js"></script>
        <script>
            $('#userSelector').select2({
                minimumInputLength: 4,
                ajax: {
                    url: '/admin/users/search',
                    dataType: 'json',
                    delay: 1000,
                }
            })
        </script>
    @endsection
</x-admin-layout>
