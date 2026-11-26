<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

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
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #1e3a5f;
        }

        a, button {
            display: inline-block;
            padding: 9px 13px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn {
            background: #1e3a5f;
            color: white;
            margin-bottom: 20px;
        }

        .edit {
            background: #2563eb;
            color: white;
        }

        .delete {
            background: #dc2626;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1e3a5f;
            color: white;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Administración de usuarios</h1>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <a href="{{ route('users.create') }}" class="btn">
        Registrar usuario
    </a>

    <a href="{{ route('dashboard') }}" class="btn">
        Volver al panel
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Roles</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @forelse ($user->roles as $role)
                            {{ $role->name }}@if (!$loop->last), @endif
                        @empty
                            Sin rol asignado
                        @endforelse
                    </td>

                    <td>
                        <div class="actions">
                            <a href="{{ route('users.edit', $user) }}"
                               class="edit">
                                Editar
                            </a>

                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay usuarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}

</div>

</body>
</html>
