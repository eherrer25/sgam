<table>
    <thead>
    <tr>
        <th >#</th>
        <th >Residente</th>
        <th >Run</th>
        <th >Apoderado</th>
        <th >Habitación</th>
        <th >Cant. cuidados</th>
        <th >Ficha actualizada</th>
    </tr>
    </thead>
    <tbody>
    @foreach($residents as $resident)
        <tr>
            <td>{{$resident->id}}</td>
            <td>{{$resident->full_name}}</td>
            <td>{{$resident->run}}</td>
            <td>{{$resident->client->full_name}}</td>
            <td>{{$resident->bed->room->name .' - '.$resident->bed->name}}</td>
            <td>{{$resident->nursings->count()}}</td>
            <td>
                @if($resident->record != null)
                    {{intval($resident->record->updated_at->format('m')) >= intval($month) ? 'Sí' : 'No'}}
                @else
                    No tiene
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
