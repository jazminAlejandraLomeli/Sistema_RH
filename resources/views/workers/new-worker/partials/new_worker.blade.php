 {{-- Vista para agregar a una persona nueva al sistema  --}}
 @extends('admin.layouts.main')
 @section('title', 'Agregar')

 @section('viteConfig')
     @vite(['resources/sass/StyleForm.scss'])
 @endsection
 @section('titleView', 'Agregar una persona al sistema')

 @section('content')
     <div class="container ">

      

         @include('admin.new-worker.partials.personal-data-form')
         <br>
         
         @include('admin.new-worker.partials.job-form')
         <br><br>
    
     
     @endsection

     @section('scripts')
         @vite('resources/js/new-worker/new-worker.js')
     @endsection