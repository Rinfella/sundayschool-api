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

                {{-- Date, Department leh group te hi thlak apiangin form a in submit anga. Teacher appointment ang khan a kal ang --}}

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
                    <input type="submit" value="submit" class="offset-3 mr-3 btn btn-primary">
                </div>
            </form>
        </div>
    </section>
</x-admin-layout>
