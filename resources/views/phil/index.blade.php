@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Restaurant Analyzer

@stop

@section('sidebar')
    

    <p>Welcome to the About Page</p>
@stop

@section('content')
    <p>This is a website built using Laravel, PHP, and Bootstrap. It's very basic right now and doesn't really do anything, but soon I will connect a database to it and it will be totally mind-boggling.</p>
    
    @foreach($items as $item)

<h3>
        
        
        
        {{ $item->item_name }}
    
    </h3>

    <br>

@endforeach

@stop