<div class="form-group row">
    <label class="form-label col-3 text-right" for="{{$setting->key}}">{{$setting->title}}</label>
    <div class="col-9">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                id="{{$setting->key}}"
                name="{{$setting->key}}"
                value="{{ old($setting->key, 1) }}"
                @checked($setting->value == 1)>
        </div>
    </div>
</div>
