<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Monthly Invoice</title>
</head>

<body
    style="position: relative;box-sizing: border-box;width: auto;min-width: 100%;max-width: 100%;height: auto;min-height: auto;margin: 0px;padding: 0px;overflow: hidden;background-color: whitesmoke;overflow-y: auto;">
    <div class="bun-mail"
        style="font-family: Helvetica, sans-serif;box-sizing: border-box;width: auto;min-width: 480px;max-width: 480px;height: auto;min-height: 200px;margin: 3vh auto 0vh;padding: 0px;overflow: hidden;background-color: white;border-radius: 4px;color: #000000;">
        <div class="header"
            style="font-family: Helvetica, sans-serif;box-sizing: border-box;width: auto;min-width: 100%;max-width: 100%;height: auto;min-height: 50px;margin: 0px;padding: 0px;overflow: hidden;background-color: transparent;">
            <div class="brand brand-bunisha"
                style="font-family: Helvetica, sans-serif;padding: 0px;box-sizing: border-box;width: auto;min-width: 100%;max-width: 100%;height: auto;min-height: 55px;max-height: 55px;margin: 0px;overflow: hidden;background-color: #03a9f4;text-align: center;">
                <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="Company logo" class="logo"
                    style="font-family: Helvetica, sans-serif;padding: 0px;box-sizing: border-box;width: auto;min-width: auto;max-width: auto;height: auto;min-height: 27.5px;max-height: 27.5px;margin: 13.75px auto 13.75px;overflow: hidden;">
            </div>
        </div>
        <div class="message"
            style="font-family: Georgia, sans-serif;box-sizing: border-box;width: auto;min-width: 95%;max-width: 95%;height: auto;min-height: 0px;margin: 0vh auto 0vh;padding: 10px 20px 10px;overflow: hidden;">
            <h2 class="title" style="padding: 0px;margin: 0px;text-align: center;">
                {{ config('app.name') }}
            </h2>
            <p class="warning"
                style="font-family: Helvetica, sans-serif;color: #fc823f;text-align: center; text-transform: capitalize;">
                {{ $data['reference'] }}
            </p>
            <p style="font-family: Helvetica, sans-serif;color: #9F9F9F;text-align: left; font-size: 12px;">
                {{ $data['date'] }},
            </p>
            <p style="text-align: left;">
                Hi {{ $data['contact_person'] }},
            </p>
            <p style="text-align: left;">
                Find attached below your invoice for the period {{ $data['period'] }}. We thank you for your business.
            </p>
            <p style="text-align: left;">
                If there are any discrepancies or you wish to make inquiries, our team is here for you. Kindly contact
                us
                through the numbers provided below.
            </p>
        </div>
        <div class="footer"
            style="font-family: Helvetica, sans-serif;font-size: 12px;color: #9F9F9F;text-align: center;">
            <p style="font-family: Helvetica, sans-serif;text-decoration: none;margin: 2vh auto 2vh;">
                Invoiced to {{ $data['customer_name'] }}
            </p>
            <div class="footnote"
                style="font-family: Helvetica, sans-serif;text-decoration: none;box-sizing: border-box;width: auto;min-width: 100%;max-width: 100%;height: auto;min-height: 100px;margin: 1vh auto 1vh;padding: 2vh 25px 2vh;overflow: hidden;background-color: rgba(69, 90, 99, 0.8);color: #ffffff;font-weight: 400;font-size: 12px;text-align: left;">
                <p style="font-family: Helvetica, sans-serif;text-decoration: none;margin: 2vh auto 2vh;">
                    We would love to hear back from you regarding how you like our services. This is a system generated
                    email, please do not reply. For any feedback, write to
                    us via <a href="mailto: {{ config('app.email') }}" class="thick night"
                        style="font-family: Helvetica, sans-serif;color: inherit;font-weight: 700;text-decoration: none;">
                        {{ config('app.email') }}</a> or call on <b
                        style="font-family: Helvetica, sans-serif;text-decoration: none;">{{ config('app.phone') }}
                </p>
            </div>
            <p style="font-family: Helvetica, sans-serif;text-decoration: none;margin: 2vh auto 2vh;">
                Copyright &copy; {{ date('Y') }} {{ config('app.name') }}.
                All rights reserved.
            </p>
            <p style="font-family: Helvetica, sans-serif;text-decoration: none;margin: 2vh auto 2vh;">
                {{ config('app.address') }}
            </p>

        </div>
    </div>
    {{-- {{ $message->embed($data['attachment']) }} --}}
</body>

</html>
