@extends('layouts.app')
@section('content')
@if ($owner)
<p>Owner:-- {{$owner}}</p>
<p>Model:-- {{$car}}</p>
@endif
@endsection
{{-- @php --}}

{{-- // echo "<pre>";
//                 print_r($data);
//                 die;
// if ($data) {
//     echo "hello";
// } --}}
{{-- @endphp --}}

{{-- @if ($data)
    <p>hello</p>
@endif --}}

{{-- @foreach ($data as $item)
        <p>hello</p>
@endforeach --}}
