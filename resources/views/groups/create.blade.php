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
                    <label class="form-label col-3 text-right" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        type="text"
                        autofocus
                        name="department_id" id="department_id">
                        <option value="0">Select Department</option>

                        @foreach ($departments as $department)
                            <option {{ old('department_id') == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('department_id') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="number_of_groups">Number of groups (Pawl mamawh zat)</label>
                    <input class="form-control col-3 @error('number_of_groups') is-invalid @enderror" type="text" name="number_of_groups"
                        id="number_of_groups" value="{{ old('number_of_groups', 1) }}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('number_of_groups') }}</div>
                </div>
                <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</x-admin-layout>
