<x-mail::message>
#   Web-based Record Management System of Sangguniang Kabataan of Sta. Magdalena, Sorsogon

Welcome!, you may now login with your credentials

Your Email is: {{ $user->email}}<br>
Your Password is: {{ $user->default_password }}
{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
