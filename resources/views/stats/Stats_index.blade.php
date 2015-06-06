@extends('layouts.master')

@section('title')
Restaurant Analyzer
@stop

@section('maintitle')
Data Analysis

@stop

@section('sidebar')

@stop
    
@section('content')

<div class="container">
    <section ng-app="myApp" ng-controller="TabController as tab">
        <ul class="nav nav-pills">
            <li ng-class="{active:tab.isSet(1)}"><a href ng-click="tab.setTab(1)">Orders (Phil)</a></li>
            <li ng-class="{active:tab.isSet(2)}"><a href ng-click="tab.setTab(2)">Total Profits (Jeesoo)</a></li>
            <li ng-class="{active:tab.isSet(3)}"><a href ng-click="tab.setTab(3)">Items (Johnson)</a></li>
        </ul>
        
        <div ng-show="tab.isSet(1)">
            <h4>Tab 1</h4>
        </div>
        <div ng-show="tab.isSet(2)">
             <h4>Tab 2</h4>
        </div>
        <div ng-show="tab.isSet(3)">
             <h4>Tab 3</h4>
        </div>
    </section>
</div>

@stop