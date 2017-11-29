@component('mail::message')
# {{ LaravelLocalization::getCurrentLocale() == 'id' ? 'Aktifkan akun anda.':'Activate your account.' }}

@if (LaravelLocalization::getCurrentLocale() == 'id')
    Terima kasih untuk bergabung dengan kami, silakan aktifkan akun anda segera
@else
    Thanks for signing up, please activate your account.
@endif

@component('mail::button', ['url' => config('app.url') . '/activate/' . $token ])
    @if (LaravelLocalization::getCurrentLocale() == 'id')
        Aktifkan
    @else
        Activate
    @endif
@endcomponent

<br>

@if (LaravelLocalization::getCurrentLocale() == 'id')
    Atau Klik Link : {{ config('app.url') }}/activate/{{ $token }}
@else
    Or Click This Link : {{ config('app.url') }}/activate/{{ $token }}
@endif

{{ LaravelLocalization::getCurrentLocale() == 'id' ? 'Terima Kasih,':'Thanks,'}}<br>
{{ config('app.name') }}
@endcomponent
