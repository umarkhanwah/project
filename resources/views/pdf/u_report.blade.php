<style>
    li{
        list-style: none;
        font-family:cursive;
        font-size: 30px;
        margin: 10px 0;
    }
</style>
@foreach ($testReports as $r)
    
<div style="border:2px solid red;padding:10px;">
  <ul>
    <li>
        Patient Name:{{$r->user->name}}    
    </li>
    <li>
        Patient Age:{{$r->user->age}}    
    </li>
    <li>
        Patient Sex:{{$r->user->gender}}    
    </li>
    <li>
        Hospital Name:{{$r->hospital->name}}    
    </li>
    <li>
        Covid :{{$r->status}}    
    </li>
    <li>
        Name of Vaccination :{{$r->vaccination}}    
    </li>
  </ul>
  
    {{-- <h1>{{$r->user->name}}</h1>
<h1>{{$r->hospital->name}}</h1>
<h1>{{$r->status}}</h1> --}}
{{-- <h1>{{$r->vaccination}}</h1> --}}
</div>
@endforeach