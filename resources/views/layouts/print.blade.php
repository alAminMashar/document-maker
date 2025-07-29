<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document Print</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('livewire.shared.print-styles')
</head>

<body class="w-90 ml-5">
    @include('livewire.shared.letterhead-top')
    @yield('content')
    @include('livewire.shared.normal-stamp')
</body>

</html>
