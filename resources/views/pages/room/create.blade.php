@extends('layouts.default')

@section('content')
    @php
        $module = 'Kamar';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Tambah Tipe Kamar
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.room.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Kamar',
                            'value' => '',
                            'placeholder' => 'Kamar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.image', [
                            'class_group' => 'mb-3',
                            'field_name' => 'images[]',
                            'label' => 'Gambar',
                            'value' => '',
                            'placeholder' => 'Gambar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'multiple' => true
                        ])

                        @php
                            $roomType = \App\Models\RoomType::get();
                            $asrama = \App\Models\Asramas::get();
                            $fasilitas = \App\Models\Fasilitas::get();
                        @endphp
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'asrama_id',
                            'label' => 'Asrama',
                            'value' => old('asrama_id', null),
                            'placeholder' => 'asrama',
                            'options' => $asrama,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'room_type_id',
                            'label' => 'Room Tipe',
                            'value' => old('room_type_id', null),
                            'placeholder' => 'Room Tipe',
                            'options' => $roomType,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.tag', [
                            'class_group' => 'mb-3',
                            'field_name' => 'fasilitas',
                            'label' => 'Fasilitas',
                            'value' => old('fasilitas', null),
                            'placeholder' => 'Fasilitas',
                            'options' => $fasilitas,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.room.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection