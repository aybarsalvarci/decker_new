<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Free Sample Request</title>
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

        .info-table td {
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
            font-size: 15px;
        }

        .info-table td strong {
            color: #1a252f;
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

    {{-- Email preview text --}}
    <div style="display: none; max-height: 0px; overflow: hidden; font-size: 1px; color: #f4f7f9;">
        You have received a new free sample request from {{ $sample->full_name ?? 'a user' }}.
    </div>

    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 15px;">
        <tr>
            <td style="font-size: 11px; color: #a0aec0; text-align: center; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                SYSTEM NOTIFICATION
            </td>
        </tr>
    </table>

    <table class="content-table" width="600" cellpadding="0" cellspacing="0" border="0"
           style="background-color: #ffffff;">
        {{-- Header / Logo --}}
        <tr>
            <td align="center" style="background-color: #1a252f; padding: 40px 20px;">
                <a href="{{ url('/') }}" target="_blank" style="text-decoration: none;">
                    @if(!is_null(config('settings.footer_logo')) && file_exists(public_path('storage/' . config('settings.footer_logo'))))
                        <img src="{{ asset('storage/' . config('settings.footer_logo')) }}"
                             alt="DECK-ER"
                             style="display: block; width: 180px; max-width: 100%; border: 0; outline: none; text-decoration: none;">
                    @else
                    <span style="font-family: 'Inter', sans-serif; font-size: 32px; font-weight: 800; color: #ffffff; letter-spacing: -1.5px;">
                            DECK-<span style="color: #e63946;">ER</span>
                        </span>
                    @endif
                </a>
                <div style="width: 30px; height: 3px; background-color: #e63946; margin-top: 8px; border-radius: 2px;"></div>
            </td>
        </tr>

        {{-- Main Content --}}
        <tr>
            <td class="mobile-padding" style="padding: 40px 45px; background-color: #ffffff;">
                <h2 style="margin: 0 0 20px 0; color: #1a252f; font-size: 22px; font-weight: 700; line-height: 1.2; letter-spacing: -0.5px;">
                    New Sample Request!
                </h2>

                <p style="color: #718096; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                    A new free sample request has been submitted. Please review the customer and sample details below:
                </p>

                {{-- User & Shipping Info Table --}}
                <table class="info-table" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px;">
                    <tr>
                        <td width="30%"><strong>Request ID:</strong></td>
                        <td>#{{ $sample->id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Full Name:</strong></td>
                        <td>{{ $sample->full_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Address:</strong></td>
                        <td><a href="mailto:{{ $sample->email ?? '' }}" style="color: #e63946; text-decoration: none;">{{ $sample->email ?? '-' }}</a></td>
                    </tr>
                    <tr>
                        <td><strong>Phone Number:</strong></td>
                        <td>{{ $sample->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Location:</strong></td>
                        <td>{{ $sample->state ?? '-' }}, {{ $sample->town ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: none; padding-bottom: 5px;"><strong>Full Address:</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: none; padding-top: 0; padding-bottom: 15px;">
                            <div style="background-color: #f8fafc; padding: 12px; border-left: 4px solid #1a252f; border-radius: 4px; color: #4a5568; font-size: 14px; line-height: 1.6; white-space: pre-line;">
                                {{ $sample->address ?? '-' }}
                            </div>
                        </td>
                    </tr>
                </table>

                {{-- Requested Box Details --}}
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 30px;">
                    <tr>
                        <td style="padding-top: 10px; border-top: 2px dashed #edf2f7; padding-bottom: 15px;">
                            <strong style="font-size: 16px; color: #1a252f;">Requested Sample Box</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="15" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
                                <tr>
                                    @if(isset($sample->box->image))
                                    <td width="90" valign="top" style="padding-right: 0;">
                                        <img src="{{ asset('storage/' . $sample->box->image) }}" alt="Box Image" style="display: block; width: 90px; height: auto; border-radius: 4px; border: 1px solid #cbd5e0;">
                                    </td>
                                    @endif
                                    <td valign="top">
                                        <h4 style="margin: 0 0 5px 0; color: #1a252f; font-size: 16px;">
                                            {{ $sample->box->title_en ?? 'Unknown Box Title' }}
                                        </h4>
                                        <p style="margin: 0 0 10px 0; color: #718096; font-size: 13px; line-height: 1.5;">
                                            {{ Str::limit(strip_tags($sample->box->description_en ?? ''), 120) }}
                                        </p>
                                        <span style="background-color: #1a252f; color: #ffffff; font-size: 11px; padding: 3px 8px; border-radius: 4px; font-weight: 700;">
                                            BOX ID: #{{ $sample->box_id ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                {{-- Action Button --}}
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">
                            <a href="mailto:{{ $sample->email ?? '' }}"
                               style="background-color: #e63946; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 15px; display: inline-block;">
                                CONTACT CUSTOMER
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

        {{-- Footer Info --}}
        <tr>
            <td class="mobile-padding" style="padding: 25px 45px; background-color: #ffffff; text-align: center;">
                <p style="margin: 0; color: #a0aec0; font-size: 13px; line-height: 1.6;">
                    This email is an automatically generated system notification.<br>
                    Please arrange the shipment according to the provided address details.
                </p>
            </td>
        </tr>
    </table>

    {{-- Bottom Copyright --}}
    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin-top: 20px;">
        <tr>
            <td style="font-size: 12px; color: #a0aec0; text-align: center; line-height: 1.6;">
                &copy; {{ date('Y') }} <strong>DECK-ER</strong>. All rights reserved.<br>
                {{config('settings.footer_address')}}
            </td>
        </tr>
    </table>

</center>
</body>
</html>
