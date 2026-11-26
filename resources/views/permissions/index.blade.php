<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de permisos</title>
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

        h1 { color: #1e3a5f; }

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

        .success { color: green; }
    </style>
</head>
<body>

<div class="container">
    <h1>Administración de permisos</h1>

    <a href="{{ route('permissions.create') }}" class="add">Crear permiso</a>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission) }}"
                           class="edit">Editar</a>

                        <form action="{{ route('permissions.destroy', $permission) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete"
                                onclick="return confirm('¿Eliminar este permiso?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay permisos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $permissions->links() }}
</div>

</body>
</html>
