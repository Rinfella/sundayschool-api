<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/admin/settings/" method="post">
                                <select name="" multiple id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                @csrf
                                @foreach ($settings as $index => $setting)
                                    <div class="form-group row ">
                                        <label class="form-label col-3 text-right"
                                            for="{{ $setting->key }}">{{ $setting->key }}</label>
                                        @if ($setting->key == 'absent_types')
                                            @foreach(json_decode($setting->value) as $type)
                                            <input @class([
                                                'form-control',
                                                'col-3',
                                                'is-invalid' => $errors->has($setting->key),
                                            ]) type="text"
                                                name="{{ $setting->key }}[]" id="{{ $setting->key }}.{{$type}}"
                                                value="{{ $type }}">
                                            @endforeach
                                            <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}
                                            </div>
                                        @else
                                            <input @class([
                                                'form-control',
                                                'col-3',
                                                'is-invalid' => $errors->has($setting->key),
                                            ]) type="text"
                                                name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                value="{{ $setting->value }}">

                                            <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="offset-3">

                                        <input class="btn btn-primary" type="submit" value="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
