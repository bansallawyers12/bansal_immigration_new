# Postman Collection Setup Instructions

## 📦 What's Included

1. **Bansal_Immigration_CRM_API.postman_collection.json** - Complete API collection with all endpoints
2. **Bansal_CRM_API.postman_environment.json** - Environment variables for easy configuration
3. This setup guide

---

## 🚀 Quick Start (5 Minutes)

### Step 1: Import Collection into Postman

1. Open Postman
2. Click **Import** button (top left)
3. Select **File** tab
4. Choose `Bansal_Immigration_CRM_API.postman_collection.json`
5. Click **Import**

### Step 2: Import Environment

1. Click **Import** again
2. Select `Bansal_CRM_API.postman_environment.json`
3. Click **Import**

### Step 3: Set Your API Token

1. In top-right corner, select environment dropdown
2. Choose **"Bansal CRM API - Production"**
3. Click the **eye icon** (👁️) next to environment name
4. Click **Edit** next to the environment
5. Find `api_token` variable
6. Replace `YOUR_API_TOKEN_HERE` with your actual token
7. Click **Save**

### Step 4: Test Connection

1. Open the collection folder: **Health Check**
2. Click **Test API Connection**
3. Click **Send**
4. You should see: `200 OK` ✅

**If you see 401 Unauthorized:** Your token is invalid or not set correctly.

---

## 🔑 How to Get Your API Token

On your server, run:

```bash
php artisan crm:generate-token admin@bansalimmigration.com
```

Copy the generated token and paste it into the Postman environment variable.

---

## 📚 Collection Structure

### Folder: Appointments

#### 1. **Get All Appointments (Paginated)**
- **Method:** GET
- **Endpoint:** `/appointments`
- **Use Case:** Fetch all appointments with filters and pagination
- **Parameters:**
  - `per_page` - Results per page (default: 50)
  - `page` - Page number
  - `start_date` - Filter by date range
  - `end_date` - Filter by date range
  - `status` - Filter by status
  - `location` - Filter by location
  - `enquiry_type` - Filter by type
  - `created_after` - For incremental sync
  - `updated_after` - For incremental sync

**Example Use Cases:**

```
Initial Full Sync:
GET /appointments?per_page=100

Incremental Sync:
GET /appointments?updated_after=2024-11-18T10:30:00Z

Filter by Date Range:
GET /appointments?start_date=2024-11-01&end_date=2024-11-30

Filter by Status:
GET /appointments?status=confirmed

Filter by Location:
GET /appointments?location=melbourne
```

---

#### 2. **Get Single Appointment**
- **Method:** GET
- **Endpoint:** `/appointments/{id}`
- **Use Case:** Get detailed information about a specific appointment
- **Path Parameter:**
  - `id` - Appointment ID

**Example:**
```
GET /appointments/1
```

---

#### 3. **Get Recent Appointments (Polling)**
- **Method:** GET
- **Endpoint:** `/appointments/recent`
- **Use Case:** Perfect for polling - get appointments created in last N minutes
- **Parameters:**
  - `minutes` - Lookback period (default: 30, min: 1, max: 1440)

**Example Use Cases:**

```
Poll Every 5 Minutes (with 10-minute buffer):
GET /appointments/recent?minutes=10

Hourly Check:
GET /appointments/recent?minutes=65

Daily Catch-up:
GET /appointments/recent?minutes=1440
```

**Recommended Polling Setup:**
- Run every 5-10 minutes
- Use 15-minute lookback (provides buffer)
- Handle duplicates by checking `id` field

---

#### 4. **Export Appointments as CSV**
- **Method:** GET
- **Endpoint:** `/appointments/export`
- **Use Case:** Download appointments as CSV for bulk import
- **Parameters:** Same filters as "Get All Appointments"
- **Limit:** Maximum 10,000 records per export

**Example:**
```
GET /appointments/export?start_date=2024-01-01&end_date=2024-12-31
```

**CSV Columns:**
- ID, Name, Email, Phone, Location, Meeting Type, Language
- Enquiry Type, Service Type, Appointment Date, Time, Duration
- Status, Is Paid, Amount, Final Amount, Promo Code
- Admin Notes, Created At, Updated At

---

#### 5. **Get Appointment Statistics**
- **Method:** GET
- **Endpoint:** `/appointments/stats`
- **Use Case:** Get aggregated statistics for reporting/dashboards
- **Parameters:**
  - `start_date` - Start date (default: current month start)
  - `end_date` - End date (default: current month end)

**Statistics Included:**
- Total appointments
- Count by status (pending, confirmed, completed, cancelled)
- Paid appointments count
- Total revenue
- Breakdown by enquiry type (tr, tourist, education, pr_complex)
- Breakdown by location (melbourne, adelaide)

**Example Use Cases:**

```
Current Month Stats:
GET /appointments/stats

Custom Date Range:
GET /appointments/stats?start_date=2024-01-01&end_date=2024-12-31

Last 7 Days:
GET /appointments/stats?start_date=2024-11-11&end_date=2024-11-18
```

---

### Folder: Health Check

#### **Test API Connection**
- Quick test to verify your setup is correct
- Returns 200 OK if everything is working
- Use this first when setting up

---

## 🎯 Response Format

### Success Response Structure

```json
{
  "success": true,
  "data": [...],
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

### Appointment Object Structure

```json
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
  "enquiry_details": "Need help with TSS visa application...",
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
  "admin_notes": "Client has all documents ready",
  "client_notes": null,
  "confirmed_at": "2024-11-10T14:35:00.000000Z",
  "cancelled_at": null,
  "cancellation_reason": null,
  "created_at": "2024-11-10T14:25:00.000000Z",
  "updated_at": "2024-11-10T14:35:00.000000Z"
}
```

---

## 🛡️ Authentication

All requests use **Bearer Token** authentication automatically.

The token is set at collection level, so you only need to configure it once in the environment.

**Header format:**
```
Authorization: Bearer YOUR_API_TOKEN
```

---

## ⚠️ Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```
**Solution:** Check your API token is correct and set in environment.

---

### 404 Not Found
```json
{
  "success": false,
  "message": "Appointment not found"
}
```
**Solution:** The appointment ID doesn't exist.

---

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
**Solution:** Fix the validation errors in your request parameters.

---

### 429 Too Many Requests
```json
{
  "message": "Too Many Attempts."
}
```
**Solution:** You've exceeded the rate limit (60 requests per minute). Wait before retrying.

---

## 📊 Rate Limiting

- **Limit:** 60 requests per minute per token
- **Response:** HTTP 429 when exceeded
- **Header:** `Retry-After` tells you how long to wait

**Best Practices:**
- Don't exceed 50 requests per minute
- Implement exponential backoff
- Use recent appointments endpoint for polling (more efficient)

---

## 🔄 Common Integration Patterns

### Pattern 1: Initial Full Sync

```
1. GET /appointments?per_page=100&page=1
2. GET /appointments?per_page=100&page=2
3. Continue until all pages fetched
```

### Pattern 2: Polling for New Appointments

```
Every 10 minutes:
1. GET /appointments/recent?minutes=15
2. Process new appointments
3. Store in CRM database
```

### Pattern 3: Incremental Sync

```
1. Store last sync timestamp
2. GET /appointments?updated_after=LAST_SYNC_TIME
3. Process updated appointments
4. Update sync timestamp
```

### Pattern 4: Daily Reconciliation

```
Once per day:
1. GET /appointments?start_date=TODAY&end_date=TODAY
2. Compare with CRM database
3. Fix any discrepancies
```

---

## 🧪 Testing Scenarios

### Test 1: Verify Authentication
```
Request: Health Check > Test API Connection
Expected: 200 OK
```

### Test 2: Get Recent Data
```
Request: Get Recent Appointments (minutes=1440)
Expected: List of appointments from last 24 hours
```

### Test 3: Test Pagination
```
Request: Get All Appointments (per_page=10)
Expected: 10 results with pagination info
```

### Test 4: Test Filters
```
Request: Get All Appointments (status=confirmed)
Expected: Only confirmed appointments
```

### Test 5: Get Statistics
```
Request: Get Appointment Statistics
Expected: Aggregated stats for current month
```

### Test 6: Test Error Handling
```
Request: Get Single Appointment (id=999999)
Expected: 404 Not Found
```

---

## 💡 Pro Tips

### Tip 1: Use Collection Variables
Save commonly used values as collection variables:
- Appointment IDs for testing
- Date ranges
- Common filter values

### Tip 2: Use Pre-request Scripts
Add custom logic before requests:
```javascript
// Set today's date automatically
pm.environment.set("today", new Date().toISOString().split('T')[0]);
```

### Tip 3: Use Test Scripts
Automatically validate responses:
```javascript
pm.test("Status is 200", function () {
    pm.response.to.have.status(200);
});

pm.test("Has success field", function () {
    const jsonData = pm.response.json();
    pm.expect(jsonData.success).to.be.true;
});
```

### Tip 4: Save Example Responses
Click **Save Response** after each request to document actual API behavior.

### Tip 5: Use Collection Runner
Run multiple requests in sequence:
1. Click on collection name
2. Click **Run**
3. Select which requests to run
4. Click **Run Collection**

---

## 🌍 Multiple Environments

You can create additional environments for different setups:

### Development Environment
```json
{
  "base_url": "http://localhost/api/crm",
  "api_token": "DEV_TOKEN_HERE"
}
```

### Staging Environment
```json
{
  "base_url": "https://staging.bansalimmigration.com/api/crm",
  "api_token": "STAGING_TOKEN_HERE"
}
```

### Production Environment
```json
{
  "base_url": "https://bansalimmigration.com/api/crm",
  "api_token": "PRODUCTION_TOKEN_HERE"
}
```

Switch between environments using the dropdown in top-right corner.

---

## 📖 Additional Resources

- **Integration Guide:** `CRM_INTEGRATION_GUIDE.md` - Complete implementation guide
- **API Documentation:** Detailed documentation with code examples
- **Support:** support@bansalimmigration.com

---

## 🎓 Learning Path

**For Beginners:**
1. Import collection and environment
2. Set API token
3. Run "Test API Connection"
4. Try "Get Recent Appointments"
5. Explore other endpoints

**For Developers:**
1. Review all request examples
2. Study response structures
3. Test error scenarios
4. Implement in your CRM
5. Set up automated sync

**For Advanced Users:**
1. Use Collection Runner for automation
2. Write custom test scripts
3. Set up monitoring with Newman (Postman CLI)
4. Integrate with CI/CD pipeline

---

## 🔧 Troubleshooting

### Issue: All requests return 401
**Solution:** API token is not set or invalid. Check environment variables.

### Issue: Can't see environment variables
**Solution:** Make sure you've selected the environment in the dropdown (top-right).

### Issue: Collection not loading properly
**Solution:** Make sure you're using Postman version 10.0 or higher.

### Issue: Rate limit errors
**Solution:** Reduce request frequency. Wait 60 seconds before retrying.

### Issue: Timeout errors
**Solution:** Check your internet connection. Try increasing timeout in Postman settings.

---

## 📞 Support

**Need Help?**
- Email: support@bansalimmigration.com
- Documentation: `CRM_INTEGRATION_GUIDE.md`
- Technical Issues: Check server logs and sync error tables

---

**Version:** 1.0  
**Last Updated:** October 18, 2024  
**Maintained By:** Bansal Immigration Development Team

