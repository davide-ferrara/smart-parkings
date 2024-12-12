@props(['active' => false])

<a {{$attributes}} class="{{ $active ? 'navbar-active' : 'navbar-inactive' }}">{{$slot}}</a>
