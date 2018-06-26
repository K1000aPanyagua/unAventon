
<div class="container">
   
  <div>
  
    @foreach ($rides as $ride)
      <tr>
        <a href="{{route('ride.show', $ride->id)}}">
          <td>
            Origen: {{$ride->origin}}
            Destino: {{$ride->destination}}
          </td>
        </a>
      </tr>
    @endforeach

  </div>

  {!! $rides ->render() !!}

</div>
