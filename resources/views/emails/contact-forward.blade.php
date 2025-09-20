<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forwarded Contact Inquiry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #3b82f6;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            background: #f8fafc;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e2e8f0;
        }
        .contact-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #374151;
            display: inline-block;
            width: 120px;
        }
        .value {
            color: #6b7280;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-unread { background: #fee2e2; color: #dc2626; }
        .status-read { background: #fef3c7; color: #d97706; }
        .status-resolved { background: #d1fae5; color: #059669; }
        .status-archived { background: #f3f4f6; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📧 Forwarded Contact Inquiry</h1>
        <p>Contact information has been forwarded to you</p>
    </div>

    <div class="content">
        <p>Hello,</p>
        
        <p>A contact inquiry from the Bansal Immigration Consultants website has been forwarded to you:</p>

        <div class="contact-info">
            <h3 style="margin-top: 0; color: #1f2937;">Contact Details</h3>
            
            <div class="field">
                <span class="label">Name:</span>
                <span class="value">{{ $contact->name }}</span>
            </div>
            
            <div class="field">
                <span class="label">Email:</span>
                <span class="value">{{ $contact->contact_email }}</span>
            </div>
            
            @if($contact->contact_phone)
            <div class="field">
                <span class="label">Phone:</span>
                <span class="value">{{ $contact->contact_phone }}</span>
            </div>
            @endif
            
            <div class="field">
                <span class="label">Subject:</span>
                <span class="value">{{ $contact->subject }}</span>
            </div>
            
            <div class="field">
                <span class="label">Status:</span>
                <span class="status-badge status-{{ $contact->status }}">
                    {{ ucfirst($contact->status) }}
                </span>
            </div>
            
            <div class="field">
                <span class="label">Submitted:</span>
                <span class="value">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</span>
            </div>

            @if($contact->form_source)
            <div class="field">
                <span class="label">Source:</span>
                <span class="value">{{ $contact->form_source }}</span>
            </div>
            @endif
        </div>

        <div class="message-box">
            <h4 style="margin-top: 0; color: #1f2937;">Message:</h4>
            <p style="white-space: pre-wrap; margin: 0;">{{ $contact->message }}</p>
        </div>

        <div style="background: #eff6ff; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #3b82f6;">
            <h4 style="margin-top: 0; color: #1e40af;">📋 Next Steps</h4>
            <ul style="margin: 10px 0; padding-left: 20px; color: #1e40af;">
                <li>Review the inquiry details above</li>
                <li>Reply directly to the customer at <strong>{{ $contact->contact_email }}</strong></li>
                <li>Update the contact status in the admin panel</li>
                <li>Follow up as needed for your services</li>
            </ul>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="mailto:{{ $contact->contact_email }}?subject=Re: {{ $contact->subject }}&body=Hi {{ $contact->name }},%0D%0A%0D%0AThank you for contacting Bansal Immigration Consultants.%0D%0A%0D%0A" 
               style="background: #3b82f6; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: bold;">
                📧 Reply to Customer
            </a>
        </div>
    </div>

    <div class="footer">
        <p><strong>Bansal Immigration Consultants</strong></p>
        <p>This email was automatically generated from the admin panel.</p>
        <p>Contact ID: #{{ $contact->id }}</p>
        <p>Forwarded to: {{ $recipientEmail }}</p>
    </div>
</body>
</html>
