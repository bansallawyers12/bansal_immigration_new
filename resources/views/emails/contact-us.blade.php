<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .content { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-top: 5px; }
        .footer { margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>You have received a new contact form submission from your website.</p>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Name:</div>
                <div class="value">{{ $contact->name }}</div>
            </div>

            <div class="field">
                <div class="label">Email:</div>
                <div class="value">
                    <a href="mailto:{{ $contact->contact_email }}">{{ $contact->contact_email }}</a>
                </div>
            </div>

            @if($contact->contact_phone)
            <div class="field">
                <div class="label">Phone:</div>
                <div class="value">
                    <a href="tel:{{ $contact->contact_phone }}">{{ $contact->contact_phone }}</a>
                </div>
            </div>
            @endif

            <div class="field">
                <div class="label">Subject:</div>
                <div class="value">{{ $contact->subject }}</div>
            </div>

            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{!! nl2br(e($contact->message)) !!}</div>
            </div>

            @if($contact->form_source || $contact->form_variant)
            <div class="field">
                <div class="label">Form Details:</div>
                <div class="value">
                    @if($contact->form_source)
                        Source: {{ $contact->form_source }}
                    @endif
                    @if($contact->form_variant)
                        @if($contact->form_source), @endif
                        Variant: {{ $contact->form_variant }}
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="footer">
            <p><strong>Submission Details:</strong></p>
            <p>
                Date: {{ $contact->created_at->format('F j, Y \a\t g:i A') }}<br>
                IP Address: {{ $contact->ip_address }}<br>
                Contact ID: #{{ $contact->id }}
            </p>
            <p>
                <strong>Next Steps:</strong><br>
                1. Reply to this email to respond directly to the customer<br>
                2. Log into your admin panel to manage this inquiry<br>
                3. Update the contact status once resolved
            </p>
        </div>
    </div>
</body>
</html>
