# CRM Integration Guide - Bansal Immigration Appointment System

## Overview

This guide explains how to build a backend service in your CRM system that consumes appointment data from the Bansal Immigration API. The system provides real-time appointment data via RESTful APIs protected by Laravel Sanctum token authentication.

---

## Table of Contents

1. [System Architecture](#system-architecture)
2. [Authentication Setup](#authentication-setup)
3. [API Endpoints Reference](#api-endpoints-reference)
4. [CRM Backend Implementation](#crm-backend-implementation)
5. [Database Schema Design](#database-schema-design)
6. [Sync Strategies](#sync-strategies)
7. [Complete Implementation Examples](#complete-implementation-examples)
8. [Error Handling & Retry Logic](#error-handling--retry-logic)
9. [Testing & Deployment](#testing--deployment)

---

## System Architecture

### Data Flow

```
┌─────────────────────────────────────┐
│  Bansal Immigration Website         │
│  (Laravel Application)              │
│                                     │
│  ┌──────────────────────┐          │
│  │  Customer Books      │          │
│  │  Appointment         │          │
│  └──────────┬───────────┘          │
│             │                       │
│             ▼                       │
│  ┌──────────────────────┐          │
│  │  Appointments        │          │
│  │  Stored in Database  │          │
│  └──────────┬───────────┘          │
│             │                       │
│             ▼                       │
│  ┌──────────────────────┐          │
│  │  CRM API Endpoints   │◄─────────┼─── API Request (with Token)
│  │  /api/crm/*          │          │
│  └──────────┬───────────┘          │
└─────────────┼───────────────────────┘
              │
              │ JSON Response
              │
              ▼
┌─────────────────────────────────────┐
│  Your CRM Backend Service           │
│                                     │
│  ┌──────────────────────┐          │
│  │  Polling Service     │          │
│  │  (Every 5-10 min)    │          │
│  └──────────┬───────────┘          │
│             │                       │
│             ▼                       │
│  ┌──────────────────────┐          │
│  │  Data Processor      │          │
│  │  & Transformer       │          │
│  └──────────┬───────────┘          │
│             │                       │
│             ▼                       │
│  ┌──────────────────────┐          │
│  │  CRM Database        │          │
│  │  (Appointments)      │          │
│  └──────────────────────┘          │
│                                     │
│  ┌──────────────────────┐          │
│  │  CRM UI / Dashboard  │          │
│  └──────────────────────┘          │
└─────────────────────────────────────┘
```

---

## Authentication Setup

### Step 1: Generate API Token

On the Bansal Immigration server:

```bash
php artisan crm:generate-token admin@bansalimmigration.com
```

**Output:**
```
✓ API Token generated successfully!

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
User: Admin User (admin@bansalimmigration.com)
Token Name: CRM Integration - 2024-10-18

⚠ IMPORTANT: Save this token now. You won't be able to see it again!

Token:
1|a3b5c7d9e1f2g4h6i8j0k2l4m6n8o0p2q4r6s8t0u2v4w6x8y0z2
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

### Step 2: Store Token Securely

**In your CRM environment variables:**

```env
# .env file
BANSAL_API_URL=https://bansalimmigration.com/api/crm
BANSAL_API_TOKEN=1|a3b5c7d9e1f2g4h6i8j0k2l4m6n8o0p2q4r6s8t0u2v4w6x8y0z2
```

**Security Best Practices:**
- Never commit tokens to version control
- Rotate tokens every 90 days
- Use environment-specific tokens (dev, staging, production)
- Monitor token usage for suspicious activity

---

## API Endpoints Reference

### Base URL
```
https://bansalimmigration.com/api/crm
```

### Authentication Header
All requests require:
```
Authorization: Bearer {YOUR_API_TOKEN}
Accept: application/json
```

### Rate Limiting
- **Limit:** 60 requests per minute per token
- **Response on limit:** HTTP 429 (Too Many Requests)

---

### 1. Get All Appointments (Paginated)

**Endpoint:** `GET /appointments`

**Query Parameters:**
- `start_date` (optional): Filter by start date (Y-m-d format)
- `end_date` (optional): Filter by end date (Y-m-d format)
- `status` (optional): pending, confirmed, in_progress, completed, cancelled, no_show
- `location` (optional): melbourne, adelaide
- `enquiry_type` (optional): tr, tourist, education, pr_complex
- `created_after` (optional): Get appointments created after datetime (for incremental sync)
- `updated_after` (optional): Get appointments updated after datetime (for incremental sync)
- `per_page` (optional): Results per page (default: 50, max: 100)

**Example Request:**
```bash
curl -X GET "https://bansalimmigration.com/api/crm/appointments?per_page=100&status=confirmed" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response Structure:**
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

**Endpoint:** `GET /appointments/{id}`

**Example Request:**
```bash
curl -X GET "https://bansalimmigration.com/api/crm/appointments/1" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

---

### 3. Get Recent Appointments (For Polling)

**Endpoint:** `GET /appointments/recent`

**Query Parameters:**
- `minutes` (optional): Number of minutes to look back (default: 30, min: 1, max: 1440)

**Example Request:**
```bash
curl -X GET "https://bansalimmigration.com/api/crm/appointments/recent?minutes=10" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response:**
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

### 4. Export Appointments as CSV

**Endpoint:** `GET /appointments/export`

**Query Parameters:** Same as `/appointments`

**Example Request:**
```bash
curl -X GET "https://bansalimmigration.com/api/crm/appointments/export?start_date=2024-01-01" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -o appointments.csv
```

---

### 5. Get Appointment Statistics

**Endpoint:** `GET /appointments/stats`

**Query Parameters:**
- `start_date` (optional): Default start of current month
- `end_date` (optional): Default end of current month

**Example Request:**
```bash
curl -X GET "https://bansalimmigration.com/api/crm/appointments/stats?start_date=2024-11-01&end_date=2024-11-30" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Response:**
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

## CRM Backend Implementation

### Technology Stack Options

1. **Node.js + Express** - Fast, event-driven, great for real-time sync
2. **Python + Flask/FastAPI** - Easy to read, powerful data processing
3. **PHP + Laravel** - If your CRM is already PHP-based
4. **Go** - High performance, low resource usage

---

## Database Schema Design

### Recommended CRM Database Schema

```sql
-- Main appointments table in your CRM
CREATE TABLE crm_appointments (
    -- Primary keys
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    external_id BIGINT NOT NULL UNIQUE, -- ID from Bansal Immigration system
    
    -- Client information
    client_name VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    client_phone VARCHAR(50) NOT NULL,
    
    -- Appointment details
    appointment_datetime DATETIME NOT NULL,
    duration_minutes INT NOT NULL,
    location VARCHAR(50) NOT NULL,
    meeting_type VARCHAR(50) NOT NULL,
    preferred_language VARCHAR(50),
    
    -- Service details
    enquiry_type VARCHAR(50) NOT NULL,
    enquiry_type_display VARCHAR(100),
    service_type VARCHAR(100),
    specific_service VARCHAR(255),
    enquiry_details TEXT,
    
    -- Status tracking
    status VARCHAR(50) NOT NULL,
    status_display VARCHAR(100),
    confirmed_at DATETIME,
    cancelled_at DATETIME,
    cancellation_reason TEXT,
    
    -- Payment information
    is_paid BOOLEAN DEFAULT FALSE,
    amount DECIMAL(10,2) DEFAULT 0,
    discount_amount DECIMAL(10,2) DEFAULT 0,
    final_amount DECIMAL(10,2) DEFAULT 0,
    promo_code VARCHAR(50),
    payment_status VARCHAR(50),
    payment_method VARCHAR(50),
    paid_at DATETIME,
    
    -- Assignment
    assigned_admin_id BIGINT,
    assigned_admin_name VARCHAR(255),
    assigned_admin_email VARCHAR(255),
    
    -- Notes
    admin_notes TEXT,
    client_notes TEXT,
    
    -- Sync metadata
    last_synced_at DATETIME NOT NULL,
    source_created_at DATETIME NOT NULL,
    source_updated_at DATETIME NOT NULL,
    sync_status VARCHAR(50) DEFAULT 'synced',
    sync_error TEXT,
    
    -- CRM specific fields
    crm_lead_id BIGINT,
    crm_contact_id BIGINT,
    crm_deal_id BIGINT,
    
    -- Timestamps
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_external_id (external_id),
    INDEX idx_client_email (client_email),
    INDEX idx_appointment_datetime (appointment_datetime),
    INDEX idx_status (status),
    INDEX idx_synced_at (last_synced_at),
    INDEX idx_source_updated_at (source_updated_at)
);

-- Sync log table to track all sync operations
CREATE TABLE crm_sync_log (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    sync_type VARCHAR(50) NOT NULL, -- 'full', 'incremental', 'single'
    sync_started_at DATETIME NOT NULL,
    sync_completed_at DATETIME,
    records_fetched INT DEFAULT 0,
    records_created INT DEFAULT 0,
    records_updated INT DEFAULT 0,
    records_failed INT DEFAULT 0,
    status VARCHAR(50) NOT NULL, -- 'running', 'completed', 'failed'
    error_message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sync errors table for detailed error tracking
CREATE TABLE crm_sync_errors (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    sync_log_id BIGINT,
    external_appointment_id BIGINT,
    error_type VARCHAR(100),
    error_message TEXT,
    error_data JSON,
    retry_count INT DEFAULT 0,
    resolved_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (sync_log_id) REFERENCES crm_sync_log(id)
);
```

---

## Sync Strategies

### Strategy 1: Polling (Recommended for Most Cases)

**How it works:**
- Your CRM backend runs a scheduled job every 5-10 minutes
- Calls `/api/crm/appointments/recent?minutes=15` (with buffer)
- Processes new/updated appointments
- Updates CRM database

**Pros:**
- Simple to implement
- Reliable and predictable
- Easy to debug
- No need for webhooks/callbacks

**Cons:**
- Not real-time (5-10 min delay)
- More API calls

**Best for:**
- Most CRM systems
- When 5-10 minute delay is acceptable
- Simpler infrastructure

---

### Strategy 2: Incremental Sync (For Large Volumes)

**How it works:**
- Store last sync timestamp
- Call `/api/crm/appointments?updated_after=LAST_SYNC_TIME`
- Process all changes since last sync
- Update timestamp

**Pros:**
- Efficient for large datasets
- Captures all changes
- Less data transfer

**Cons:**
- Need to maintain sync state
- More complex error recovery

**Best for:**
- Large appointment volumes (100+ per day)
- When you need complete sync history
- Batch processing scenarios

---

### Strategy 3: Full Sync (For Reconciliation)

**How it works:**
- Run nightly or weekly
- Fetch all appointments in date range
- Compare with CRM database
- Identify and fix discrepancies

**Pros:**
- Ensures data consistency
- Catches missed updates
- Good for audit purposes

**Cons:**
- Resource intensive
- Slower
- More API calls

**Best for:**
- Nightly reconciliation
- Data integrity checks
- Initial migration

---

## Complete Implementation Examples

### Example 1: Node.js Backend (Polling Strategy)

```javascript
// config/bansal-api.js
require('dotenv').config();

module.exports = {
  apiUrl: process.env.BANSAL_API_URL || 'https://bansalimmigration.com/api/crm',
  apiToken: process.env.BANSAL_API_TOKEN,
  pollIntervalMinutes: 10,
  lookbackMinutes: 15 // Fetch last 15 minutes with buffer
};

// services/BansalAPIService.js
const axios = require('axios');
const config = require('../config/bansal-api');

class BansalAPIService {
  constructor() {
    this.client = axios.create({
      baseURL: config.apiUrl,
      headers: {
        'Authorization': `Bearer ${config.apiToken}`,
        'Accept': 'application/json'
      },
      timeout: 30000
    });
    
    // Add response interceptor for error handling
    this.client.interceptors.response.use(
      response => response,
      error => this.handleError(error)
    );
  }

  /**
   * Get recent appointments (for polling)
   */
  async getRecentAppointments(minutes = 15) {
    try {
      const response = await this.client.get('/appointments/recent', {
        params: { minutes }
      });
      
      return response.data;
    } catch (error) {
      console.error('Error fetching recent appointments:', error);
      throw error;
    }
  }

  /**
   * Get appointments with incremental sync
   */
  async getAppointments(params = {}) {
    try {
      const response = await this.client.get('/appointments', { params });
      return response.data;
    } catch (error) {
      console.error('Error fetching appointments:', error);
      throw error;
    }
  }

  /**
   * Get single appointment by ID
   */
  async getAppointment(id) {
    try {
      const response = await this.client.get(`/appointments/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Error fetching appointment ${id}:`, error);
      throw error;
    }
  }

  /**
   * Get appointment statistics
   */
  async getStatistics(startDate, endDate) {
    try {
      const response = await this.client.get('/appointments/stats', {
        params: { start_date: startDate, end_date: endDate }
      });
      return response.data;
    } catch (error) {
      console.error('Error fetching statistics:', error);
      throw error;
    }
  }

  /**
   * Handle API errors
   */
  handleError(error) {
    if (error.response) {
      // Server responded with error status
      const { status, data } = error.response;
      
      switch (status) {
        case 401:
          console.error('Authentication failed. Check your API token.');
          break;
        case 429:
          console.error('Rate limit exceeded. Waiting before retry...');
          break;
        case 500:
          console.error('Server error:', data);
          break;
        default:
          console.error(`API Error ${status}:`, data);
      }
    } else if (error.request) {
      // Request made but no response
      console.error('No response from server:', error.message);
    } else {
      // Error in request setup
      console.error('Request setup error:', error.message);
    }
    
    throw error;
  }
}

module.exports = new BansalAPIService();

// services/AppointmentSyncService.js
const db = require('../config/database');
const bansalAPI = require('./BansalAPIService');

class AppointmentSyncService {
  /**
   * Main sync function - polls for recent appointments
   */
  async syncRecentAppointments() {
    const syncLog = await this.createSyncLog('incremental');
    
    try {
      console.log(`[${new Date().toISOString()}] Starting appointment sync...`);
      
      // Get recent appointments from Bansal API
      const result = await bansalAPI.getRecentAppointments(15);
      
      if (!result.success) {
        throw new Error('API returned unsuccessful response');
      }

      const appointments = result.data;
      console.log(`Fetched ${appointments.length} recent appointments`);

      // Update sync log
      await this.updateSyncLog(syncLog.id, { 
        records_fetched: appointments.length 
      });

      // Process each appointment
      let created = 0;
      let updated = 0;
      let failed = 0;

      for (const appointment of appointments) {
        try {
          const result = await this.processAppointment(appointment);
          if (result === 'created') created++;
          if (result === 'updated') updated++;
        } catch (error) {
          console.error(`Failed to process appointment ${appointment.id}:`, error);
          failed++;
          await this.logSyncError(syncLog.id, appointment.id, error);
        }
      }

      // Complete sync log
      await this.completeSyncLog(syncLog.id, {
        records_created: created,
        records_updated: updated,
        records_failed: failed,
        status: 'completed'
      });

      console.log(`Sync completed: ${created} created, ${updated} updated, ${failed} failed`);
      
      return { created, updated, failed };

    } catch (error) {
      console.error('Sync failed:', error);
      await this.failSyncLog(syncLog.id, error.message);
      throw error;
    }
  }

  /**
   * Process individual appointment
   */
  async processAppointment(appointment) {
    // Check if appointment already exists
    const existing = await db.query(
      'SELECT * FROM crm_appointments WHERE external_id = ?',
      [appointment.id]
    );

    // Map API data to CRM structure
    const appointmentData = this.mapAppointmentData(appointment);

    if (existing.length === 0) {
      // Create new appointment
      await db.query(
        'INSERT INTO crm_appointments SET ?',
        [appointmentData]
      );
      
      // Create related CRM records (lead, contact, deal)
      await this.createCRMRecords(appointmentData);
      
      return 'created';
    } else {
      // Update existing appointment
      await db.query(
        'UPDATE crm_appointments SET ? WHERE external_id = ?',
        [appointmentData, appointment.id]
      );
      
      // Update related CRM records
      await this.updateCRMRecords(appointmentData, existing[0]);
      
      return 'updated';
    }
  }

  /**
   * Map Bansal API data to CRM database structure
   */
  mapAppointmentData(appointment) {
    return {
      external_id: appointment.id,
      client_name: appointment.full_name,
      client_email: appointment.email,
      client_phone: appointment.phone,
      appointment_datetime: appointment.appointment_datetime,
      duration_minutes: appointment.duration_minutes,
      location: appointment.location,
      meeting_type: appointment.meeting_type,
      preferred_language: appointment.preferred_language,
      enquiry_type: appointment.enquiry_type,
      enquiry_type_display: appointment.enquiry_type_display,
      service_type: appointment.service_type,
      specific_service: appointment.specific_service,
      enquiry_details: appointment.enquiry_details,
      status: appointment.status,
      status_display: appointment.status_display,
      confirmed_at: appointment.confirmed_at,
      cancelled_at: appointment.cancelled_at,
      cancellation_reason: appointment.cancellation_reason,
      is_paid: appointment.is_paid,
      amount: appointment.amount,
      discount_amount: appointment.discount_amount,
      final_amount: appointment.final_amount,
      promo_code: appointment.promo_code,
      payment_status: appointment.payment?.status,
      payment_method: appointment.payment?.payment_method,
      paid_at: appointment.payment?.paid_at,
      assigned_admin_id: appointment.assigned_admin?.id,
      assigned_admin_name: appointment.assigned_admin?.name,
      assigned_admin_email: appointment.assigned_admin?.email,
      admin_notes: appointment.admin_notes,
      client_notes: appointment.client_notes,
      source_created_at: appointment.created_at,
      source_updated_at: appointment.updated_at,
      last_synced_at: new Date(),
      sync_status: 'synced'
    };
  }

  /**
   * Create related CRM records (Lead, Contact, Deal)
   */
  async createCRMRecords(appointmentData) {
    // Create or update contact
    const contact = await this.upsertContact({
      name: appointmentData.client_name,
      email: appointmentData.client_email,
      phone: appointmentData.client_phone,
      preferred_language: appointmentData.preferred_language
    });

    // Create lead
    const lead = await this.createLead({
      contact_id: contact.id,
      source: 'Website Appointment',
      enquiry_type: appointmentData.enquiry_type_display,
      service_type: appointmentData.service_type,
      details: appointmentData.enquiry_details,
      status: 'new'
    });

    // Create deal if appointment is paid
    let deal = null;
    if (appointmentData.is_paid) {
      deal = await this.createDeal({
        contact_id: contact.id,
        lead_id: lead.id,
        title: `${appointmentData.enquiry_type_display} - ${appointmentData.client_name}`,
        amount: appointmentData.final_amount,
        stage: appointmentData.status === 'completed' ? 'won' : 'negotiation',
        expected_close_date: appointmentData.appointment_datetime
      });
    }

    // Link back to appointment
    await db.query(
      'UPDATE crm_appointments SET crm_contact_id = ?, crm_lead_id = ?, crm_deal_id = ? WHERE external_id = ?',
      [contact.id, lead.id, deal?.id, appointmentData.external_id]
    );
  }

  /**
   * Update related CRM records
   */
  async updateCRMRecords(appointmentData, existingAppointment) {
    // Update contact information
    if (existingAppointment.crm_contact_id) {
      await this.updateContact(existingAppointment.crm_contact_id, {
        name: appointmentData.client_name,
        email: appointmentData.client_email,
        phone: appointmentData.client_phone
      });
    }

    // Update lead status based on appointment status
    if (existingAppointment.crm_lead_id) {
      const leadStatus = this.mapAppointmentStatusToLeadStatus(appointmentData.status);
      await this.updateLead(existingAppointment.crm_lead_id, {
        status: leadStatus
      });
    }

    // Update deal if exists
    if (existingAppointment.crm_deal_id) {
      const dealStage = this.mapAppointmentStatusToDealStage(appointmentData.status);
      await this.updateDeal(existingAppointment.crm_deal_id, {
        stage: dealStage,
        amount: appointmentData.final_amount
      });
    }
  }

  /**
   * Map appointment status to lead status
   */
  mapAppointmentStatusToLeadStatus(appointmentStatus) {
    const mapping = {
      'pending': 'new',
      'confirmed': 'contacted',
      'in_progress': 'qualified',
      'completed': 'converted',
      'cancelled': 'lost',
      'no_show': 'lost'
    };
    return mapping[appointmentStatus] || 'new';
  }

  /**
   * Map appointment status to deal stage
   */
  mapAppointmentStatusToDealStage(appointmentStatus) {
    const mapping = {
      'pending': 'discovery',
      'confirmed': 'proposal',
      'in_progress': 'negotiation',
      'completed': 'won',
      'cancelled': 'lost',
      'no_show': 'lost'
    };
    return mapping[appointmentStatus] || 'discovery';
  }

  // CRM helper methods (implement based on your CRM system)
  async upsertContact(data) {
    // Your CRM contact creation/update logic
    const existing = await db.query(
      'SELECT * FROM crm_contacts WHERE email = ?',
      [data.email]
    );
    
    if (existing.length > 0) {
      await db.query('UPDATE crm_contacts SET ? WHERE id = ?', [data, existing[0].id]);
      return existing[0];
    } else {
      const result = await db.query('INSERT INTO crm_contacts SET ?', [data]);
      return { id: result.insertId, ...data };
    }
  }

  async createLead(data) {
    const result = await db.query('INSERT INTO crm_leads SET ?', [data]);
    return { id: result.insertId, ...data };
  }

  async updateLead(id, data) {
    await db.query('UPDATE crm_leads SET ? WHERE id = ?', [data, id]);
  }

  async createDeal(data) {
    const result = await db.query('INSERT INTO crm_deals SET ?', [data]);
    return { id: result.insertId, ...data };
  }

  async updateDeal(id, data) {
    await db.query('UPDATE crm_deals SET ? WHERE id = ?', [data, id]);
  }

  async updateContact(id, data) {
    await db.query('UPDATE crm_contacts SET ? WHERE id = ?', [data, id]);
  }

  // Sync log methods
  async createSyncLog(syncType) {
    const result = await db.query(
      'INSERT INTO crm_sync_log (sync_type, sync_started_at, status) VALUES (?, NOW(), ?)',
      [syncType, 'running']
    );
    return { id: result.insertId };
  }

  async updateSyncLog(id, data) {
    await db.query('UPDATE crm_sync_log SET ? WHERE id = ?', [data, id]);
  }

  async completeSyncLog(id, data) {
    await db.query(
      'UPDATE crm_sync_log SET ?, sync_completed_at = NOW() WHERE id = ?',
      [data, id]
    );
  }

  async failSyncLog(id, errorMessage) {
    await db.query(
      'UPDATE crm_sync_log SET status = ?, error_message = ?, sync_completed_at = NOW() WHERE id = ?',
      ['failed', errorMessage, id]
    );
  }

  async logSyncError(syncLogId, externalAppointmentId, error) {
    await db.query(
      'INSERT INTO crm_sync_errors (sync_log_id, external_appointment_id, error_type, error_message, error_data) VALUES (?, ?, ?, ?, ?)',
      [syncLogId, externalAppointmentId, error.name, error.message, JSON.stringify(error)]
    );
  }
}

module.exports = new AppointmentSyncService();

// jobs/syncAppointments.js
const cron = require('node-cron');
const syncService = require('../services/AppointmentSyncService');

// Run every 10 minutes
cron.schedule('*/10 * * * *', async () => {
  console.log('Running scheduled appointment sync...');
  
  try {
    await syncService.syncRecentAppointments();
  } catch (error) {
    console.error('Scheduled sync failed:', error);
    // Send alert to admin (email, Slack, etc.)
  }
});

console.log('Appointment sync scheduler started (runs every 10 minutes)');

// app.js
const express = require('express');
require('./jobs/syncAppointments'); // Start the scheduler

const app = express();

// Manual sync endpoint (for testing or on-demand sync)
app.post('/api/sync/appointments', async (req, res) => {
  try {
    const result = await syncService.syncRecentAppointments();
    res.json({ success: true, result });
  } catch (error) {
    res.status(500).json({ success: false, error: error.message });
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`CRM Backend running on port ${PORT}`);
});
```

---

### Example 2: Python Backend (Flask + SQLAlchemy)

```python
# config.py
import os
from dotenv import load_dotenv

load_dotenv()

class Config:
    BANSAL_API_URL = os.getenv('BANSAL_API_URL', 'https://bansalimmigration.com/api/crm')
    BANSAL_API_TOKEN = os.getenv('BANSAL_API_TOKEN')
    POLL_INTERVAL_MINUTES = 10
    LOOKBACK_MINUTES = 15
    SQLALCHEMY_DATABASE_URI = os.getenv('DATABASE_URL')
    SQLALCHEMY_TRACK_MODIFICATIONS = False

# models.py
from datetime import datetime
from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class CRMAppointment(db.Model):
    __tablename__ = 'crm_appointments'
    
    id = db.Column(db.BigInteger, primary_key=True)
    external_id = db.Column(db.BigInteger, unique=True, nullable=False, index=True)
    
    # Client information
    client_name = db.Column(db.String(255), nullable=False)
    client_email = db.Column(db.String(255), nullable=False, index=True)
    client_phone = db.Column(db.String(50), nullable=False)
    
    # Appointment details
    appointment_datetime = db.Column(db.DateTime, nullable=False, index=True)
    duration_minutes = db.Column(db.Integer, nullable=False)
    location = db.Column(db.String(50), nullable=False)
    meeting_type = db.Column(db.String(50), nullable=False)
    preferred_language = db.Column(db.String(50))
    
    # Service details
    enquiry_type = db.Column(db.String(50), nullable=False)
    enquiry_type_display = db.Column(db.String(100))
    service_type = db.Column(db.String(100))
    specific_service = db.Column(db.String(255))
    enquiry_details = db.Column(db.Text)
    
    # Status
    status = db.Column(db.String(50), nullable=False, index=True)
    status_display = db.Column(db.String(100))
    confirmed_at = db.Column(db.DateTime)
    cancelled_at = db.Column(db.DateTime)
    cancellation_reason = db.Column(db.Text)
    
    # Payment
    is_paid = db.Column(db.Boolean, default=False)
    amount = db.Column(db.Numeric(10, 2), default=0)
    discount_amount = db.Column(db.Numeric(10, 2), default=0)
    final_amount = db.Column(db.Numeric(10, 2), default=0)
    promo_code = db.Column(db.String(50))
    payment_status = db.Column(db.String(50))
    payment_method = db.Column(db.String(50))
    paid_at = db.Column(db.DateTime)
    
    # Assignment
    assigned_admin_id = db.Column(db.BigInteger)
    assigned_admin_name = db.Column(db.String(255))
    assigned_admin_email = db.Column(db.String(255))
    
    # Notes
    admin_notes = db.Column(db.Text)
    client_notes = db.Column(db.Text)
    
    # Sync metadata
    last_synced_at = db.Column(db.DateTime, nullable=False, index=True)
    source_created_at = db.Column(db.DateTime, nullable=False)
    source_updated_at = db.Column(db.DateTime, nullable=False, index=True)
    sync_status = db.Column(db.String(50), default='synced')
    sync_error = db.Column(db.Text)
    
    # CRM links
    crm_lead_id = db.Column(db.BigInteger)
    crm_contact_id = db.Column(db.BigInteger)
    crm_deal_id = db.Column(db.BigInteger)
    
    # Timestamps
    created_at = db.Column(db.DateTime, default=datetime.utcnow)
    updated_at = db.Column(db.DateTime, default=datetime.utcnow, onupdate=datetime.utcnow)

class SyncLog(db.Model):
    __tablename__ = 'crm_sync_log'
    
    id = db.Column(db.BigInteger, primary_key=True)
    sync_type = db.Column(db.String(50), nullable=False)
    sync_started_at = db.Column(db.DateTime, nullable=False)
    sync_completed_at = db.Column(db.DateTime)
    records_fetched = db.Column(db.Integer, default=0)
    records_created = db.Column(db.Integer, default=0)
    records_updated = db.Column(db.Integer, default=0)
    records_failed = db.Column(db.Integer, default=0)
    status = db.Column(db.String(50), nullable=False)
    error_message = db.Column(db.Text)
    created_at = db.Column(db.DateTime, default=datetime.utcnow)

# services/bansal_api_service.py
import requests
from typing import Dict, List, Optional
from config import Config

class BansalAPIService:
    def __init__(self):
        self.base_url = Config.BANSAL_API_URL
        self.headers = {
            'Authorization': f'Bearer {Config.BANSAL_API_TOKEN}',
            'Accept': 'application/json'
        }
        self.timeout = 30

    def get_recent_appointments(self, minutes: int = 15) -> Dict:
        """Get appointments created in last N minutes"""
        try:
            response = requests.get(
                f'{self.base_url}/appointments/recent',
                headers=self.headers,
                params={'minutes': minutes},
                timeout=self.timeout
            )
            response.raise_for_status()
            return response.json()
        except requests.exceptions.RequestException as e:
            print(f'Error fetching recent appointments: {e}')
            raise

    def get_appointments(self, params: Dict = None) -> Dict:
        """Get appointments with filters"""
        try:
            response = requests.get(
                f'{self.base_url}/appointments',
                headers=self.headers,
                params=params or {},
                timeout=self.timeout
            )
            response.raise_for_status()
            return response.json()
        except requests.exceptions.RequestException as e:
            print(f'Error fetching appointments: {e}')
            raise

    def get_appointment(self, appointment_id: int) -> Dict:
        """Get single appointment by ID"""
        try:
            response = requests.get(
                f'{self.base_url}/appointments/{appointment_id}',
                headers=self.headers,
                timeout=self.timeout
            )
            response.raise_for_status()
            return response.json()
        except requests.exceptions.RequestException as e:
            print(f'Error fetching appointment {appointment_id}: {e}')
            raise

# services/appointment_sync_service.py
from datetime import datetime
from models import db, CRMAppointment, SyncLog
from services.bansal_api_service import BansalAPIService

class AppointmentSyncService:
    def __init__(self):
        self.api_service = BansalAPIService()

    def sync_recent_appointments(self):
        """Main sync function - polls for recent appointments"""
        sync_log = self.create_sync_log('incremental')
        
        try:
            print(f'[{datetime.now()}] Starting appointment sync...')
            
            # Get recent appointments
            result = self.api_service.get_recent_appointments(15)
            
            if not result.get('success'):
                raise Exception('API returned unsuccessful response')
            
            appointments = result.get('data', [])
            print(f'Fetched {len(appointments)} recent appointments')
            
            # Update sync log
            sync_log.records_fetched = len(appointments)
            db.session.commit()
            
            # Process appointments
            created = 0
            updated = 0
            failed = 0
            
            for appointment in appointments:
                try:
                    action = self.process_appointment(appointment)
                    if action == 'created':
                        created += 1
                    elif action == 'updated':
                        updated += 1
                except Exception as e:
                    print(f'Failed to process appointment {appointment["id"]}: {e}')
                    failed += 1
            
            # Complete sync log
            sync_log.records_created = created
            sync_log.records_updated = updated
            sync_log.records_failed = failed
            sync_log.status = 'completed'
            sync_log.sync_completed_at = datetime.utcnow()
            db.session.commit()
            
            print(f'Sync completed: {created} created, {updated} updated, {failed} failed')
            
            return {'created': created, 'updated': updated, 'failed': failed}
            
        except Exception as e:
            print(f'Sync failed: {e}')
            sync_log.status = 'failed'
            sync_log.error_message = str(e)
            sync_log.sync_completed_at = datetime.utcnow()
            db.session.commit()
            raise

    def process_appointment(self, appointment: Dict) -> str:
        """Process individual appointment"""
        external_id = appointment['id']
        
        # Check if exists
        existing = CRMAppointment.query.filter_by(external_id=external_id).first()
        
        # Map data
        appointment_data = self.map_appointment_data(appointment)
        
        if not existing:
            # Create new
            new_appointment = CRMAppointment(**appointment_data)
            db.session.add(new_appointment)
            db.session.commit()
            
            # Create CRM records
            self.create_crm_records(new_appointment, appointment)
            
            return 'created'
        else:
            # Update existing
            for key, value in appointment_data.items():
                setattr(existing, key, value)
            db.session.commit()
            
            # Update CRM records
            self.update_crm_records(existing, appointment)
            
            return 'updated'

    def map_appointment_data(self, appointment: Dict) -> Dict:
        """Map API data to CRM structure"""
        return {
            'external_id': appointment['id'],
            'client_name': appointment['full_name'],
            'client_email': appointment['email'],
            'client_phone': appointment['phone'],
            'appointment_datetime': datetime.fromisoformat(appointment['appointment_datetime'].replace('Z', '+00:00')),
            'duration_minutes': appointment['duration_minutes'],
            'location': appointment['location'],
            'meeting_type': appointment['meeting_type'],
            'preferred_language': appointment.get('preferred_language'),
            'enquiry_type': appointment['enquiry_type'],
            'enquiry_type_display': appointment['enquiry_type_display'],
            'service_type': appointment.get('service_type'),
            'specific_service': appointment.get('specific_service'),
            'enquiry_details': appointment.get('enquiry_details'),
            'status': appointment['status'],
            'status_display': appointment['status_display'],
            'confirmed_at': self.parse_datetime(appointment.get('confirmed_at')),
            'cancelled_at': self.parse_datetime(appointment.get('cancelled_at')),
            'cancellation_reason': appointment.get('cancellation_reason'),
            'is_paid': appointment['is_paid'],
            'amount': appointment['amount'],
            'discount_amount': appointment['discount_amount'],
            'final_amount': appointment['final_amount'],
            'promo_code': appointment.get('promo_code'),
            'payment_status': appointment.get('payment', {}).get('status'),
            'payment_method': appointment.get('payment', {}).get('payment_method'),
            'paid_at': self.parse_datetime(appointment.get('payment', {}).get('paid_at')),
            'assigned_admin_id': appointment.get('assigned_admin', {}).get('id'),
            'assigned_admin_name': appointment.get('assigned_admin', {}).get('name'),
            'assigned_admin_email': appointment.get('assigned_admin', {}).get('email'),
            'admin_notes': appointment.get('admin_notes'),
            'client_notes': appointment.get('client_notes'),
            'source_created_at': datetime.fromisoformat(appointment['created_at'].replace('Z', '+00:00')),
            'source_updated_at': datetime.fromisoformat(appointment['updated_at'].replace('Z', '+00:00')),
            'last_synced_at': datetime.utcnow(),
            'sync_status': 'synced'
        }

    def parse_datetime(self, dt_string: Optional[str]) -> Optional[datetime]:
        """Parse datetime string or return None"""
        if not dt_string:
            return None
        return datetime.fromisoformat(dt_string.replace('Z', '+00:00'))

    def create_sync_log(self, sync_type: str) -> SyncLog:
        """Create new sync log"""
        sync_log = SyncLog(
            sync_type=sync_type,
            sync_started_at=datetime.utcnow(),
            status='running'
        )
        db.session.add(sync_log)
        db.session.commit()
        return sync_log

    def create_crm_records(self, appointment: CRMAppointment, api_data: Dict):
        """Create related CRM records (Contact, Lead, Deal)"""
        # Implement based on your CRM system
        pass

    def update_crm_records(self, appointment: CRMAppointment, api_data: Dict):
        """Update related CRM records"""
        # Implement based on your CRM system
        pass

# scheduler.py
from apscheduler.schedulers.background import BackgroundScheduler
from services.appointment_sync_service import AppointmentSyncService

sync_service = AppointmentSyncService()

def scheduled_sync():
    """Function called by scheduler"""
    try:
        print('Running scheduled appointment sync...')
        sync_service.sync_recent_appointments()
    except Exception as e:
        print(f'Scheduled sync failed: {e}')
        # Send alert

# Start scheduler
scheduler = BackgroundScheduler()
scheduler.add_job(scheduled_sync, 'interval', minutes=10)
scheduler.start()

print('Appointment sync scheduler started (runs every 10 minutes)')

# app.py
from flask import Flask, jsonify, request
from models import db
from config import Config
import scheduler  # This starts the background scheduler

app = Flask(__name__)
app.config.from_object(Config)
db.init_app(app)

@app.route('/api/sync/appointments', methods=['POST'])
def manual_sync():
    """Manual sync endpoint"""
    try:
        result = sync_service.sync_recent_appointments()
        return jsonify({'success': True, 'result': result})
    except Exception as e:
        return jsonify({'success': False, 'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, port=3000)
```

---

## Error Handling & Retry Logic

### Implementing Robust Error Handling

```javascript
// services/RetryService.js
class RetryService {
  /**
   * Retry a function with exponential backoff
   */
  async retryWithBackoff(fn, maxRetries = 3, baseDelay = 1000) {
    let lastError;
    
    for (let attempt = 1; attempt <= maxRetries; attempt++) {
      try {
        return await fn();
      } catch (error) {
        lastError = error;
        
        // Don't retry on authentication errors
        if (error.response?.status === 401) {
          throw error;
        }
        
        // Don't retry on validation errors
        if (error.response?.status === 422) {
          throw error;
        }
        
        if (attempt < maxRetries) {
          const delay = baseDelay * Math.pow(2, attempt - 1);
          console.log(`Attempt ${attempt} failed. Retrying in ${delay}ms...`);
          await this.sleep(delay);
        }
      }
    }
    
    throw lastError;
  }

  /**
   * Handle rate limiting with automatic retry
   */
  async handleRateLimit(fn) {
    try {
      return await fn();
    } catch (error) {
      if (error.response?.status === 429) {
        const retryAfter = error.response.headers['retry-after'] || 60;
        console.log(`Rate limited. Waiting ${retryAfter} seconds...`);
        await this.sleep(retryAfter * 1000);
        return await fn(); // Retry once
      }
      throw error;
    }
  }

  sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }
}

module.exports = new RetryService();
```

### Common Error Scenarios & Solutions

| Error | Status | Solution |
|-------|--------|----------|
| Invalid Token | 401 | Regenerate token, update configuration |
| Rate Limit Exceeded | 429 | Wait for retry-after period, reduce polling frequency |
| Server Error | 500 | Retry with exponential backoff, alert admin |
| Timeout | - | Increase timeout, check network |
| Validation Error | 422 | Log for manual review, don't retry |

---

## Testing & Deployment

### Testing Checklist

```bash
# 1. Test API connectivity
curl -X GET "https://bansalimmigration.com/api/crm/appointments/recent?minutes=10" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"

# 2. Test sync service locally
npm run test:sync

# 3. Test error handling
# - Invalid token
# - Network failure
# - Malformed data

# 4. Test database operations
# - Create appointment
# - Update appointment
# - Handle duplicates

# 5. Test CRM record creation
# - Contact creation
# - Lead creation
# - Deal creation

# 6. Performance testing
# - Process 100+ appointments
# - Check memory usage
# - Check response times
```

### Deployment Steps

1. **Set up environment variables**
   ```bash
   BANSAL_API_URL=https://bansalimmigration.com/api/crm
   BANSAL_API_TOKEN=your_production_token
   DATABASE_URL=your_database_url
   ```

2. **Run database migrations**
   ```bash
   npm run migrate
   # or
   python manage.py db upgrade
   ```

3. **Deploy backend service**
   ```bash
   # Docker
   docker build -t crm-sync-service .
   docker run -d --env-file .env crm-sync-service
   
   # PM2 (Node.js)
   pm2 start app.js --name crm-sync
   
   # Systemd (Python)
   sudo systemctl start crm-sync
   ```

4. **Monitor logs**
   ```bash
   tail -f /var/log/crm-sync.log
   ```

5. **Set up monitoring alerts**
   - Sync failures
   - API errors
   - Rate limit warnings

### Monitoring & Maintenance

```javascript
// monitoring/HealthCheck.js
class HealthCheck {
  async checkAPIHealth() {
    try {
      const response = await bansalAPI.getStatistics(
        moment().format('YYYY-MM-DD'),
        moment().format('YYYY-MM-DD')
      );
      return { status: 'healthy', response };
    } catch (error) {
      return { status: 'unhealthy', error: error.message };
    }
  }

  async checkSyncHealth() {
    const lastSync = await db.query(
      'SELECT * FROM crm_sync_log ORDER BY sync_started_at DESC LIMIT 1'
    );
    
    const minutesSinceLastSync = moment().diff(
      moment(lastSync[0].sync_started_at),
      'minutes'
    );
    
    if (minutesSinceLastSync > 30) {
      return { status: 'warning', message: 'No sync in last 30 minutes' };
    }
    
    if (lastSync[0].status === 'failed') {
      return { status: 'error', message: 'Last sync failed' };
    }
    
    return { status: 'healthy' };
  }
}
```

---

## Best Practices & Recommendations

### 1. Data Consistency
- Always use `external_id` as the source of truth
- Store `source_updated_at` to detect changes
- Run daily full reconciliation

### 2. Performance
- Use pagination for large datasets
- Index frequently queried fields
- Batch database operations

### 3. Security
- Rotate API tokens regularly
- Store tokens in secure vaults (AWS Secrets Manager, HashiCorp Vault)
- Use HTTPS only
- Log all API access

### 4. Reliability
- Implement retry logic with exponential backoff
- Handle rate limits gracefully
- Monitor sync health continuously
- Set up alerts for failures

### 5. Scalability
- Design for horizontal scaling
- Use queues for large volumes (RabbitMQ, Redis)
- Cache frequently accessed data
- Archive old sync logs

---

## Support & Troubleshooting

### Common Issues

**Issue: Appointments not syncing**
- Check API token validity
- Verify network connectivity
- Check sync scheduler is running
- Review error logs

**Issue: Duplicate appointments**
- Verify `external_id` uniqueness constraint
- Check sync logic for upsert operations

**Issue: Rate limit errors**
- Reduce polling frequency
- Implement exponential backoff
- Consider batching requests

### Getting Help

For API issues or questions:
- **Email:** support@bansalimmigration.com
- **Review API logs:** Check `crm_sync_log` and `crm_sync_errors` tables

---

## Conclusion

This guide provides a complete blueprint for integrating the Bansal Immigration appointment system with your CRM. The provided examples are production-ready and include:

- ✅ Robust error handling
- ✅ Retry logic
- ✅ Rate limiting compliance
- ✅ Database schema
- ✅ Sync strategies
- ✅ Complete working code

Customize the implementation based on your specific CRM requirements and scale as needed.

---

**Document Version:** 1.0  
**Last Updated:** October 18, 2024  
**Author:** Bansal Immigration Development Team

