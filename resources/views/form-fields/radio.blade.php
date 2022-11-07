<div class="form-group row">
    <label class="form-label col-3 text-right">{{$setting->title}}</label>
    <div class="col-9">
        @foreach(json_decode($setting->options) as $option)
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="{{$setting->key}}-{{$option}}"
                name="{{$setting->key}}"
                value="{{$option}}"
                @checked($setting->value == $option)
                >
            <label for="{{$setting->key}}-{{$option}}" class="form-check-label">{{$option}}</label>
        </div>
        @endforeach
    </div>
</div>