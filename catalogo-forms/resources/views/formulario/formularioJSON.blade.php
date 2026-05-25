<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/json.css') }}">
    <title>Formulario JSON</title>
</head>

<body>
    @include('burguermenu._menu')

    <form method="POST" id="camposFormulario" class="form-json">
        @csrf

        <div>
            <label class="form-label">NombreForm</label>
            <input class="form-input" type="text" name="nombre_form" value="{{ $tag->nombre }}-{{ $formulario->nombreForm }}" disabled>
        </div>

        @foreach($campos as $campo)

        @php
        $value = $campo['value'];
        @endphp

        <div>
            <label class="form-label">{{ $campo['label'] }}</label>

            {{-- Campos simples --}}
            @if(in_array($campo['type'], ['text','email','number']))
            @if(is_array($value) || is_object($value))
            @foreach((array)$value as $subKey => $subValue)
            <div class="form-subgroup">
                <label class="form-sublabel">{{ ucfirst($subKey) }}</label>
                <input
                    class="form-input"
                    type="text"
                    name="{{ $campo['name'] }}[{{ $subKey }}]"
                    value="{{ $subValue }}">
            </div>
            @endforeach
            @else
            <input
                class="form-input"
                type="{{ $campo['type'] }}"
                name="{{ $campo['name'] }}"
                value="{{ $value }}">
            @endif

            {{-- Textarea --}}
            @elseif($campo['type'] == 'textarea')
            @if(is_array($value) || is_object($value))
            @foreach((array)$value as $subKey => $subValue)
            <div class="form-subgroup">
                <label class="form-sublabel">{{ ucfirst($subKey) }}</label>
                <textarea
                    class="form-textarea"
                    name="{{ $campo['name'] }}[{{ $subKey }}]">{{ $subValue }}</textarea>
            </div>
            @endforeach
            @else
            <textarea
                class="form-textarea"
                name="{{ $campo['name'] }}">{{ $value }}</textarea>
            @endif

            {{-- Checkbox --}}
            @elseif($campo['type'] == 'checkbox')
            @if(isset($campo['options']) && is_array($campo['options']))
            @foreach($campo['options'] as $option)
            <div>
                <input
                    class="form-checkbox"
                    type="checkbox"
                    name="{{ $campo['name'] }}{{ $campo['multiple'] ?? false ? '[]' : '' }}"
                    value="{{ $option }}"
                    {{ is_array($value) && in_array($option, $value) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $option }}</label>
            </div>
            @endforeach
            @else
            <div class="form-check">
                <input
                    class="form-checkbox"
                    type="checkbox"
                    name="{{ $campo['name'] }}"
                    value="1"
                    {{ $value ? 'checked' : '' }}>
            </div>
            @endif

            {{-- Select --}}
            @elseif($campo['type'] == 'select')
            <select
                name="{{ $campo['name'] }}{{ $campo['multiple'] ?? false ? '[]' : '' }}"
                {{ $campo['multiple'] ?? false ? 'multiple' : '' }}>
                @foreach($campo['options'] as $option)
                <option
                    value="{{ is_array($option) ? '' : $option }}"
                    {{ (is_array($value) && in_array($option, $value)) || $value == $option ? 'selected' : '' }}>
                    {{ is_array($option) ? '' : $option }}
                </option>
                @endforeach
            </select>

            {{-- Array de objetos --}}
            @elseif(is_array($value) && count($value) > 0 && is_array($value[0]))
            @foreach($value as $index => $item)
            <div class="form-array-item">
                @foreach($item as $subKey => $subValue)
                <div class="form-subgroup">
                    <label class="form-sublabel">{{ ucfirst($subKey) }}</label>
                    <input
                        class="form-input"
                        type="text"
                        name="{{ $campo['name'] }}[{{ $index }}][{{ $subKey }}]"
                        value="{{ $subValue }}">
                </div>
                @endforeach
            </div>
            @endforeach
            @endif

        </div>
        @endforeach

        <div class="botones">
            <button type="button" id="copiarBtn" class="btn-primary">
                Copiar al portapapeles
            </button>
        </div>
    </form>

    <script src="{{ asset('js/copiarPortaPapeles.js') }}?v=1"></script>
</body>

</html>