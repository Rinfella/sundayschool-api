<div class="form-group row ">
    <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
    <select 
        class="form-control col-3 @error($setting->key) is-invalid @enderror"
        name="{{$setting->key}}[]"
        multiple
        id="{{$setting->key}}">
        <option value=""></option>
        @foreach (json_decode($setting->options) as $option)
        <option @selected(in_array($option, json_decode($setting->value))) value="{{$option}}">{{$option}}</option>
        @endforeach
    </select>
    <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
</div>