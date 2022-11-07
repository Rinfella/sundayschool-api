<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings configuration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/settings">Settings</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/settings-config" method="post">
                @csrf
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="title">Title</label>
                    <input class="form-control col-3 @error('title') is-invalid @enderror" type="text" name="title"
                        id="title" value="{{ old('title') }}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('title') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="key">Key</label>
                    <input class="form-control col-3 @error('key') is-invalid @enderror" type="text" name="key"
                        id="key" value="{{ old('key') }}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('key') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="options">Value</label>
                    <input class="form-control col-3 @error('value') is-invalid @enderror" type="text" name="value"
                        id="value" value="{{ old('value') }}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('value') }}</div>
                </div>
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="type">Type</label>
                    <select class="form-control col-3 @error('type') is-invalid @enderror" name="type"
                        id="type" >
                        @foreach ($types as $typeKey => $type)
                            <option value="{{$typeKey}}">{{$type}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('type') }}</div>
                </div>
                
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="options">Options</label>
                    <input class="form-control col-3 @error('options') is-invalid @enderror" type="text" name="options"
                        id="options" value="{{ old('options') }}">
                    <div class="invalid-feedback offset-3">{{ $errors->first('options') }}</div>
                </div>
                <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</x-admin-layout>
