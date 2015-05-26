{{!--@extends('layouts.recipelayout')

@section('content')
--}}

<!-- 
<div>List of Recipes</div>
<h2>List of recipes</h2>
-->

@foreach($recipes as $recipe)

<h3><a href="{{ url('/recipes', $recipe->dish_id) }}">{{ $recipe->dish_id }} {{ $recipe->dish_name }}</a></h3>
<a href="{{ URL::to('/recipes')}}/{{$recipe->dish_id}}/delete">Delete </a>
{{--    <div>
        {{ $recipe-> dish_ingredients }} : {{ $recipe -> dish_steps }}        
    </div>--}}
    <br>

@endforeach

@stop