<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department thar siamna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Department</a></li>
                        <li class="breadcrumb-item active">Create Department</li>
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
                    <input type="text" class="form-control col-3 @error('year') is-invalid @enderror" name="year"
                        placeholder="Enter year" value="{{ old('year') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_month">Start Month</label>
                    {{-- <input type="text" class="form-control @error('year') is-invalid @enderror" name="year"
                        placeholder="Enter year" value="{{ old('year') }}"> --}}
                        <select class="form-control col-1 @error('start_month') is-invalid @enderror" name="start_month" value="{{ old('start_month') }}">
                            <option selected>-- Select month --</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                          </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('start_month') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_month">End Month</label>
                    {{-- <input type="text" class="form-control @error('year') is-invalid @enderror" name="year"
                        placeholder="Enter year" value="{{ old('year') }}"> --}}
                        <select class="form-control col-1 @error('end_month') is-invalid @enderror" name="end_month" value="{{ old('end_month') }}">
                            <option selected>-- Select month --</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                          </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('end_month') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="honor_cutoff">Honor Cutoff</label>
                    <input type="text" class="form-control col-3 @error('honor_cutoff') is-invalid @enderror" name="honor_cutoff"
                        placeholder="Enter Honor Mark" value="{{ old('honor_cutoff') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('honor_cutoff') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="text">Exam Mark</label>
                    <input type="text" class="form-control col-3 @error('exam_full_mark') is-invalid @enderror" name="exam_full_mark"
                        placeholder="Enter Exam Mark" value="{{ old('exam_full_mark') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('exam_full_mark') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="total_number_of_sunday_schools">Total Number of Sunday School</label>
                    <input type="text" class="form-control col-3 @error('total_number_of_sunday_schools') is-invalid @enderror" name="total_number_of_sunday_schools"
                        placeholder="Enter Total Number of Sunday School" value="{{ old('total_number_of_sunday_schools') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('total_number_of_sunday_schools') }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
