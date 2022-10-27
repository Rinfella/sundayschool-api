<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pawl thar siamna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/groups">Pawl</a></li>
                        <li class="breadcrumb-item active">Create Groups</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/admin/groups" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="department_id" class="form-label"> Group:</label>
                    <select name="department_id"
                        id="department_id"
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        type="text"
                        autofocus>
                        <option value="0">Select Department</option>

                        @foreach ($departments as $department)
                            <option {{old('department_id') == $department->id ? 'selected' : ' '}} value="{{$departmetn->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>

                    <div class="invalid-feedback">
                        {{$errors->first('department_id')}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="number_of_groups" class="form-label">Number of groups (Pawl mamawh zat):</label>
                  <input
                    type="text"
                    class="form-control @error('minimum_age') is-invalid @enderror"
                    name="number_of_groups"
                    placeholder="Enter minimum age"
                    value="{{old('number_of_groups', 1)}}">

                    <div class="invalid-feedback">
                        {{$errors->first('number_of_groups')}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
