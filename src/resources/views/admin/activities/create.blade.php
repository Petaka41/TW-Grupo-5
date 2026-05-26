@extends('layouts.public')

@section('title', 'Nueva Actividad — Admin')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="space-y-2">
                    <p class="text-sm uppercase tracking-wider text-gray-500">Administración</p>
                    <h3 class="text-2xl font-semibold text-gray-900">Nueva Actividad</h3>
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('admin.activities.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Capacidad máxima</label>
                        <input type="number" name="max_capacity" value="{{ old('max_capacity', 1) }}" min="1" required class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen</label>
                        <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-[#ff6b35] text-white rounded-md text-sm">Guardar</button>
                        <a href="{{ route('admin.activities.index') }}" class="px-4 py-2 border rounded-md text-sm">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
