<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de roles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            color: #1e3a5f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        a, button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .add {
            background: #1e3a5f;
            color: white;
        }

        .edit {
            background: #eab308;
            color: black;
        }

        .delete {
            background: #dc2626;
            color: white;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Administración de roles</h1>

    <a href="{{ route('roles.create') }}" class="add">Crear rol</a>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Permisos asignados</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            {{ $permission->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role) }}" class="edit">Editar</a>

                        <form action="{{ route('roles.destroy', $role) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete"
                                onclick="return confirm('¿Eliminar este rol?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay roles registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->links() }}
</div>

</body>
</html>
