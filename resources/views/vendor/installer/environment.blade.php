@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.menu.title') !!}
@endsection

@section('container')

    <p class="text-center">
        {!! trans('installer_messages.environment.menu.desc') !!}
    </p>
    <div class="buttons">
        <a target="_self" href="{{ route('LaravelInstaller::environmentWizard') }}" class="button button-wizard">
            <i class="fa fa-sliders fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.menu.wizard-button') }}
        </a>
        <a target="_self" href="{{ route('LaravelInstaller::environmentClassic') }}" class="button button-classic d-none" style="display: none">
            <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.menu.classic-button') }}
        </a>
    </div>

@endsection
