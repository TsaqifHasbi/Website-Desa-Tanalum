@extends('layouts.app')

@section('title', 'Peta Desa')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 70vh;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white">PETA DESA</h1>
            <p class="text-green-100">Menampilkan Peta Desa Dengan Interest Point Desa Tanalum</p>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <!-- Map Controls -->
                <div class="p-4 border-b flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 font-medium">Filter:</span>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="map-filter w-4 h-4 text-green-600 rounded mr-2" data-type="wisata"
                                checked>
                            <span class="text-sm text-gray-700">Wisata</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="map-filter w-4 h-4 text-green-600 rounded mr-2" data-type="umkm"
                                checked>
                            <span class="text-sm text-gray-700">UMKM</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="map-filter w-4 h-4 text-green-600 rounded mr-2"
                                data-type="fasilitas" checked>
                            <span class="text-sm text-gray-700">Fasilitas Umum</span>
                        </label>
                    </div>
                    <div class="text-sm text-gray-500">
                        Geospasial Desa Tanalum
                    </div>
                </div>

                <!-- Map Container -->
                <div id="map"></div>

                <!-- Legend -->
                <div class="p-4 bg-gray-50 border-t">
                    <p class="text-sm text-gray-600 mb-2 font-medium">Keterangan:</p>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <span class="flex items-center">
                            <span class="w-4 h-4 bg-green-500 rounded-full mr-2"></span>
                            Wisata
                        </span>
                        <span class="flex items-center">
                            <span class="w-4 h-4 bg-blue-500 rounded-full mr-2"></span>
                            UMKM
                        </span>
                        <span class="flex items-center">
                            <span class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></span>
                            Fasilitas Umum
                        </span>
                        <span class="flex items-center">
                            <span class="w-4 h-4 bg-red-500 rounded-full mr-2"></span>
                            Kantor Desa
                        </span>
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                        Lokasi Desa
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Desa Tanalum terletak di Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan
                        Timur.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">
                        <i class="fas fa-ruler-combined text-green-500 mr-2"></i>
                        Luas Wilayah
                    </h3>
                    <p class="text-3xl font-bold text-green-600">{{ number_format($luasDesa ?? 3880000) }} m²</p>
                    <p class="text-gray-500 text-sm mt-1">atau {{ number_format(($luasDesa ?? 3880000) / 10000, 2) }} Ha</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">
                        <i class="fas fa-users text-blue-500 mr-2"></i>
                        Jumlah Penduduk
                    </h3>
                    <p class="text-3xl font-bold text-blue-600">{{ number_format($jumlahPenduduk ?? 1162) }}</p>
                    <p class="text-gray-500 text-sm mt-1">Jiwa</p>
                </div>
            </div>

            <!-- Batas Desa -->
            <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                <h3 class="font-semibold text-gray-800 mb-4">
                    <i class="fas fa-border-all text-green-600 mr-2"></i>
                    Batas Wilayah Desa
                </h3>
                <div class="grid md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Utara</p>
                        <p class="font-medium text-gray-800">{{ $batasUtara ?? 'Desa Santan Ulu dan Desa Santan Ilir' }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Timur</p>
                        <p class="font-medium text-gray-800">{{ $batasTimur ?? 'Selat Makassar' }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Selatan</p>
                        <p class="font-medium text-gray-800">{{ $batasSelatan ?? 'Selat Makassar dan Desa Semangko' }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Barat</p>
                        <p class="font-medium text-gray-800">{{ $batasBarat ?? 'Desa Santan Ulu' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map centered on Desa Tanalum
            const map = L.map('map').setView([{{ $latitude ?? '-0.2' }}, {{ $longitude ?? '117.4' }}], 13);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom icons
            const icons = {
                wisata: L.divIcon({
                    html: '<div class="bg-green-500 w-6 h-6 rounded-full border-2 border-white shadow flex items-center justify-center text-white text-xs">🏖️</div>',
                    className: 'custom-marker',
                    iconSize: [24, 24]
                }),
                umkm: L.divIcon({
                    html: '<div class="bg-blue-500 w-6 h-6 rounded-full border-2 border-white shadow flex items-center justify-center text-white text-xs">🏪</div>',
                    className: 'custom-marker',
                    iconSize: [24, 24]
                }),
                fasilitas: L.divIcon({
                    html: '<div class="bg-yellow-500 w-6 h-6 rounded-full border-2 border-white shadow flex items-center justify-center text-white text-xs">🏛️</div>',
                    className: 'custom-marker',
                    iconSize: [24, 24]
                }),
                kantor: L.divIcon({
                    html: '<div class="bg-red-500 w-6 h-6 rounded-full border-2 border-white shadow flex items-center justify-center text-white text-xs">🏢</div>',
                    className: 'custom-marker',
                    iconSize: [24, 24]
                })
            };

            // Sample markers (replace with actual data)
            const markers = [{
                    lat: -0.2,
                    lng: 117.4,
                    type: 'kantor',
                    name: 'Kantor Desa Tanalum',
                    desc: 'Pusat pemerintahan desa'
                },
                {
                    lat: -0.195,
                    lng: 117.405,
                    type: 'wisata',
                    name: 'Pantai Tanalum',
                    desc: 'Pantai dengan pemandangan indah'
                },
                {
                    lat: -0.205,
                    lng: 117.395,
                    type: 'umkm',
                    name: 'Warung Makan Bu Ani',
                    desc: 'Masakan khas daerah'
                },
                {
                    lat: -0.198,
                    lng: 117.41,
                    type: 'fasilitas',
                    name: 'Masjid Al-Ikhlas',
                    desc: 'Masjid utama desa'
                }
            ];

            const markerLayers = {};

            markers.forEach(m => {
                const marker = L.marker([m.lat, m.lng], {
                        icon: icons[m.type] || icons.fasilitas
                    })
                    .bindPopup(`<strong>${m.name}</strong><br>${m.desc}`);

                if (!markerLayers[m.type]) {
                    markerLayers[m.type] = L.layerGroup();
                }
                markerLayers[m.type].addLayer(marker);
            });

            // Add all layers to map
            Object.values(markerLayers).forEach(layer => layer.addTo(map));

            // Filter functionality
            document.querySelectorAll('.map-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const type = this.dataset.type;
                    if (markerLayers[type]) {
                        if (this.checked) {
                            markerLayers[type].addTo(map);
                        } else {
                            map.removeLayer(markerLayers[type]);
                        }
                    }
                });
            });
        });
    </script>
@endpush
