@extends('layouts.app_front')

@section('title', 'Visi dan Misi Desa Digital')

@section('content')
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Visi dan Misi Desa Digital</h1>
            <p class="text-blue-200 mt-2">Mewujudkan desa yang maju, mandiri, dan berbudaya</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Visi -->
            @if ($villageVision)
                <div class="w-full md:w-1/2 px-4 mb-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <div class="bg-blue-600 text-white p-4">
                            <h3 class="text-xl font-bold"><i class="fas fa-eye mr-2"></i>Visi Desa Digital</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 leading-relaxed text-justify">{{ $villageVision->content }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Misi -->
            @if ($villageMission)
                <div class="w-full md:w-1/2 px-4 mb-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                        <div class="bg-green-600 text-white p-4">
                            <h3 class="text-xl font-bold"><i class="fas fa-bullseye mr-2"></i>Misi Desa Digital</h3>
                        </div>
                        <div class="p-6">
                            <div class="text-gray-700 leading-relaxed">{!! $villageMission->content !!}</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Image -->
            <div class="w-full px-4 text-center">
                <img src="{{ asset('img/profilevillage/visimisi.png') }}" alt="Visi dan Misi Desa Digital" class="w-full md:w-2/3 mx-auto h-auto rounded-lg shadow-md">
            </div>
        </div>
    </div>
@endsection
