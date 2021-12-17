@extends('layouts.blankpage')
@section('content')
    @livewire('crypto-exchange-widget', ['referralid' => "$referralid"])
@endsection