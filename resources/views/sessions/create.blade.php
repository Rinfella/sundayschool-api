<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sessions Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Sessions</a></li>
                        <li class="breadcrumb-item active">Create Sessions</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/admin/sessions" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input
                        type="text"
                        class="form-control @error('year') is-invalid @enderror"
                        name="year"
                        autofocus
                        placeholder="Enter year"
                        value="{{old('year')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('year')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_month">Start Month</label>
                    <input
                        type="text"
                        class="form-control @error('start_month') is-invalid @enderror"
                        name="start_month"
                        placeholder="Enter start month"
                        value="{{old('start_month')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('start_month')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_month">End Month</label>
                    <input
                        type="text"
                        class="form-control @error('end_month') is-invalid @enderror"
                        name="end_month"
                        placeholder="Enter end month"
                        value="{{old('end_month')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('end_month')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="honour_cutoff">Honour Cutoff</label>
                    <input
                        type="text"
                        class="form-control @error('honour_cutoff') is-invalid @enderror"
                        name="honour_cutoff"
                        placeholder="Enter honour mark cutoff"
                        value="{{old('honour_cutoff')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('honour_cutoff')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exam_full_mark">Exam Mark</label>
                    <input
                        type="text"
                        class="form-control @error('exam_full_mark') is-invalid @enderror"
                        name="exam_full_mark"
                        placeholder="Enter exam mark"
                        value="{{old('exam_full_mark')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('exam_full_mark')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_number_of_sunday_schools">Number of sunday schools</label>
                    <input
                        type="text"
                        class="form-control @error('total_number_of_sunday_schools') is-invalid @enderror"
                        name="total_number_of_sunday_schools"
                        placeholder="Enter total number of sunday schools"
                        value="{{old('total_number_of_sunday_schools')}}">
                    <div class="invalid-feedback">
                        {{$errors->first('total_number_of_sunday_schools')}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
