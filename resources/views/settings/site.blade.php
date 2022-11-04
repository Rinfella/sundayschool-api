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
                        <li class="breadcrumb-item active">Website Settings</li>
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
                            <form action="/admin/settings" method="post">
                                @csrf
                                @foreach ($settings as $setting)
                                    @if($setting->type == 'select')
                                    <div class="form-group row ">
                                        <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
                                        <select
                                            class="form-control col-3 @error($setting->key) is-invalid @enderror"
                                            name="{{$setting->key}}"
                                            id="{{$setting->key}}">
                                            <option value=""></option>
                                            @foreach (json_decode($setting->options) as $optionValue => $optionLabel)
                                            <option value="{{$optionValue}}" {{$setting->value == $optionValue ? 'selected' : ''}}>{{$optionLabel}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
                                    </div>
                                    @else
                                        @if ($setting->type == 'textarea')
                                        <div class="form-group row ">
                                            <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
                                            <textarea
                                                class="form-control col-3 @error($setting->key) is-invalid @enderror"
                                                name="{{$setting->key}}"
                                                id="{{$setting->key}}">{{ old($setting->key, $setting->value) }}</textarea>
                                            <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
                                        </div>
                                        @else
                                        <div class="form-group row ">
                                            <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
                                            <input
                                                class="form-control col-3 @error($setting->key) is-invalid @enderror"
                                                type="{{$setting->type}}"
                                                name="{{$setting->key}}"
                                                id="{{$setting->key}}" value="{{ old($setting->key, $setting->value) }}">
                                            <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
                                        </div>
                                        @endif

                                    @endif
                                @endforeach

                                <input type="submit" class="btn btn-primary" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
