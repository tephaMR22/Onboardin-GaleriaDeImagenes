@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($files as $file)
                <div class="col-4">
                    <div class="card">
                        <img src="{{asset($file->url)}}" alt="" class="img-fluid">
                        <div class="card-footer">
                            <a href="{{route('admin.files.edit', $file)}}" class="btn btn-primary">
                                Editar
                            </a>
                            <form 
                                action="{{route('admin.files.destroy', $file)}}" 
                                class="d-inline formulario-eliminar"
                                method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                {{$files->links()}}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Incluir SweetAlert2 desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
        </script>
    @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona todos los formularios con la clase 'formulario-eliminar'
            const deleteForms = document.querySelectorAll('.formulario-eliminar');

            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Evita el envío automático del formulario
                    
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Enviar el formulario si el usuario confirma
                        }
                    });
                });
            });
        });
    </script>
@endsection
