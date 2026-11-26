<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>

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

        h1 {
            color: #1e3a5f;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        .role {
            margin-top: 10px;
        }

        .role input {
            width: auto;
        }

        .role label {
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

    <h1>Registrar usuario</h1>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label for="name">Nombre</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >

        <label for="email">Correo electrónico</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <label for="password">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <label>Roles del usuario</label>

        @foreach ($roles as $role)
            <div class="role">
                <input
                    type="checkbox"
                    name="roles[]"
                    value="{{ $role->id }}"
                    id="role_{{ $role->id }}"
                    {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                >

                <label for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
        @endforeach

        <button type="submit">Registrar usuario</button>

        <a href="{{ route('users.index') }}">Volver</a>

    </form>

</div>

</body>
</html>
