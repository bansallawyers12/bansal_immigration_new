# CRM API Integration Setup Guide

## Quick Start Guide

### Step 1: Generate API Token

Run the following command to generate an API token for your CRM:

```bash
php artisan crm:generate-token admin@example.com
```

You'll be prompted to enter a token name. The command will output your API token.

**⚠️ IMPORTANT:** Save this token securely! You won't be able to see it again.

---

### Step 2: Test the API

Test that your token works:

```bash
curl -X GET "http://localhost/api/crm/appointments" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

---

### Step 3: Integrate with Your CRM

Choose your integration method:

#### Option A: Direct API Integration

Use the API endpoints directly from your CRM platform. Most modern CRMs support REST API integrations.

**Popular CRMs with API Integration:**
- **Salesforce** - Use Salesforce Apex or Flow to call REST APIs
- **HubSpot** - Use HubSpot Workflows and Custom Actions
- **Zoho CRM** - Use Zoho Flow or Deluge Scripts
- **Microsoft Dynamics** - Use Power Automate (Flow)
- **Pipedrive** - Use Zapier or custom API integration

#### Option B: Scheduled Polling (Recommended)

Set up a cron job to poll for new appointments every 5-10 minutes:

```bash
# Add to your crontab
*/5 * * * * curl -X GET "http://yourdomain.com/api/crm/appointments/recent?minutes=10" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json" \
  | your-crm-import-script.sh
```

#### Option C: CSV Export (Manual)

Download appointments as CSV for manual import:

```bash
curl -X GET "http://yourdomain.com/api/crm/appointments/export?start_date=2024-01-01&end_date=2024-12-31" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -o appointments.csv
```

Then import the CSV file into your CRM system.

---

## Integration Examples

### Example 1: Python Script for CRM Sync

```python
import requests
import json
from datetime import datetime, timedelta

# Configuration
API_BASE_URL = "https://yourdomain.com/api/crm"
API_TOKEN = "your-api-token-here"
HEADERS = {
    "Authorization": f"Bearer {API_TOKEN}",
    "Accept": "application/json"
}

def get_recent_appointments(minutes=30):
    """Fetch appointments from the last N minutes"""
    url = f"{API_BASE_URL}/appointments/recent?minutes={minutes}"
    response = requests.get(url, headers=HEADERS)
    
    if response.status_code == 200:
        data = response.json()
        return data.get('data', [])
    else:
        print(f"Error: {response.status_code}")
        return []

def sync_to_crm(appointments):
    """Sync appointments to your CRM"""
    for apt in appointments:
        # Your CRM sync logic here
        print(f"Syncing appointment: {apt['full_name']} - {apt['email']}")
        # Example: create_crm_contact(apt)
        # Example: create_crm_opportunity(apt)

if __name__ == "__main__":
    appointments = get_recent_appointments(minutes=60)
    print(f"Found {len(appointments)} new appointments")
    sync_to_crm(appointments)
```

### Example 2: Zapier Integration

1. Create a new Zap in Zapier
2. **Trigger:** Schedule (every 5 minutes)
3. **Action:** Webhooks by Zapier
   - Method: GET
   - URL: `https://yourdomain.com/api/crm/appointments/recent?minutes=10`
   - Headers:
     - Authorization: `Bearer YOUR_TOKEN`
     - Accept: `application/json`
4. **Action:** Create/Update records in your CRM
5. Map the fields from the API response to your CRM fields

### Example 3: Node.js Script

```javascript
const axios = require('axios');

const API_BASE_URL = 'https://yourdomain.com/api/crm';
const API_TOKEN = 'your-api-token-here';

const headers = {
  'Authorization': `Bearer ${API_TOKEN}`,
  'Accept': 'application/json'
};

async function getRecentAppointments(minutes = 30) {
  try {
    const response = await axios.get(
      `${API_BASE_URL}/appointments/recent?minutes=${minutes}`,
      { headers }
    );
    return response.data.data;
  } catch (error) {
    console.error('Error fetching appointments:', error.message);
    return [];
  }
}

async function syncToCRM(appointments) {
  for (const apt of appointments) {
    console.log(`Syncing: ${apt.full_name} - ${apt.email}`);
    // Your CRM sync logic here
  }
}

async function main() {
  const appointments = await getRecentAppointments(60);
  console.log(`Found ${appointments.length} new appointments`);
  await syncToCRM(appointments);
}

main();
```

---

## Field Mapping Guide

### Common CRM Field Mappings

| API Field | Salesforce | HubSpot | Zoho | Description |
|-----------|------------|---------|------|-------------|
| `full_name` | `Name` | `Full Name` | `Full Name` | Client name |
| `email` | `Email` | `Email` | `Email` | Client email |
| `phone` | `Phone` | `Phone` | `Phone` | Client phone |
| `enquiry_type` | `Lead Source` | `Lead Source` | `Lead Source` | Type of enquiry |
| `appointment_datetime` | `Event Date` | `Meeting Date` | `Event Time` | Appointment time |
| `status` | `Stage` | `Deal Stage` | `Stage` | Current status |
| `enquiry_details` | `Description` | `Notes` | `Description` | Client notes |
| `location` | `Location` | `Office Location` | `Location` | Office location |
| `is_paid` | `Paid__c` | `Is Paid` | `Payment Status` | Payment status |
| `final_amount` | `Amount` | `Deal Amount` | `Amount` | Transaction amount |

---

## Webhook Setup (Advanced)

For real-time integration, you can set up webhooks in your CRM system:

### 1. Create Webhook Endpoint in Your CRM

Your CRM should provide a webhook URL that accepts POST requests.

### 2. Create Laravel Event Listener

We can trigger webhooks when appointments are created/updated:

```php
// Add to app/Observers/AppointmentObserver.php
public function created(Appointment $appointment)
{
    // Send webhook to CRM
    Http::post('https://your-crm-webhook-url.com', [
        'event' => 'appointment.created',
        'data' => $appointment->toArray()
    ]);
}
```

---

## Security Best Practices

1. **Store API tokens securely**
   - Never commit tokens to version control
   - Use environment variables or secure vaults
   - Rotate tokens periodically

2. **Use HTTPS only**
   - Ensure your domain has SSL certificate
   - Never use HTTP for API calls

3. **Monitor API usage**
   - Track API calls in your logs
   - Set up alerts for unusual activity

4. **Restrict token permissions**
   - Use separate tokens for different systems
   - Revoke unused tokens

---

## Troubleshooting

### Error: 401 Unauthorized
- Check that your token is correct
- Verify the token hasn't expired or been revoked
- Ensure you're using the correct Authorization header format

### Error: 429 Too Many Requests
- You're exceeding the rate limit (60 requests/minute)
- Implement exponential backoff in your polling script
- Consider batching requests or increasing polling interval

### Error: 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Verify database connection
- Contact support if issue persists

---

## Support

For integration support:
- **Email:** support@bansalimmigration.com
- **Documentation:** See `CRM_API_DOCUMENTATION.md`
- **API Status:** Check server logs at `storage/logs/laravel.log`

---

## Useful Commands

```bash
# Generate new API token
php artisan crm:generate-token admin@example.com

# View all tokens for a user (via Laravel Tinker)
php artisan tinker
>>> User::where('email', 'admin@example.com')->first()->tokens

# Revoke a token (via Laravel Tinker)
php artisan tinker
>>> User::where('email', 'admin@example.com')->first()->tokens()->delete()

# Test API endpoint
curl -X GET "http://localhost/api/crm/appointments/stats" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

---

## Next Steps

1. ✅ Generate your API token
2. ✅ Test the API endpoints
3. ✅ Choose your integration method
4. ✅ Map API fields to your CRM fields
5. ✅ Set up polling or webhooks
6. ✅ Monitor and test the integration

Good luck with your CRM integration!

