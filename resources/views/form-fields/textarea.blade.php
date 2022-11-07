<div class="form-group row ">
    <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
    <textarea 
        class="form-control col-3 @error($setting->key) is-invalid @enderror"
        name="{{$setting->key}}"
        id="{{$setting->key}}">{{ old($setting->key, $setting->value) }}</textarea>
    <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
</div>