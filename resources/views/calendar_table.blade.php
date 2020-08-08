<table class="table table-bordered">
  <thead class="thead-dark ">
    <tr>
      <th scope="col"></th>
      @foreach($dates as $date)
      <th scope="col">{{ $date }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($timeShifts as $key => $timeShift)
    <tr>
      <th scope="row">{{ $timeShift['title'] }}</th>
      @foreach($events[$companyIndex][$key] as $event)
      @if($event)
      <td>
        <div>{{ $event['project_title'] }}</div>
        <div>{{ $event['cost'] }}</div>
        <div>{{ $event['project_type'] }}</div>
        <div>{{ $event['duty_holder_full_name'] }}</div>
      </td>
      @else
      <td>-</td>
      @endif
      @endforeach
    </tr>
    @endforeach
  </tbody>
</table>
