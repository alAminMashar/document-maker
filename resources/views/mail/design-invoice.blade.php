<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Monthly Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/mail.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bun-mail">
        <div class="header">
            <div class="brand brand-bunisha">
                <img src="{{ asset('assets/images/logo-main.svg') }}" alt="Company logo" class="logo">
            </div>
        </div>
        <div class="message">
            <h2 class="title">
                {{ config('app.name') }}
            </h2>
            <small class="warning">
                {{ $data['reference'] }}
            </small>
            <p>
                Hi {{ $data['contact_person'] }},
            </p>
            <p>
                Find attached below your invoice for the period {{ $data['period'] }}. We thank you for your business.
            </p>
            <p>
                If you are experiencing any challenges, or wish to make inquiries, our team is here for you. <br> Kindly
                Contact us via <a href="tel:{{ config('app.phone') }}"
                    class="thick primary">{{ config('app.phone') }}</a> or <a href="mailto:{{ config('app.email') }}"
                    class="thick primary">{{ config('app.email') }}</a>
            </p>
        </div>
        <div class="footer">

            <p>
                Invoiced to: {{ $data['email'] }} <br>
                Date: {{ $data['date'] }}
            </p>
            <div class="footnote">
                <p>
                    We would love to hear back from you regarding how you like our services. For any feedback, write to
                    us via our official email at <a href="mailto: {{ config('app.email') }}" class="thick night">
                        {{ config('app.email') }}</a> or give us a call on
                    <b>{{ config('app.phone') }}</b>. This is a
                    system generated email, please do not reply.
                </p>
            </div>
            <p>
                {{ config('app.address') }}
                <a href="mailto: {{ config('app.email') }}">
                    {{ config('app.email') }}
                </a>
            </p>
            <p>
                Copyright &copy; {{ date('Y') }}. {{ config('app.name') }}.
                All rights reserved.
            </p>

        </div>
    </div>
    {{-- {{ $message->embed($data['attachment']) }} --}}
</body>

</html>
