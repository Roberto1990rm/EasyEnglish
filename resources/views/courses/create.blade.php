@extends('layouts.app')

@section('title', 'Crear nuevo curso')

@section('content')

<div style="margin-top: -15px;" class="container mx-auto px-4 py-8 ">
    <div  class="text-center">
    <h1 style="color:antiquewhite; text-shadow: black 3px 3px 6px;" class="text-3xl font-bold text-gray-800 mb-6">Crear Nuevo Curso</h1>
</div>
    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Título del curso:</label>
            <input type="text" name="title" class="form-control w-full border rounded p-2" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="editor" name="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Imagen principal:</label>
            <input type="file" name="image" class="form-control w-full border rounded p-2" required>
        </div>

        <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Crear curso</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4 py-2">Cancelar</a>
    </form>
</div>

<!-- TinyMCE desde CDNJS (sin API key) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" crossorigin="anonymous"></script>

<script>
  tinymce.init({
    selector: '#editor',
    plugins: 'lists link table code',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link blockquote',
    menubar: false,
    branding: false,
    font_family_formats: 'Arial=arial,helvetica,sans-serif;Georgia=georgia,serif;Times New Roman=times new roman;Courier New=courier new,courier;Verdana=verdana,geneva,sans-serif',
    fontsize_formats: '10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
    height: 400
  });
</script>

@endsection
