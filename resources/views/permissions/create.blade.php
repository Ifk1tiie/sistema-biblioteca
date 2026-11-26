<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear permiso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 { color: #1e3a5f; }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #1e3a5f;
            color: white;
        }

        a {
            background: #64748b;
            color: white;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Crear permiso</h1>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf

        <label for="name">Nombre del permiso</label>
        <input type="text" id="name" name="name"
               value="{{ old('name') }}" maxlength="100" required>

        <label for="description">Descripción</label>
        <textarea id="description" name="description"
                  maxlength="255" rows="4">{{ old('description') }}</textarea>

        <button type="submit">Guardar permiso</button>
        <a href="{{ route('permissions.index') }}">Volver</a>
    </form>
</div>

</body>
</html>
