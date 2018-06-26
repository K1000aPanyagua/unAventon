
<div class="container">
   
  <div>
  
    @foreach ($rides as $ride)
      <tr>
        <td>
        Origen: {{$ride->origin}}
        </td>
        <td>
        Destino: {{$ride->destination}}
        </td>
      </tr>
    @endforeach

  </div>

  {!! $rides ->render() !!}

</div>
