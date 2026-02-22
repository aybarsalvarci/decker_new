<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $subject ?? 'Notification' }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            border-spacing: 0;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        .content-table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #edf2f7;
        }

        @media screen and (max-width: 600px) {
            .mobile-padding {
                padding: 30px 20px !important;
            }

            .content-table {
                width: 100% !important;
                margin-top: 0 !important;
                border-radius: 0 !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f9;">
<center style="width: 100%; table-layout: fixed; background-color: #f4f7f9; padding-top: 40px; padding-bottom: 40px;">

    <div style="display: none; max-height: 0px; overflow: hidden; font-size: 1px; color: #f4f7f9;">
        {{ Str::limit(strip_tags($emailContent), 150) }}
    </div>

    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 15px;">
        <tr>
            <td style="font-size: 11px; color: #a0aec0; text-align: center; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                DECK-ER WEEKLY NEWSLETTER
            </td>
        </tr>
    </table>

    <table class="content-table" width="600" cellpadding="0" cellspacing="0" border="0"
           style="background-color: #ffffff;">
        {{-- Header / Logo --}}
        <tr>
            <td align="center" style="background-color: #1a252f; padding: 40px 20px;">
                <a href="{{ url('/') }}" target="_blank" style="text-decoration: none;">
                    @if(isset($settings->logo) && file_exists(public_path('storage/' . $settings->logo)))
                        {{-- Logo görseli varsa --}}
                        <img src="{{ asset('storage/' . $settings->logo) }}"
                             alt="DECK-ER"
                             style="display: block; width: 180px; max-width: 100%; border: 0; outline: none; text-decoration: none;">
                    @else
                        {{-- Logo yoksa eski metin tabanlı logo (Yedek) --}}
                        <span
                            style="font-family: 'Inter', sans-serif; font-size: 32px; font-weight: 800; color: #ffffff; letter-spacing: -1.5px;">
                    DECK-<span style="color: #e63946;">ER</span>
                </span>
                    @endif
                </a>
                <div
                    style="width: 30px; height: 3px; background-color: #e63946; margin-top: 8px; border-radius: 2px;"></div>
            </td>
        </tr>

        {{-- Main Content --}}
        <tr>
            <td class="mobile-padding" style="padding: 50px 45px; background-color: #ffffff;">
                <h2 style="margin: 0 0 25px 0; color: #1a252f; font-size: 26px; font-weight: 700; line-height: 1.2; letter-spacing: -0.5px;">
                    {{ $subject ?? 'Update from DECK-ER' }}
                </h2>

                <div style="color: #4a5568; font-size: 16px; line-height: 1.8; margin-bottom: 35px;">
                    {!! $emailContent !!}
                </div>

                {{-- Action Button --}}
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="{{ url('/') }}"
                               style="background-color: #1a252f; color: #ffffff; padding: 18px 36px; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 15px; display: inline-block;">
                                VISIT OUR WEBSITE
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- Divider --}}
        <tr>
            <td style="padding: 0 45px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="border-top: 1px solid #edf2f7;"></td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- Footer Info & Unsubscribe --}}
        <tr>
            <td class="mobile-padding" style="padding: 35px 45px; background-color: #ffffff; text-align: center;">
                <p style="margin: 0 0 20px 0; color: #718096; font-size: 13px; line-height: 1.6;">
                    You are receiving this email because you subscribed to the DECK-ER newsletter.<br>
                    To unsubscribe, <strong><a href="{{ route('unsubscribe', base64_encode($email)) }}"
                                                               style="color: #e63946; text-decoration: none;">click here</a></strong>.
                </p>

                {{-- Social Icons --}}
                <div style="margin-top: 25px;">
                    @if(isset($settings->instagram))
                        <a href="{{ $settings->instagram }}" style="display: inline-block; margin: 0 12px;"><img
                                src="https://cdn-icons-png.flaticon.com/32/2111/2111463.png" width="24" height="24"
                                alt="IG"></a>
                    @endif
                    @if(isset($settings->twitter))
                        <a href="{{ $settings->twitter }}" style="display: inline-block; margin: 0 12px;"><img
                                src="https://cdn-icons-png.flaticon.com/32/733/733579.png" width="24" height="24"
                                alt="X"></a>
                    @endif
                    @if(isset($settings->facebook))
                        <a href="{{ $settings->facebook }}" style="display: inline-block; margin: 0 12px;"><img
                                src="https://cdn-icons-png.flaticon.com/32/733/733547.png" width="24" height="24"
                                alt="LI"></a>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    {{-- Bottom Copyright --}}
    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-top: 25px;">
        <tr>
            <td style="font-size: 12px; color: #a0aec0; text-align: center; line-height: 1.6;">
                &copy; {{ date('Y') }} <strong>DECK-ER</strong>. All rights reserved.<br>
                {{ $settings->phone_number ?? '' }} | {{ $settings->email ?? '' }}<br>
                İstanbul, Türkiye
            </td>
        </tr>
    </table>

</center>
</body>
</html>
