@extends('layouts.app')

@section('content')
    <iframe src="{{ $findMeeting[0]->audienceRoomUrl }}" allow="camera; microphone; fullscreen; speaker; display-capture"
        style="width:100%;height:100vh;"></iframe>
@endsection
