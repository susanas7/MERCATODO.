@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Eliminar</th>
                      </tr>
                      </thead>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->role}}</td>
                          <td>
                              <a href="{{route('users.edit', $user->id)}}">Editar<a/>
                          </td>
                          <td>
                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                              @method('DELETE')
                              @csrf
                              <input type="submit"
                              value="Eliminar"
                              onclick="return confirm('¿Desea eliminar?')">
                            </form>

                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
