# 🚀 CRM API - Quick Start Guide

## Step 1: Generate Token (2 minutes)

```bash
php artisan crm:generate-token admin@example.com
```

**Save the token!** You'll need it for all API calls.

---

## Step 2: Test It Works (1 minute)

Replace `YOUR_TOKEN` with the token from Step 1:

```bash
curl -X GET "http://localhost/api/crm/appointments?per_page=5" ^
  -H "Authorization: Bearer YOUR_TOKEN" ^
  -H "Accept: application/json"
```

✅ If you see JSON data with appointments, it's working!

---

## Step 3: Choose Your Integration

### Option A: Get Recent Appointments (For Polling)

Perfect for automated sync every 5-10 minutes:

```bash
curl -X GET "http://localhost/api/crm/appointments/recent?minutes=30" ^
  -H "Authorization: Bearer YOUR_TOKEN" ^
  -H "Accept: application/json"
```

### Option B: Export as CSV

Download all appointments as CSV file:

```bash
curl -X GET "http://localhost/api/crm/appointments/export" ^
  -H "Authorization: Bearer YOUR_TOKEN" ^
  -o appointments.csv
```

### Option C: Get Filtered Appointments

Get appointments with specific filters:

```bash
curl -X GET "http://localhost/api/crm/appointments?start_date=2024-01-01&end_date=2024-12-31&status=confirmed" ^
  -H "Authorization: Bearer YOUR_TOKEN" ^
  -H "Accept: application/json"
```

---

## All Available Endpoints

| URL | What It Does |
|-----|--------------|
| `GET /api/crm/appointments` | List all (with filters) |
| `GET /api/crm/appointments/{id}` | Get one by ID |
| `GET /api/crm/appointments/export` | Download CSV |
| `GET /api/crm/appointments/recent` | Get recent ones |
| `GET /api/crm/appointments/stats` | Get statistics |

---

## Common Filters

Add these to any endpoint URL:

- `?start_date=2024-01-01` - From date
- `?end_date=2024-12-31` - To date
- `?status=confirmed` - By status (pending, confirmed, completed, cancelled)
- `?location=melbourne` - By location (melbourne, adelaide)
- `?enquiry_type=tr` - By type (tr, tourist, education, pr_complex)
- `?per_page=50` - Results per page
- `?created_after=2024-11-18T10:00:00Z` - Created after timestamp
- `?updated_after=2024-11-18T10:00:00Z` - Updated after timestamp

**Combine filters with `&`:**
```
/api/crm/appointments?status=confirmed&location=melbourne&per_page=100
```

---

## Quick Examples

### Get Today's Appointments
```bash
curl -X GET "http://localhost/api/crm/appointments?start_date=2024-10-18&end_date=2024-10-18" ^
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Get Statistics for This Month
```bash
curl -X GET "http://localhost/api/crm/appointments/stats" ^
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Get All Confirmed Melbourne Appointments
```bash
curl -X GET "http://localhost/api/crm/appointments?status=confirmed&location=melbourne" ^
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## Need More Help?

📖 **Full Documentation:** See `CRM_API_DOCUMENTATION.md`  
🛠️ **Setup Guide:** See `CRM_API_SETUP.md`  
📋 **Summary:** See `CRM_INTEGRATION_SUMMARY.md`

---

## Troubleshooting

**401 Error?** → Check your token is correct  
**Empty results?** → Remove filters and try again  
**429 Error?** → Wait a minute (rate limit exceeded)

---

That's it! You're ready to integrate with your CRM! 🎉

