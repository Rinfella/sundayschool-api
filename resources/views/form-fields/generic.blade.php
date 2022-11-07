<div class="form-group row ">
    <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
    <input 
        class="form-control col-3 @error($setting->key) is-invalid @enderror"
        type="{{$setting->type}}"
        name="{{$setting->key}}"
        id="{{$setting->key}}"
        value="{{ old($setting->key, $setting->value) }}">
    <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
</div>