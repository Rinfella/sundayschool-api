<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pawl thar siam na:</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/groups">Pawl</a></li>
                        <li class="breadcrumb-item active">Create Group</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/admin/groups" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label"> Name:</label>
                    <input type="text"
                        autofocus
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        value="{{old('name')}}">

                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="department_id" class="from-control">Department:</label>
                    <select name="department_id"
                        class="form-control @error('department_id') is-invalid @enderror"
                        type="text"
                        value="{{old('department_id')}}">
                        <option value="0">Select Department</option>

                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}"</option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback">
                        {{$errors->first('department_id')}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="offset-sm-1">
                        <div class="form-check">
                            <input name="is_teacher_group" value="yes" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="is_teacher_group">Zirtirtu pawl</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
