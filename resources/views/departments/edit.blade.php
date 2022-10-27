<x-admin-layout>
    <script>
        const calculate = function () {
            $('maximum_age').val(parseInt($('minimum_age').val()) + parseInt($('duration').val()) - 1)
        }
    </script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$department->name}} edit na:</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/departments">Departments</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/departments/{{$department->id}}">Department</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/admin/departments/{{$department->id}}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                  <label for="name"> Department Name:</label>
                  <input
                    type="text" autofocus
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    placeholder="Enter department name"
                    value="{{old('name')}}">

                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="minimum_age">Kum (minimum):</label>
                  <input
                    type="text"
                    class="form-control @error('minimum_age') is-invalid @enderror"
                    name="minimum_age"
                    placeholder="Enter minimum age"
                    value="{{old('minimum_age')}}">

                    <div class="invalid-feedback">
                        {{$errors->first('minimum_age')}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="duration">Duration:</label>
                  <input
                    type="text"
                    class="form-control @error('duration') is-invalid @enderror"
                    onkeyup="calculate()"
                    name="duration"
                    placeholder="Enter minimum age"
                    value="{{old('duration',3)}}">

                    <div class="invalid-feedback">
                        {{$errors->first('duration')}}
                    </div>
                </div>
                <div class="form-group">
                  <label for="maximum_age">Kum (minimum):</label>
                  <input
                    type="text" readonly
                    class="form-control @error('maximum_age') is-invalid @enderror"
                    name="maximum_age"
                    placeholder="Enter minimum age"
                    value="{{old('maximum_age')}}">

                    <div class="invalid-feedback">
                        {{$errors->first('maximum_age')}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
