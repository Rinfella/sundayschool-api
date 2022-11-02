<x-admin-layout>
    <script>
        const calculate = function () {
            $('#maximum_age').val(parseInt($('#minimum_age').val()) + parseInt($('#duration').val()) - 1)
            console.log('calculated function')
            console.log('min age :', typeof parseInt($('#minimum_age').val()))
            console.log('max age :', typeof $('#maximum_age').val())
            console.log('duration :', typeof $('#duration').val())
        }
    </script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department thar siamna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/departments">Departments</a></li>
                        <li class="breadcrumb-item active">Create Department</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/departments" method="post">
            @csrf
            <div class="form-group row ">
                <label class="form-label col-1" for="name">Name</label>
                <input class="form-control col-3 @error('name') is-invalid @enderror" type="text" name="name" id="name" autofocus value="{{old('name')}}" >
                <div class="invalid-feedback offset-1">{{$errors->first('name')}}</div>
            </div>
            <div class="form-group row">
                <label class="form-label col-1" for="minimum_age">Minimum Age</label>
                <input class="form-control col-3 @error('minimum_age') is-invalid @enderror" onkeyup="calculate()" type="number" name="minimum_age" id="minimum_age" value="{{old('minimum_age')}}">
                <div class="invalid-feedback offset-1">{{$errors->first('minimum_age')}}</div>
            </div>
            <div class="form-group row">
                <label class="form-label col-1" for="duration">Duration</label>
                <input class="form-control col-3 @error('duration') is-invalid @enderror" onkeyup="calculate()" type="number" name="duration" id="duration" value="{{old('duration', 3)}}">
                <div class="invalid-feedback offset-1">{{$errors->first('duration')}}</div>
            </div>
            <div class="form-group row">
                <label class="form-label col-1" for="maximum_age">Maximum Age</label>
                <input class="form-control col-3 @error('maximum_age') is-invalid @enderror" readonly type="number" name="maximum_age" id="maximum_age" value="{{old('maximum_age')}}">
                <div class="invalid-feedback offset-1">{{$errors->first('maximum_age')}}</div>
            </div>
            <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</x-admin-layout>
