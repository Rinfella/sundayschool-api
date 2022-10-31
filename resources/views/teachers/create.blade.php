<x-admin-layout>
    <script>
        function submitForm() {
            document.getElementById('createTeacherForm').submit()
        }
    </script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Zirtirtu thar siamna</h1>
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
            <form action="/admin/teachers" method="post" id="createTeacherForm">
                @csrf
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="session_id">Session </label>
                    <select
                        class="form-control col-3 @error('session_id') is-invalid @enderror"
                        type="text"
                        autofocus
                        name="session_id" id="session_id">
                        <option value="">Select Session</option>

                        @foreach ($sessions as $session)
                            <option {{ old('session_id', $sessionId) == $session->id ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->year }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('session_id') }}</div>
                </div>

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="start_month">Start Month</label>
                    <select
                        class="form-control col-3 @error('start_month') is-invalid @enderror"
                        type="text"
                        autofocus
                        name="start_month" id="start_month">
                        <option value="">Select Starting Month</option>

                        @foreach ($months as $month)
                            <option {{ old('start_month', $startMonth) == $month->id ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('start_month') }}</div>
                </div>

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        type="text"
                        autofocus
                        onchange="submitForm()"
                        name="department_id" id="department_id">
                        <option value="">Select Department</option>

                        @foreach ($departments as $department)
                            <option
                            {{$departmentId && $departmentId != $department->id ? 'disabled' : ''}}
                            {{ old('department_id', $departmentId) == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('department_id') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="group_id">Group</label>
                    <select
                        class="form-control col-3 @error('group_id') is-invalid @enderror"
                        type="text"
                        autofocus
                        onchange="submitForm()"
                        @if($currentStep < 2) disabled @endif
                        name="group_id" id="group_id">
                        <option @if($groupId) disabled @endif value="">Select Group</option>

                        @foreach ($groups as $group)
                            <option
                            {{$groupId && $groupId != $group->id ? 'disabled' : ''}}
                            {{ old('group_id', $groupId) == $group->id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('group_id') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="user_id">User</label>
                    <!-- <select
                        class="form-control col-3 @error('user_id') is-invalid @enderror"
                        type="text"
                        autofocus
                        @if($currentStep < 3) disabled @endif
                        name="user_id" id="user_id">
                        <option value="">Select User</option>

                        @foreach ($users as $user)
                            <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select> -->
                    <select
                        @if($currentStep < 3) disabled @endif
                        class="form-control col-3 @error('user_id') is-invalid @enderror"
                        name="user_id"
                        id="userSelector">
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('user_id') }}</div>
                </div>
                <div class="form-group row">
                    <input type="hidden" name="currentStep" value="{{$currentStep}}">
                    <input type="submit" value="submit" class="offset-3 mr-3 btn btn-primary">
                    <a href="/admin/teachers/create" class="btn btn-warning">Reset</a>
                </div>
            </form>
        </div>
    </section>
    @section('bottomResources')
        <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
        <script src="/plugins/select2/js/select2.full.min.css"></script>
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
