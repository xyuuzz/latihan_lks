@props([
    "type" => "text",
    "class" => ""
])

<input type={{$type}} class="form-control {{$class}}" {{$attributes}}>
