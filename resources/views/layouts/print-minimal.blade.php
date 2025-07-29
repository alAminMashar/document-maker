<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document Print</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('livewire.shared.print-styles')
</head>

<body>
    {{-- @include('livewire.shared.letterhead-top') --}}
    @yield('content')
</body>

</html>
