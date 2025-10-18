# CRM Integration API Documentation

## Overview
This API allows your CRM system to retrieve appointment data from the Bansal Immigration system. All endpoints are protected by Laravel Sanctum authentication.

## Base URL
```
https://yourdomain.com/api/crm
```

## Authentication
All CRM API endpoints require authentication using Laravel Sanctum tokens.

### Generate API Token
1. Log in as an admin user
2. Go to your admin profile settings
3. Generate a new API token
4. Include the token in all API requests:

```bash
Authorization: Bearer YOUR_API_TOKEN
```

---

## Endpoints

### 1. Get All Appointments
Retrieve a paginated list of appointments with optional filters.

**Endpoint:** `GET /api/crm/appointments`

**Query Parameters:**
- `start_date` (optional) - Filter by start date (Y-m-d format)
- `end_date` (optional) - Filter by end date (Y-m-d format)
- `status` (optional) - Filter by status: pending, confirmed, in_progress, completed, cancelled, no_show
- `location` (optional) - Filter by location: melbourne, adelaide
- `enquiry_type` (optional) - Filter by enquiry type: tr, tourist, education, pr_complex
- `created_after` (optional) - Get appointments created after this datetime (for incremental sync)
- `updated_after` (optional) - Get appointments updated after this datetime (for incremental sync)
- `per_page` (optional) - Number of results per page (default: 50)

**Example Request:**
```bash
curl -X GET "https://yourdomain.com/api/crm/appointments?start_date=2024-01-01&end_date=2024-12-31&status=confirmed&per_page=100" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "full_name": "John Doe",
      "email": "john@example.com",
      "phone": "+61 412 345 678",
      "location": "melbourne",
      "meeting_type": "in-person",
      "preferred_language": "English",
      "enquiry_type": "tr",
      "enquiry_type_display": "TR (TRand JRP)",
      "service_type": "temporary-residency",
      "specific_service": "Subclass 482 TSS Visa",
      "enquiry_details": "I need help with my temporary skilled visa application...",
      "appointment_date": "2024-11-15",
      "appointment_time": "10:00",
      "appointment_datetime": "2024-11-15T10:00:00.000000Z",
      "duration_minutes": 30,
      "status": "confirmed",
      "status_display": "Confirmed",
      "is_paid": true,
      "amount": "150.00",
      "discount_amount": "0.00",
      "final_amount": "150.00",
      "promo_code": null,
      "assigned_admin": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@bansalimmigration.com"
      },
      "payment": {
        "id": 1,
        "status": "completed",
        "amount": "150.00",
        "payment_method": "stripe",
        "paid_at": "2024-11-10T14:30:00.000000Z"
      },
      "admin_notes": "Client is well prepared with documents",
      "client_notes": null,
      "confirmed_at": "2024-11-10T14:35:00.000000Z",
      "cancelled_at": null,
      "cancellation_reason": null,
      "created_at": "2024-11-10T14:25:00.000000Z",
      "updated_at": "2024-11-10T14:35:00.000000Z"
    }
  ],
  "pagination": {
    "total": 150,
    "per_page": 50,
    "current_page": 1,
    "last_page": 3,
    "from": 1,
    "to": 50
  }
}
```

---

### 2. Get Single Appointment
Retrieve details of a specific appointment by ID.

**Endpoint:** `GET /api/crm/appointments/{id}`

**Example Request:**
```bash
curl -X GET "https://yourdomain.com/api/crm/appointments/1" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "full_name": "John Doe",
    "email": "john@example.com",
    ...
  }
}
```

---

### 3. Export Appointments as CSV
Download appointments as a CSV file for bulk import into your CRM.

**Endpoint:** `GET /api/crm/appointments/export`

**Query Parameters:**
- `start_date` (optional) - Filter by start date
- `end_date` (optional) - Filter by end date
- `status` (optional) - Filter by status
- `location` (optional) - Filter by location
- `enquiry_type` (optional) - Filter by enquiry type

**Example Request:**
```bash
curl -X GET "https://yourdomain.com/api/crm/appointments/export?start_date=2024-01-01&end_date=2024-12-31" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -o appointments.csv
```

**CSV Columns:**
- ID
- Name
- Email
- Phone
- Location
- Meeting Type
- Language
- Enquiry Type
- Service Type
- Appointment Date
- Appointment Time
- Duration
- Status
- Is Paid
- Amount
- Final Amount
- Promo Code
- Admin Notes
- Created At
- Updated At

---

### 4. Get Recent Appointments
Get appointments created in the last N minutes (useful for polling/webhooks).

**Endpoint:** `GET /api/crm/appointments/recent`

**Query Parameters:**
- `minutes` (optional) - Number of minutes to look back (default: 30)

**Example Request:**
```bash
curl -X GET "https://yourdomain.com/api/crm/appointments/recent?minutes=60" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

**Example Response:**
```json
{
  "success": true,
  "count": 5,
  "data": [
    {
      "id": 156,
      "full_name": "Jane Smith",
      "email": "jane@example.com",
      ...
    }
  ]
}
```

---

### 5. Get Appointment Statistics
Get aggregated statistics about appointments for a date range.

**Endpoint:** `GET /api/crm/appointments/stats`

**Query Parameters:**
- `start_date` (optional) - Start date for statistics (default: start of current month)
- `end_date` (optional) - End date for statistics (default: end of current month)

**Example Request:**
```bash
curl -X GET "https://yourdomain.com/api/crm/appointments/stats?start_date=2024-11-01&end_date=2024-11-30" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Accept: application/json"
```

**Example Response:**
```json
{
  "success": true,
  "period": {
    "start_date": "2024-11-01T00:00:00.000000Z",
    "end_date": "2024-11-30T23:59:59.000000Z"
  },
  "stats": {
    "total_appointments": 45,
    "pending": 12,
    "confirmed": 25,
    "completed": 5,
    "cancelled": 3,
    "paid_appointments": 30,
    "total_revenue": "6750.00",
    "by_enquiry_type": {
      "tr": 20,
      "tourist": 10,
      "education": 8,
      "pr_complex": 7
    },
    "by_location": {
      "melbourne": 35,
      "adelaide": 10
    }
  }
}
```

---

## Common Use Cases

### 1. Initial Full Sync
To sync all existing appointments to your CRM:

```bash
# Get all appointments in batches
curl -X GET "https://yourdomain.com/api/crm/appointments?per_page=100" \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

### 2. Incremental Sync (Polling)
To get only new/updated appointments since last sync:

```bash
# Using created_after for new appointments
curl -X GET "https://yourdomain.com/api/crm/appointments?created_after=2024-11-18T10:30:00Z" \
  -H "Authorization: Bearer YOUR_API_TOKEN"

# Using updated_after for changes
curl -X GET "https://yourdomain.com/api/crm/appointments?updated_after=2024-11-18T10:30:00Z" \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

### 3. Real-time Polling (Every 5 minutes)
Set up a cron job to poll for recent appointments:

```bash
# Get appointments from last 10 minutes (with buffer)
curl -X GET "https://yourdomain.com/api/crm/appointments/recent?minutes=10" \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

### 4. Export for Manual Import
Download CSV for manual import into your CRM:

```bash
curl -X GET "https://yourdomain.com/api/crm/appointments/export" \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -o appointments_$(date +%Y%m%d).csv
```

---

## Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Appointment not found"
}
```

### 422 Validation Error
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "start_date": ["The start date field is required when end date is present."]
  }
}
```

---

## Rate Limiting
- API requests are limited to 60 requests per minute per token
- If you exceed this limit, you'll receive a `429 Too Many Requests` response

---

## Support
For API support or issues, contact: support@bansalimmigration.com

---

## Changelog

### Version 1.0 (2024-10-18)
- Initial release
- Added endpoints for listing, exporting, and syncing appointments
- Added statistics endpoint
- Added CSV export functionality

