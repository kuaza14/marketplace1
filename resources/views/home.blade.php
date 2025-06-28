    @extends('layout')
    
    @section('content')
    <div class="col">
      <h2 class="page-title">
          bienvenido {{ Auth::user()->nombre }} a tu panel de control
          <small class= "text-muted">rol [ {{ auth::user()->rol }}]</small>;
      </h2>
    </div>
    
    @stop

@section('content')

     Aqui va la graficas
    @stop

    
   