<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $letter->serial_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    @include('livewire.shared.print-styles')
</head>

<body>
    @include('livewire.shared.letterhead-top')

    <div class="content w-90 ml-5">
        @yield('content')
    </div>

    @include('livewire.shared.letterhead-bottom')
</body>

</html>
