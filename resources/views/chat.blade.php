@extends('layouts.apps')

@section('title')
    Messenger | UKM Trading & Service System
@endsection

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first" style="text-align: right;">
                    <h1 style="overflow-wrap: break-word; max-width: 20ch;">Messenger</h1>
                </div>
            </div>
        </div>
    </section>  

<section class="cart_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Messenger</div>
                    <div class="card-body" id="app">
                        <chat-app :user="{{ Auth::user() }}"></chat-app>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script src="{{ mix('js/app.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
@section('scripts')
@endsection