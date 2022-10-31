<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pawl thar siamna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/groups">Pawl</a></li>
                        <li class="breadcrumb-item active">Create Group</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/groups" method="post">
                @csrf
                <div class="form-group row ">
                    <label class="form-label col-1" for="name">Name</label>
                    <input
                        class="form-control col-3 @error('name') is-invalid @enderror"
                        type="text" name="name"
                        id="name" autofocus
                        value="{{ old('name') }}">
                    <div class="invalid-feedback offset-1">{{ $errors->first('name') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-1" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        type="text"
                        name="department_id"
                        id="department_id"
                        value="{{ old('department_id') }}">
                        <option value="0">Select Department</option>

                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-1">{{ $errors->first('department_id') }}</div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-1 col-sm-10">
                        <div class="form-check">
                            <input name="is_teacher_group" value="yes" type="checkbox" class="form-check-input" id="is_teacher_group">
                            <label class="form-check-label" for="is_teacher_group">Zirtirtu pawl</label>
                        </div>
                    </div>
                </div>
                <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</x-admin-layout>
