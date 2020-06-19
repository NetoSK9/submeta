@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 100px;">

  <div class="container" >
    <div class="row" >
      <div class="col-sm-10">        
          <h3>Meus Editais</h3>         
      </div>
      <div class="col-sm-2">
          <a href="{{route('evento.criar')}}" class="btn btn-primary" style="float: right;">Criar Edital</a>
      </div>
  </div>
  <hr>
    <table class="table table-bordered">
      <thead>
        <tr>   
          <th scope="col">Nome do Edital</th>
          <th scope="col">Data de Criação</th>
          <th scope="col">Opção</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($eventos as $evento)
          <tr>
            <td>
              <a href="{{  route('evento.visualizar',['id'=>$evento->id])  }}" class="visualizarEvento">
                  {{ $evento->nome }}
              </a>
            </td>
            <td>{{ date('d/m/Y', strtotime($evento->created_at)) }}</td>
            <td>
              @if(auth()->user()->id == $evento->criador_id)              
              <div class="btn-group dropright dropdown-options">
                  <a id="options" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <img src="{{asset('img/icons/ellipsis-v-solid.svg')}}" style="width:8px">
                  </a>
                  <div class="dropdown-menu">
                      <a href="{{ route('evento.editar', ['id' => $evento->id]) }}" class="dropdown-item text-center">
                         
                          Editar Edital
                      </a>
                      <a href="{{route('admin.atribuir', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                          
                          Atribuir Avaliadores
                      </a>
                      <a href="{{route('admin.pareceres', ['evento_id' => $evento->id])}}" class="dropdown-item text-center">
                          
                          Visualizar Pareceres
                      </a>
                      <form method="POST" action="{{route('evento.deletar',$evento->id)}}" class="text-center">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="dropdown-item">
                              
                              Deletar
                          </button>

                      </form>
                  </div>
              </div>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table> 

</div>

@endsection

@section('javascript')
<script>
  
</script>
@endsection
