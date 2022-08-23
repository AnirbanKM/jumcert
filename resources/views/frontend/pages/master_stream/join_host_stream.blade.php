@extends('layouts.app')

@section('content')
    <iframe src="{{ $findMeeting[0]->hostRoomUrl }}" allow="camera; microphone; fullscreen; speaker; display-capture"
        style="width:100%;height:100vh;"></iframe>
@endsection
