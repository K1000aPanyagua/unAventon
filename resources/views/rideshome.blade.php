
<div class="container">
   
  <div>
  
    @foreach ($rides as $ride)
      <tr>
        <a href="{{route('ride.show', $ride->id)}}">
          <td>
            Origen: {{$ride->origin}}
            Destino: {{$ride->destination}}
            <br><br>
          </td>
        </a>
      </tr>
    @endforeach

  </div>

  

</div>
