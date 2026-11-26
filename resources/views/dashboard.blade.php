<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel principal - Biblioteca Digital</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        header {
            background: #1e3a5f;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
        }

        .logout {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        main {
            padding: 30px;
        }

        .welcome {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        h2 {
            color: #1e3a5f;
        }

        .modules {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .module {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .module h3 {
            color: #1e3a5f;
        }

        .module a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #1e3a5f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .no-access {
            background: white;
            padding: 20px;
            border-radius: 10px;
            color: #64748b;
        }
    </style>
</head>
<body>

<header>
    <h1>Biblioteca Digital</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout">Cerrar sesión</button>
    </form>
</header>

<main>

    <section class="welcome">
        <h2>Panel de administración</h2>

        <p>Bienvenido, {{ Auth::user()->name }}.</p>

        <p>Desde aquí puedes acceder a los módulos autorizados según tus permisos.</p>
    </section>

    <section class="modules">

        @if (Auth::user()->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'gestionar_usuarios');
        })->exists())

            <div class="module">
                <h3>Usuarios</h3>
                <p>Registra, consulta, modifica y elimina usuarios.</p>
                <a href="{{ route('users.index') }}">Administrar usuarios</a>
            </div>

        @endif

        @if (Auth::user()->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'gestionar_roles');
        })->exists())

            <div class="module">
                <h3>Roles</h3>
                <p>Administra los roles asignados a los usuarios.</p>
                <a href="{{ route('roles.index') }}">Administrar roles</a>
            </div>

        @endif

        @if (Auth::user()->roles()->whereHas('permissions', function ($query) {
            $query->where('name', 'gestionar_permisos');
        })->exists())

            <div class="module">
                <h3>Permisos</h3>
                <p>Gestiona los permisos disponibles en el sistema.</p>
                <a href="{{ route('permissions.index') }}">Administrar permisos</a>
            </div>

        @endif

        @if (!Auth::user()->roles()->whereHas('permissions')->exists())
            <div class="no-access">
                <p>No tienes permisos asignados para acceder a los módulos administrativos.</p>
            </div>
        @endif

    </section>

</main>

</body>
</html>
