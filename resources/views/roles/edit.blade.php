<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar rol</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        textarea { resize: vertical; }

        .permission { margin-top: 10px; }

        .permission input { width: auto; }

        .permission label {
            display: inline;
            margin-left: 5px;
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

    <h1>Editar rol</h1>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre del rol</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $role->name) }}"
            maxlength="100"
            required
        >

        <label for="description">Descripción</label>
        <textarea
            id="description"
            name="description"
            rows="4"
        >{{ old('description', $role->description) }}</textarea>

        <label>Permisos del rol</label>

        @foreach ($permissions as $permission)
            <div class="permission">
                <input
                    type="checkbox"
                    name="permissions[]"
                    value="{{ $permission->id }}"
                    id="permission_{{ $permission->id }}"
                    {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                >

                <label for="permission_{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            </div>
        @endforeach

        <button type="submit">Actualizar rol</button>

        <a href="{{ route('roles.index') }}">Volver</a>

    </form>

</div>

</body>
</html>
