<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department thar siamna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Departments</a></li>
                        <li class="breadcrumb-item active">Create Department</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/enrollment-entry">
            @csrf
            <div class="form-group row ">
                <label class="form-label col-1" for="name">Name</label>
                <input class="form-control col-3 @error('name') is-invalid @enderror" type="text" name="name" id="name" autofocus value="{{old('name')}}" >
                <div class="invalid-feedback offset-1">{{$errors->first('name')}}</div>
            </div>
            <div class="form-group row">
                <label class="form-label col-1" for="duration">Group</label>
                <input class="form-control col-3 @error('duration') is-invalid @enderror" onkeyup="calculate()" name="duration" id="duration" value="{{old('duration', 3)}}">
                <div class="invalid-feedback offset-1">{{$errors->first('duration')}}</div>
            </div>
            <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</x-admin-layout>