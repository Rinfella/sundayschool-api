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
        <form action="/admin/areas/{{ $area->id }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        placeholder="Enter name" value="{{ old('name') }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="person_in_charge">Person In Charge</label>
                    <select name="person_in_charge" value="{{ $area->person_in_charge }} {{ old('person_in_charge') }}"
                        class="form-control-sm @error('person_in_charge') is-invalid @enderror" id="person_in_charge">
                        <option value="">--Select one--</option>
                        @foreach ($elders as $elder)
                            <option @if ($area->person_in_charge == $elder->id) selected @endif value="{{ $elder->id }}">
                                {{ $elder->name }} {{ $elder->email }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" name="person_in_charge" placeholder="Enter number"> --}}
                    <div class="invalid-feedback">
                        {{ $errors->first('person_in_charge') }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </section>
</x-admin-layout>
