@props([
    'name', 'options', 'checked' => false ,
])

@foreach($options as $value => $text)
    <div class="form-check">
        <label class="form-check-label">
        <input type="radio"
                name="{{$name}}"
                value="{{$value}}"
                @checked(old($name , $checked) == $value)
                @class([
                    'form-check-input',
                    'is-invalid' => $errors->has($name)
                ])
        >
        {{$text}}
        </label>
    </div>
@endforeach
