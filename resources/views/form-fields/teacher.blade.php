<div class="form-group row ">
    <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
    <select 
        class="form-control col-3 @error($setting->key) is-invalid @enderror"
        name="{{$setting->key}}"
        id="{{$setting->key}}">
        <option value=""></option>
        @foreach (App\Models\Teacher::with('user')->get() as $teacher)
        <option value="{{$teacher->id}}" {{$setting->value == $teacher->id ? 'selected' : ''}}>{{$teacher->user->name}}</option>
        @endforeach
    </select>
    <div class="invalid-feedback offset-3">{{ $errors->first($setting->key) }}</div>
</div>