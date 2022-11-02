<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Areas</a></li>
                        <li class="breadcrumb-item active">Create Area</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/admin/sessions/{{ $session->id }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control col-3 @error('year') is-invalid @enderror" name="year"
                        placeholder="Enter name" value="{{ $session->year }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_month">Start Month</label>
                    <input type="text" class="form-control col-3 @error('start_month') is-invalid @enderror"
                        name="start_month" placeholder="Enter name" value="{{ $session->start_month }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('start_month') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_month">End Month</label>
                    <input type="text" class="form-control col-3 @error('end_month') is-invalid @enderror"
                        name="end_month" placeholder="Enter name" value="{{ $session->end_month }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('end_month') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="honor_cutoff">Honor Cutoff</label>
                    <input type="text" class="form-control col-3 @error('honor_cutoff') is-invalid @enderror"
                        name="honor_cutoff" placeholder="Enter name" value="{{ $session->honor_cutoff }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('honor_cutoff') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exam_full_mark">Exam Full Mark</label>
                    <input type="text" class="form-control col-3 @error('exam_full_mark') is-invalid @enderror"
                        name="exam_full_mark" placeholder="Enter name" value="{{ $session->exam_full_mark }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('exam_full_mark') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_number_of_sunday_schools">Total Number of Sunday Schools</label>
                    <input type="text" class="form-control col-3 @error('total_number_of_sunday_schools') is-invalid @enderror" name="total_number_of_sunday_schools"
                        placeholder="Enter name" value="{{ $session->total_number_of_sunday_schools }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('total_number_of_sunday_schools') }}
                    </div>
                </div>
                                {{-- <div class="form-group">
                    <label for="person_in_charge">Person In Charge</label>
                    <select name="person_in_charge" value="{{ $area->person_in_charge }} {{ old('person_in_charge') }}"
                        class="form-control-sm @error('person_in_charge') is-invalid @enderror" id="person_in_charge">
                        <option value="">--Select one--</option>
                        @foreach ($elders as $elder)
                            <option @if ($area->person_in_charge == $elder->id) selected @endif value="{{ $elder->id }}">
                                {{ $elder->name }} {{ $elder->email }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control" name="person_in_charge" placeholder="Enter number">
                    <div class="invalid-feedback">
                        {{ $errors->first('person_in_charge') }}
                    </div>
                </div> --}}
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
