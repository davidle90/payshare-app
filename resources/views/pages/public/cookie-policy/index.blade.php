@extends('layouts.public.main')

@section('styles')
@endsection

@section('modals')
@endsection

@section('content')
    <div class="container mx-auto text-white px-4 py-12 flex justify-center">
        <div class="text-gray-900">
            <h1 class="text-3xl font-semibold mb-4">Cookie Policy</h1>
            <p class="mb-4">
                Denna webbplats använder cookies för att förbättra din upplevelse.<br>
                Cookies är små textfiler som lagras på din enhet när du besöker en webbplats.
            </p>

            <h2 class="text-2xl font-semibold mb-2">Vilka Cookies Använder Vi?</h2>
            <p class="mb-4">Vi använder följande typer av cookies:</p>
            <ul class="list-disc pl-6 mb-6">
                <li><strong>Nödvändiga cookies:</strong> För webbplatsens funktionalitet.</li>
                <li><strong>Prestandacookies:</strong> För att analysera webbplatsens användning.</li>
                <li><strong>Funktionella cookies:</strong> För att komma ihåg dina inställningar.</li>
                <li><strong>Målinriktade cookies:</strong> För annonsering och marknadsföring.</li>
            </ul>

            <h2 class="text-2xl font-semibold mb-2">Hur Hanterar Jag Cookies?</h2>
            <p class="mb-4">
                Du kan hantera och inaktivera cookies via inställningarna i din webbläsare. <br>
                Vänligen notera att vissa funktioner på webbplatsen kan påverkas om du inaktiverar cookies.
            </p>

            <a href="/" class="text-blue-400 hover:text-blue-600">Tillbaka till hemsidan</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
