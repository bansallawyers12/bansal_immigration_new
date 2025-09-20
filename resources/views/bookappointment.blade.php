@extends('layouts.main')

@section('title', 'Book An Appointment | Bansal Immigration-Your Future, Our Priority')
@section('description', 'Book An Appointment with our experienced immigration consultants')

@push('styles')
<link rel="canonical" href="{{ URL::to('/') }}/book-an-appointment" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Book An Appointment | Bansal Immigration-Your Future, Our Priority" />
<meta property="og:description" content="Book An Appointment with our experienced immigration consultants" />
<meta property="og:url" content="{{ URL::to('/') }}/book-an-appointment/" />
<meta property="og:site_name" content="Bansal Immigration - Your Future, Our Priority" />
<meta property="og:image" content="{{asset('img/logo/logo.jpg')}}" />
<meta name="twitter:card" content="summary_large_image" />
@endpush

@section('content')
<style>
/* Modern Design System Variables - Using Logo Colors */
:root {
    --primary-blue: #1B4D89;
    --primary-blue-light: #2c5aa0;
    --dark-blue: #0a1a2e;
    --medium-blue: #16213e;
    --light-gray: #f8f9fa;
    --border-gray: #f0f0f0;
    --text-gray: #333;
    --light-text: #666;
    --hero-text: #f1f3f4;
    --success-color: #53d56c;
    --error-color: #dc3545;
    --accent-gold: #FFD700;
    --accent-orange: #FF6B35;
    --accent-green: #4CAF50;
    --accent-purple: #9C27B0;
    --accent-red: #E91E63;
}

/* Typography */
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
    font-size: 17px;
    line-height: 1.7;
    color: var(--text-gray);
}

/* Hero Section */
.appointment-hero {
    background: linear-gradient(135deg, var(--dark-blue) 0%, var(--medium-blue) 50%, var(--primary-blue) 100%);
    color: #fff;
    padding: 70px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.appointment-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('{{asset('img/Frontend/bg-2.jpg')}}') center/cover no-repeat;
    opacity: 0.18;
    z-index: 1;
}

.appointment-hero .container {
    position: relative;
    z-index: 2;
}

.appointment-hero h1 {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #fff;
}

.appointment-hero p {
    font-size: 1.2rem;
    color: var(--hero-text);
    margin-bottom: 0;
}

/* Container System */
.appointment-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Grid Layout */
.appointment-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-top: 40px;
    align-items: stretch;
}

.appointment-left {
    flex: 2 1 0;
    min-width: 0;
    display: flex;
    flex-direction: column;
}

.appointment-right {
    flex: 1 1 0;
    min-width: 0;
    display: flex;
    flex-direction: column;
}

/* Card Styles */
.appointment-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid var(--border-gray);
    overflow: hidden;
    margin-bottom: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.appointment-card-body {
    padding: 32px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Step Navigation */
.appointment-steps {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 15px;
}

.step {
    display: flex;
    align-items: center;
    margin: 0 10px;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e0e0e0;
    color: var(--light-text);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-right: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.step.active .step-number {
    background: var(--primary-blue);
    color: #fff;
    transform: scale(1.1);
}

.step-text {
    font-weight: 600;
    color: var(--light-text);
    transition: color 0.3s ease;
    font-size: 14px;
}

.step.active .step-text {
    color: var(--primary-blue);
}

/* Form Elements */
.form-group {
    margin-bottom: 28px;
}

.form-section {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-gray);
    font-size: 15px;
}

.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    font-family: inherit;
    box-sizing: border-box;
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}

.form-textarea {
    min-height: 120px;
    resize: vertical;
}

/* Enquiry Selection */
.enquiry-option {
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.enquiry-option:hover {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.05);
}

.enquiry-option.selected {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.1);
    position: relative;
    transform: scale(1.02);
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.2);
}

.enquiry-option.selected::after {
    content: '✓';
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-blue);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.enquiry-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.enquiry-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.enquiry-icon {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    margin-right: 16px;
    object-fit: cover;
    background: var(--light-gray);
}

.enquiry-info {
    flex: 1;
}

.enquiry-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-gray);
    margin-bottom: 4px;
}

.enquiry-subtitle {
    font-size: 14px;
    color: var(--light-text);
}

.enquiry-price {
    font-size: 24px;
    font-weight: 700;
    color: var(--success-color);
}

.enquiry-description {
    font-size: 14px;
    color: var(--light-text);
    margin-top: 8px;
    line-height: 1.5;
}

/* Service Selection */
.service-option {
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

/* Service Selection Options */
.service-selection-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.service-selection-option {
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 16px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background: #fff;
}

.service-selection-option:hover {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.15);
}

.service-selection-option.selected {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.1);
    position: relative;
    transform: scale(1.02);
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.2);
}

.service-selection-option.selected::after {
    content: '✓';
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-blue);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.service-selection-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.service-selection-content {
    display: flex;
    align-items: center;
    width: 100%;
}

.service-selection-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-gray);
    line-height: 1.4;
}

.service-option:hover {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.05);
}

.service-option.selected {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.1);
    position: relative;
    transform: scale(1.02);
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.2);
}

.service-option.selected::after {
    content: '✓';
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-blue);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.service-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.service-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.service-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    margin-right: 16px;
    object-fit: cover;
    background: var(--light-gray);
}

.service-info {
    flex: 1;
}

.service-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-gray);
    margin-bottom: 4px;
}

.service-duration {
    font-size: 14px;
    color: var(--light-text);
}

.service-price {
    font-size: 24px;
    font-weight: 700;
    color: var(--success-color);
}

.service-description {
    font-size: 14px;
    color: var(--light-text);
    margin-top: 8px;
    line-height: 1.5;
}

/* Location Selection */
.location-options {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.location-option {
    flex: 1;
    min-width: 200px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    position: relative;
}

.location-option:hover {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.15);
}

.location-option.selected {
    border-color: var(--primary-blue);
    background: linear-gradient(135deg, rgba(27, 77, 137, 0.1), rgba(44, 90, 160, 0.1));
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.2);
    position: relative;
    transform: scale(1.02);
}

.location-option.selected::after {
    content: '✓';
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-blue);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.location-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.location-name {
    font-weight: 700;
    color: var(--primary-blue);
    margin-bottom: 8px;
    font-size: 18px;
}

.location-address {
    font-size: 13px;
    color: var(--light-text);
    line-height: 1.4;
}

/* Meeting Type Selection */
.meeting-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 16px;
}

.meeting-option {
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    position: relative;
    background: #fff;
}

.meeting-option:hover {
    border-color: var(--accent-orange);
    background: rgba(255, 107, 53, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
}

.meeting-option.selected {
    border-color: var(--accent-orange);
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(255, 152, 0, 0.1));
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
    position: relative;
    transform: scale(1.02);
}

.meeting-option.selected::after {
    content: '✓';
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--accent-orange);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.meeting-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.meeting-icon {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
}

.meeting-title {
    font-weight: 600;
    color: var(--text-gray);
    margin-bottom: 4px;
    font-size: 16px;
}

.meeting-subtitle {
    font-size: 12px;
    color: var(--light-text);
    line-height: 1.3;
}

/* Language Selection */
.language-options {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.language-option {
    flex: 1;
    min-width: 100px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    position: relative;
    background: #fff;
}

.language-option:hover {
    border-color: var(--accent-green);
    background: rgba(76, 175, 80, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.15);
}

.language-option.selected {
    border-color: var(--accent-green);
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(69, 160, 73, 0.1));
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
    position: relative;
    transform: scale(1.02);
}

.language-option.selected::after {
    content: '✓';
    position: absolute;
    top: 8px;
    right: 8px;
    background: var(--accent-green);
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
}

.language-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.language-flag {
    font-size: 24px;
    margin-bottom: 8px;
    display: block;
}

.language-name {
    font-weight: 600;
    color: var(--text-gray);
    font-size: 14px;
}

/* Calendar & Time Slots */
.calendar-container {
    display: flex;
    gap: 24px;
    margin: 24px 0;
}

.calendar-widget {
    flex: 1;
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border: 1px solid var(--border-gray);
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.calendar-nav {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: var(--primary-blue);
    padding: 8px;
    border-radius: 6px;
    transition: background-color 0.3s ease;
}

.calendar-nav:hover {
    background: rgba(27, 77, 137, 0.1);
}

.calendar-title {
    font-weight: 600;
    color: var(--text-gray);
}

.calendar-day {
    padding: 8px;
    text-align: center;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

.calendar-day:hover:not(.unavailable) {
    background: rgba(27, 77, 137, 0.1);
}

.calendar-day.selected {
    background: var(--primary-blue);
    color: #fff;
}

.calendar-day.unavailable {
    opacity: 0.3;
    cursor: not-allowed;
}

.timeslots-container {
    flex: 1;
    min-width: 300px;
}

.selected-date {
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    padding: 12px;
    background: var(--light-gray);
    border-radius: 8px;
    margin-bottom: 16px;
    color: var(--primary-blue);
}

.time-slots {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 12px;
    max-height: 300px;
    overflow-y: auto;
    padding: 4px;
}

.time-slot {
    padding: 10px 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
    font-weight: 500;
    font-size: 13px;
}

.time-slot:hover {
    border-color: var(--primary-blue);
    background: rgba(27, 77, 137, 0.05);
}

.time-slot.selected {
    border-color: var(--primary-blue);
    background: var(--primary-blue);
    color: #fff;
}

.time-slot.unavailable {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f5f5f5;
}

/* Buttons */
.appointment-btn {
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: #fff;
    border: 0;
    border-radius: 25px;
    padding: 12px 24px;
    text-transform: uppercase;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.appointment-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
}

.appointment-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.appointment-btn-secondary {
    background: transparent;
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
}

.appointment-btn-secondary:hover {
    background: var(--primary-blue);
    color: #fff;
}

/* Confirmation Table */
.confirmation-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.confirmation-table th,
.confirmation-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.confirmation-table th {
    background: var(--light-gray);
    font-weight: 600;
    color: var(--text-gray);
}

/* Information Section */
.info-section {
    background: var(--light-gray);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    margin-bottom: 20px;
    padding-left: 0;
}

.info-list h4 {
    color: var(--primary-blue);
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 12px;
}

.info-list ol {
    margin-left: 20px;
    margin-top: 8px;
}

.info-list ol li {
    margin-bottom: 12px;
    line-height: 1.6;
}

.info-list h6 {
    display: inline;
    font-weight: 600;
    color: var(--text-gray);
}

/* Sidebar */
.appointment-sidebar {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 0;
    overflow: hidden;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.sidebar-section {
    padding: 20px;
    border-bottom: 1px solid rgba(27, 77, 137, 0.1);
    flex: 1;
    display: flex;
    flex-direction: column;
}

.sidebar-section:last-child {
    border-bottom: none;
    flex: 1;
}

.logo-section {
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: white;
    text-align: center;
    padding: 24px 20px;
    border-radius: 20px 20px 0 0;
}

.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.sidebar-logo {
    max-width: 100%;
    width: 100%;
    height: auto;
    max-height: 200px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    background: white;
    padding: 8px;
    border: 2px solid rgba(255,255,255,0.3);
    object-fit: contain;
}

@media (max-width: 768px) {
    .sidebar-logo {
        max-height: 150px;
    }
}

@media (min-width: 1024px) {
    .sidebar-logo {
        max-height: 250px;
    }
}

.company-name {
    font-size: 22px;
    font-weight: 800;
    margin: 0;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 0.5px;
}

.company-tagline {
    font-size: 14px;
    margin: 0;
    color: rgba(255,255,255,0.95);
    font-style: italic;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.sidebar-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--primary-blue);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.title-icon {
    font-size: 18px;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: white;
    border-radius: 12px;
    border: 1px solid rgba(27, 77, 137, 0.1);
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.15);
    border-color: var(--primary-blue);
}

.contact-icon {
    font-size: 20px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: white;
    border-radius: 10px;
}

.contact-details {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.contact-label {
    font-size: 12px;
    color: var(--light-text);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 14px;
    color: var(--text-gray);
    font-weight: 600;
}

.hours-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.hours-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: white;
    border-radius: 10px;
    border: 1px solid rgba(27, 77, 137, 0.1);
    transition: all 0.3s ease;
}

.hours-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(27, 77, 137, 0.1);
}

.hours-item.closed {
    opacity: 0.6;
    background: #f8f9fa;
}

.hours-days {
    font-weight: 600;
    color: var(--text-gray);
    font-size: 14px;
}

.hours-time {
    font-weight: 500;
    color: var(--primary-blue);
    font-size: 13px;
}

.locations-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.location-item {
    padding: 16px;
    background: white;
    border-radius: 12px;
    border: 1px solid rgba(27, 77, 137, 0.1);
    transition: all 0.3s ease;
}

.location-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.15);
    border-color: var(--primary-blue);
}

.location-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.location-icon {
    font-size: 18px;
}

.location-name {
    font-weight: 700;
    color: var(--primary-blue);
    font-size: 16px;
}

.location-address {
    font-size: 13px;
    color: var(--light-text);
    line-height: 1.4;
    margin-left: 28px;
}

.features-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    background: white;
    border-radius: 8px;
    border: 1px solid rgba(27, 77, 137, 0.1);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateX(4px);
    box-shadow: 0 2px 8px rgba(27, 77, 137, 0.1);
    border-color: var(--accent-green);
}

.feature-icon {
    font-size: 16px;
    color: var(--accent-green);
}

.feature-text {
    font-size: 14px;
    color: var(--text-gray);
    font-weight: 500;
}

.stats-section {
    background: linear-gradient(135deg, var(--accent-orange), #F57C00);
    color: white;
}

.stats-section .sidebar-title {
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.stat-item {
    text-align: center;
    padding: 12px 8px;
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    background: rgba(255,255,255,0.3);
}

.stat-number {
    font-size: 20px;
    font-weight: 700;
    color: white;
    margin-bottom: 3px;
}

.stat-label {
    font-size: 10px;
    color: rgba(255,255,255,0.9);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Hide/Show sections */
.section-hidden {
    display: none;
}

.section-visible {
    display: block;
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Error Messages */
.error-message {
    color: var(--error-color);
    font-size: 14px;
    margin-top: 4px;
    display: block;
}

/* Responsive Design */
@media (max-width: 900px) {
    .appointment-grid {
        flex-direction: column;
    }
    
    .appointment-left,
    .appointment-right {
        flex: 1 1 auto;
    }
    
    .appointment-hero h1 {
        font-size: 2.2rem;
    }
    
    .appointment-hero p {
        font-size: 1rem;
    }
    
    .appointment-container {
        padding: 0 12px;
    }
    
    .calendar-container {
        flex-direction: column;
    }
    
    .time-slots {
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
    }
    
    .location-options {
        flex-direction: column;
    }
    
    .appointment-steps {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .step {
        flex-shrink: 0;
        margin: 0 5px;
    }
    
    .step-text {
        display: none;
    }
}

@media (max-width: 480px) {
    .appointment-card-body {
        padding: 20px;
    }
    
    .service-header {
        flex-direction: column;
        text-align: center;
    }
    
    .service-image {
        margin-right: 0;
        margin-bottom: 12px;
    }
    
    .appointment-hero {
        padding: 40px 0;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
}
</style>

<!-- Hero Section -->
<div class="appointment-hero">
    <div class="container">
        <h1>Book Your Immigration Consultation</h1>
        <p>Schedule a confidential consultation with our experienced MARA agents.</p>
    </div>
</div>

<!-- Main Content -->
<section class="py-16" style="background-color: var(--light-gray);">
    <div class="appointment-container">
        <!-- Information Section -->
        <div class="info-section">
            <ol class="info-list">
                <li>
                    <h4>Migration Consultation (Free Option)</h4>
                    <ol type="A">
                        <li>
                            <h6>In-Person or Phone Meetings:</h6> We offer free consultations to discuss your immigration matters, either in person or over the phone. If your inquiry is related to Australian Permanent Residency (PR), we encourage you to select the PR Appointment option and provide the required information in advance.
                        </li>
                        <li>
                            <h6>10-Minute Free Phone Consultations:</h6> We also provide a 10-minute free phone consultation for any immigration-related matter. However, due to time constraints and the need for specific details to provide accurate advice, we kindly request that you include all relevant information in the query box when booking your consultation.
                        </li>
                    </ol>
                </li>

                <li>
                    <h4>Overseas Applicant Enquiry</h4>
                    <ol type="A">
                        <li>
                            <h6>Paid Appointment Only:</h6> The first free appointment service is exclusively available to clients who are currently within Australia. If you are outside Australia or inquiring on behalf of someone outside Australia, please select the Migration Advice option and pay the consultation fee of $150.
                        </li>
                        <li>
                            <h6>Required Information:</h6> To assist us in providing accurate advice, please send a detailed resume of the applicant, along with any specific questions you have, to our email address. This will allow us to review the information before discussing the matter with you.
                        </li>
                    </ol>
                </li>

                <li>
                    <h4>Migration Advice (Paid Service)</h4>
                    <ol type="A">
                        <li>
                            <h6>Consultation Fee:</h6> Our fee is $150 for most types of migration advice. Please select this option if your matter is complicated and includes Administrative Appeals Tribunal (AAT) cases, Visa cancellations, or Protection visas, etc. If you believe it will require more than 10 minutes to discuss, please select this paid option.
                        </li>
                        <li>
                            <h6>Free Consultation Policy:</h6> Please note that we only provide one free consultation per client. If you have already used your free consultation, you will need to select this paid option for further advice.
                        </li>
                    </ol>
                </li>
            </ol>

            <p style="font-style: italic; margin-top: 20px;"><strong>Note:</strong> If you do not provide the required information, we may cancel your appointment without prior notice.</p>

            <div style="margin-top: 20px;">
                <p><strong>Additional Information:</strong></p>
                <p>If you book your appointment via this link, all appointments will be scheduled with one of our <strong>available MARA agents</strong>. Should you want to talk to any specific person, kindly mention their names in the query section.</p>
                
                <p><strong>Ajay Bansal is no longer involved with BANSAL Immigration. He has his own firm, BANSAL Lawyers. If you want to book an appointment with him, kindly click this link to book appointment:</strong> <a style="text-decoration: underline; color: var(--primary-blue);" href="https://www.bansallawyers.com.au/book-an-appointment" target="_blank">Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne</a>.</p>

                <p><strong>Need Help?</strong></p>
                <p>If you're unsure which option to choose, feel free to call our friendly staff at <strong>03 9602 1330</strong>. They can assist with booking your appointment or help you choose the right option.</p>
            </div>
        </div>

        <div class="appointment-grid">
            <div class="appointment-left">
                <!-- Main Appointment Form -->
                <div class="appointment-card">
                    <div class="appointment-card-body">
                        <!-- Step Navigation -->
                        <div class="appointment-steps">
                            <div class="step active" id="step-1">
                                <div class="step-number">1</div>
                                <span class="step-text">Location</span>
                            </div>
                            <div class="step" id="step-2">
                                <div class="step-number">2</div>
                                <span class="step-text">Service</span>
                            </div>
                            <div class="step" id="step-3">
                                <div class="step-number">3</div>
                                <span class="step-text">Details</span>
                            </div>
                            <div class="step" id="step-4">
                                <div class="step-number">4</div>
                                <span class="step-text">Confirm</span>
                            </div>
                        </div>

                        <form id="appointment-form" method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                            
                            <!-- Step 1: Location Selection -->
                            <div id="location-section" class="form-section">
                                <h3 style="color: var(--primary-blue); margin-bottom: 24px;">Choose Your Preferred Location</h3>
                                
                                <div class="form-group">
                                    <label>Select Office Location</label>
                                    <div class="location-options">
                                        <div class="location-option" data-location="adelaide">
                                            <input type="radio" name="location" value="adelaide" id="location-adelaide">
                                            <div class="location-name">Adelaide Office</div>
                                            <div class="location-address">Unit 5, 55 Gawler Pl<br>Adelaide SA 5000</div>
                                        </div>
                                        <div class="location-option" data-location="melbourne">
                                            <input type="radio" name="location" value="melbourne" id="location-melbourne">
                                            <div class="location-name">Melbourne Office</div>
                                            <div class="location-address">Level 8/278 Collins St<br>Melbourne VIC 3000</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Meeting Type</label>
                                    <div class="meeting-options">
                                        <div class="meeting-option" data-meeting="phone">
                                            <input type="radio" name="meeting_type" value="phone" id="meeting-phone">
                                            <div class="meeting-icon">📞</div>
                                            <div class="meeting-title">Phone Call</div>
                                            <div class="meeting-subtitle">Speak directly with our experts</div>
                                        </div>
                                        <div class="meeting-option" data-meeting="in-person">
                                            <input type="radio" name="meeting_type" value="in-person" id="meeting-inperson">
                                            <div class="meeting-icon">🏢</div>
                                            <div class="meeting-title">In Person</div>
                                            <div class="meeting-subtitle">Visit our office</div>
                                        </div>
                                        <div class="meeting-option" data-meeting="video-call" style="display: none;">
                                            <input type="radio" name="meeting_type" value="video-call" id="meeting-video">
                                            <div class="meeting-icon">📹</div>
                                            <div class="meeting-title">Video Call</div>
                                            <div class="meeting-subtitle">Online consultation</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Preferred Language</label>
                                    <div class="language-options">
                                        <div class="language-option" data-language="english">
                                            <input type="radio" name="preferred_language" value="english" id="lang-english">
                                            <div class="language-flag">🇦🇺</div>
                                            <div class="language-name">English</div>
                                        </div>
                                        <div class="language-option" data-language="hindi">
                                            <input type="radio" name="preferred_language" value="hindi" id="lang-hindi">
                                            <div class="language-flag">🇮🇳</div>
                                            <div class="language-name">Hindi</div>
                                        </div>
                                        <div class="language-option" data-language="punjabi">
                                            <input type="radio" name="preferred_language" value="punjabi" id="lang-punjabi">
                                            <div class="language-flag">🇮🇳</div>
                                            <div class="language-name">Punjabi</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="appointment-btn" onclick="nextStep(2)">Next Step</button>
                                </div>
                            </div>

                            <!-- Step 2: Service Selection -->
                            <div id="service-selection-section" class="form-section section-hidden">
                                <h3 style="color: var(--primary-blue); margin-bottom: 24px;">Select Your Service</h3>
                                
                                <div class="form-group">
                                    <label>Choose the service you need</label>
                                    <div class="service-selection-options">
                                        <div class="service-selection-option" data-service="permanent-residency">
                                            <input type="radio" name="service_type" value="permanent-residency" id="service-pr">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Permanent Residency Appointment</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="temporary-residency">
                                            <input type="radio" name="service_type" value="temporary-residency" id="service-tr">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Temporary Residency Appointment</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="jrp-skill-assessment">
                                            <input type="radio" name="service_type" value="jrp-skill-assessment" id="service-jrp">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">JRP/Skill Assessment</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="tourist-visa">
                                            <input type="radio" name="service_type" value="tourist-visa" id="service-tourist">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Tourist Visa</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="education-visa">
                                            <input type="radio" name="service_type" value="education-visa" id="service-education">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Education/Course Change/Student Visa/Student Dependent Visa (for education selection only)</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="complex-matters">
                                            <input type="radio" name="service_type" value="complex-matters" id="service-complex">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Complex matters: AAT, Protection visa, Federal Case</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="visa-cancellation">
                                            <input type="radio" name="service_type" value="visa-cancellation" id="service-cancellation">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">Visa Cancellation/ NOICC/ Visa refusals</div>
                                            </div>
                                        </div>
                                        
                                        <div class="service-selection-option" data-service="international-migration">
                                            <input type="radio" name="service_type" value="international-migration" id="service-international">
                                            <div class="service-selection-content">
                                                <div class="service-selection-title">INDIA/UK/CANADA/EUROPE TO AUSTRALIA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center" style="margin-top: 24px;">
                                    <button type="button" class="appointment-btn appointment-btn-secondary" onclick="prevStep(1)" style="margin-right: 12px;">Previous</button>
                                    <button type="button" class="appointment-btn" onclick="nextStep(3)">Next Step</button>
                                </div>
                            </div>


                            <!-- Step 4: Service Selection -->
                            <div id="service-section" class="form-section section-hidden">
                                <h3 style="color: var(--primary-blue); margin-bottom: 24px;">Select Service</h3>
                                <div class="services-list">
                                    <div class="service-option" data-service="consultation" data-timing="free">
                                        <input type="radio" name="service" value="consultation" id="service-consultation">
                                        <div class="service-header">
                                            <div class="service-image" style="background: linear-gradient(45deg, var(--accent-green), #45a049); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">FREE</div>
                                            <div class="service-info">
                                                <div class="service-title">Free Consultation</div>
                                                <div class="service-duration">15 minutes • 12:00 PM - 3:00 PM</div>
                                            </div>
                                            <div class="service-price" style="color: var(--accent-green);">FREE</div>
                                        </div>
                                        <div class="service-description">
                                            <strong>Perfect for initial inquiries:</strong> Quick assessment of your immigration situation, basic visa pathway guidance, and preliminary advice. Available for clients currently within Australia only. Includes initial case evaluation and next steps recommendation.
                                            <br><br>
                                            <em>Available: Monday to Friday, 12:00 PM - 3:00 PM • 15-minute time slots</em>
                                        </div>
                                    </div>

                                    <div class="service-option" data-service="paid-consultation" data-timing="paid">
                                        <input type="radio" name="service" value="paid-consultation" id="service-paid">
                                        <div class="service-header">
                                            <div class="service-image" style="background: linear-gradient(45deg, var(--accent-orange), #F57C00); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">$150</div>
                                            <div class="service-info">
                                                <div class="service-title">Comprehensive Migration Advice</div>
                                                <div class="service-duration">30 minutes • 10:00 AM - 5:00 PM</div>
                                            </div>
                                            <div class="service-price" style="color: var(--accent-orange);">$150</div>
                                        </div>
                                        <div class="service-description">
                                            <strong>In-depth professional consultation:</strong> Comprehensive case analysis, detailed migration strategy, complex visa applications, AAT appeals, visa cancellations, protection visas, and personalized action plans. Suitable for overseas applicants and complex cases.
                                            <br><br>
                                            <em>Available: Monday to Friday, 10:00 AM - 5:00 PM • 30-minute time slots • Includes video call option</em>
                                        </div>
                                    </div>

                                    <div class="service-option" data-service="overseas-enquiry" data-timing="paid">
                                        <input type="radio" name="service" value="overseas-enquiry" id="service-overseas">
                                        <div class="service-header">
                                            <div class="service-image" style="background: linear-gradient(45deg, var(--primary-blue), var(--primary-blue-light)); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 10px;">OVERSEAS</div>
                                            <div class="service-info">
                                                <div class="service-title">Overseas Applicant Enquiry</div>
                                                <div class="service-duration">30 minutes • 10:00 AM - 5:00 PM</div>
                                            </div>
                                            <div class="service-price" style="color: var(--primary-blue);">$150</div>
                                        </div>
                                        <div class="service-description">
                                            <strong>Specialized consultation for overseas applicants:</strong> For applicants currently outside Australia or inquiring on behalf of someone overseas. Includes detailed assessment and personalized migration strategy.
                                            <br><br>
                                            <em>Available: Monday to Friday, 10:00 AM - 5:00 PM • 30-minute time slots • Includes video call option</em>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center" style="margin-top: 24px;">
                                    <button type="button" class="appointment-btn appointment-btn-secondary" onclick="prevStep(2)" style="margin-right: 12px;">Previous</button>
                                    <button type="button" class="appointment-btn" onclick="nextStep(4)">Next Step</button>
                                </div>
                            </div>

                            <!-- Step 4: Personal Details & Date/Time -->
                            <div id="details-section" class="form-section section-hidden">
                                <h3 style="color: var(--primary-blue); margin-bottom: 24px;">Your Details & Appointment Time</h3>
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                                    <div class="form-group">
                                        <label for="full-name">Full Name</label>
                                        <input type="text" id="full-name" name="full_name" class="form-input" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email" class="form-input" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div style="display: flex; gap: 8px;">
                                        <select id="country-code" name="country_code" class="form-input" style="flex: 0 0 120px;">
                                            <option value="+61" selected>🇦🇺 +61</option>
                                            <option value="+1">🇺🇸 +1</option>
                                            <option value="+44">🇬🇧 +44</option>
                                            <option value="+91">🇮🇳 +91</option>
                                            <option value="+86">🇨🇳 +86</option>
                                            <option value="+81">🇯🇵 +81</option>
                                            <option value="+82">🇰🇷 +82</option>
                                            <option value="+65">🇸🇬 +65</option>
                                            <option value="+60">🇲🇾 +60</option>
                                            <option value="+66">🇹🇭 +66</option>
                                            <option value="+63">🇵🇭 +63</option>
                                            <option value="+64">🇳🇿 +64</option>
                                            <option value="+49">🇩🇪 +49</option>
                                            <option value="+33">🇫🇷 +33</option>
                                            <option value="+39">🇮🇹 +39</option>
                                            <option value="+34">🇪🇸 +34</option>
                                            <option value="+7">🇷🇺 +7</option>
                                            <option value="+55">🇧🇷 +55</option>
                                            <option value="+52">🇲🇽 +52</option>
                                            <option value="+27">🇿🇦 +27</option>
                                        </select>
                                        <input type="tel" id="phone" name="phone" class="form-input" placeholder="400 000 000" required style="flex: 1;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-details">Details of Enquiry</label>
                                    <textarea id="enquiry-details" name="enquiry_details" class="form-textarea" placeholder="Please provide detailed information about your enquiry..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="promo-code">Promo Code (Optional)</label>
                                    <div style="display: flex; gap: 8px;">
                                        <input type="text" id="promo-code" name="promo_code" class="form-input" placeholder="Enter promo code" style="flex: 1;">
                                        <button type="button" id="validate-promo-btn" class="appointment-btn appointment-btn-secondary" style="flex: 0 0 auto; padding: 12px 16px;">Apply</button>
                                    </div>
                                    <div id="promo-message" class="promo-message" style="margin-top: 8px; font-size: 14px; display: none;"></div>
                                </div>

                                <div class="form-group">
                                    <label>Select Date & Time</label>
                                    <div class="calendar-container">
                                        <div class="calendar-widget">
                                            <div class="calendar-header">
                                                <button type="button" class="calendar-nav" id="prev-month">‹</button>
                                                <div class="calendar-title" id="calendar-title">December 2024</div>
                                                <button type="button" class="calendar-nav" id="next-month">›</button>
                                            </div>
                                            <div id="calendar-grid"></div>
                                        </div>
                                        <div class="timeslots-container">
                                            <div class="selected-date" id="selected-date">Select a date</div>
                                            <div class="time-slots" id="time-slots">
                                                <!-- Time slots will be populated by JavaScript -->
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="selected-date-input" name="selected_date">
                                    <input type="hidden" id="selected-time-input" name="selected_time">
                                </div>

                                <div class="text-center" style="margin-top: 24px;">
                                    <button type="button" class="appointment-btn appointment-btn-secondary" onclick="prevStep(3)" style="margin-right: 12px;">Previous</button>
                                    <button type="button" class="appointment-btn" onclick="nextStep(4)">Review & Confirm</button>
                                </div>
                            </div>

                            <!-- Step 5: Confirmation -->
                            <div id="confirmation-section" class="form-section section-hidden">
                                <h3 style="color: var(--primary-blue); margin-bottom: 24px;">Confirm Your Appointment</h3>
                                
                                <table class="confirmation-table">
                                    <tr>
                                        <th>Full Name</th>
                                        <td id="confirm-name"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="confirm-email"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td id="confirm-phone"></td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td id="confirm-location"></td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Type</th>
                                        <td id="confirm-meeting-type"></td>
                                    </tr>
                                    <tr>
                                        <th>Service</th>
                                        <td id="confirm-service"></td>
                                    </tr>
                                    <tr>
                                        <th>Date & Time</th>
                                        <td id="confirm-datetime"></td>
                                    </tr>
                                    <tr>
                                        <th>Enquiry Details</th>
                                        <td id="confirm-details"></td>
                                    </tr>
                                </table>

                                <div class="text-center" style="margin-top: 24px;">
                                    <button type="button" class="appointment-btn appointment-btn-secondary" onclick="prevStep(4)" style="margin-right: 12px;">Previous</button>
                                    <button type="submit" class="appointment-btn" id="submit-free" style="display: none;">Submit Appointment</button>
                                    <button type="button" class="appointment-btn" id="submit-paid" style="display: none;">Pay & Submit ($150)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <aside class="appointment-right">
                <!-- Contact Information Sidebar -->
                <div class="appointment-card">
                    <div class="appointment-card-body">
                        <div class="appointment-sidebar">
                            <!-- Logo Section -->
                            <div class="sidebar-section logo-section">
                                <div class="logo-container">
                                    <img src="{{asset('img/logo/logo.png')}}" alt="Bansal Immigration" class="sidebar-logo" onerror="this.style.display='none'">
                                    <div class="logo-text">
                                        <h2 class="company-name">Bansal Immigration</h2>
                                        <p class="company-tagline">Your Future, Our Priority</p>
                                    </div>
                                </div>
                            </div>


                            <!-- Why Choose Us -->
                            <div class="sidebar-section">
                                <h3 class="sidebar-title">
                                    <span class="title-icon">⭐</span>
                                    Why Choose Us?
                                </h3>
                                <div class="features-list">
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Registered MARA agents</span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Over 10 years experience</span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Free initial consultation</span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Multiple office locations</span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Multilingual support</span>
                                    </div>
                                    <div class="feature-item">
                                        <span class="feature-icon">✅</span>
                                        <span class="feature-text">Personalized service</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="sidebar-section stats-section">
                                <h3 class="sidebar-title">
                                    <span class="title-icon">📊</span>
                                    Our Success
                                </h3>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-number">1000+</div>
                                        <div class="stat-label">Successful Cases</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">10+</div>
                                        <div class="stat-label">Years Experience</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">98%</div>
                                        <div class="stat-label">Success Rate</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">24/7</div>
                                        <div class="stat-label">Support</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            </div>
        </div>
    </section>

<script>
// Modern appointment booking JavaScript
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    let selectedDate = null;
    let selectedTime = null;
    
    // Initialize the form
    initializeForm();
    
    function initializeForm() {
        // Service selection handlers (new step 2)
        document.querySelectorAll('.service-selection-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.service-selection-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                checkAndAutoProgress(2);
            });
        });


        // Add click handlers to meeting options
        document.querySelectorAll('.meeting-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.meeting-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                checkStep1Completion();
            });
        });

        // Add click handlers to language options
        document.querySelectorAll('.language-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.language-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                checkStep1Completion();
            });
        });
        
        // Service selection handlers
        document.querySelectorAll('.service-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.service-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                
                // Show/hide video call option based on service
                const meetingTypeSelect = document.getElementById('meeting-type');
                if (meetingTypeSelect) {
                    const videoOption = meetingTypeSelect.querySelector('option[value="video-call"]');
                    if (videoOption) {
                        if (this.dataset.service === 'paid-consultation') {
                            videoOption.style.display = 'block';
                        } else {
                            videoOption.style.display = 'none';
                            if (meetingTypeSelect.value === 'video-call') {
                                meetingTypeSelect.value = '';
                            }
                        }
                    }
                }
                
                checkAndAutoProgress(3);
            });
        });
        
        // Location selection handlers
        document.querySelectorAll('.location-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.location-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                checkStep1Completion();
            });
        });
        
        // Initialize calendar
        initializeCalendar();
        
    }
    
    window.nextStep = function(step) {
        if (validateCurrentStep()) {
            hideAllSections();
            showSection(step);
            updateStepIndicator(step);
            currentStep = step;
            
            if (step === 5) {
                populateConfirmation();
            }
        }
    }
    
    window.prevStep = function(step) {
        hideAllSections();
        showSection(step);
        updateStepIndicator(step);
        currentStep = step;
    }
    
    function hideAllSections() {
        document.querySelectorAll('.form-section').forEach(section => {
            section.classList.add('section-hidden');
            section.classList.remove('section-visible');
        });
    }
    
    function showSection(step) {
        const sections = {
            1: 'location-section',
            2: 'service-selection-section',
            3: 'service-section',
            4: 'details-section',
            5: 'confirmation-section'
        };
        
        const sectionId = sections[step];
        if (sectionId) {
            const section = document.getElementById(sectionId);
            section.classList.remove('section-hidden');
            section.classList.add('section-visible');
        }
    }
    
    function updateStepIndicator(step) {
        document.querySelectorAll('.step').forEach((stepEl, index) => {
            if (index + 1 <= step) {
                stepEl.classList.add('active');
            } else {
                stepEl.classList.remove('active');
            }
        });
    }
    
    function validateCurrentStep() {
        const stepValidations = {
            1: () => {
                return document.querySelector('input[name="location"]:checked') !== null &&
                       document.querySelector('input[name="meeting_type"]:checked') !== null &&
                       document.querySelector('input[name="preferred_language"]:checked') !== null;
            },
            2: () => document.querySelector('input[name="service_type"]:checked') !== null,
            3: () => document.querySelector('input[name="service"]:checked') !== null,
            4: () => {
                return document.getElementById('full-name').value.trim() !== '' &&
                       document.getElementById('email').value.trim() !== '' &&
                       document.getElementById('phone').value.trim() !== '' &&
                       document.getElementById('enquiry-details').value.trim() !== '' &&
                       selectedDate !== null &&
                       selectedTime !== null;
            }
        };
        
        if (stepValidations[currentStep]) {
            const isValid = stepValidations[currentStep]();
            if (!isValid) {
                alert('Please fill in all required fields before proceeding.');
            }
            return isValid;
        }
        
        return true;
    }
    
    function checkStep1Completion() {
        // Add a small delay to allow the UI to update
        setTimeout(() => {
            const isLocationSelected = document.querySelector('input[name="location"]:checked') !== null;
            const isMeetingTypeSelected = document.querySelector('input[name="meeting_type"]:checked') !== null;
            const isLanguageSelected = document.querySelector('input[name="preferred_language"]:checked') !== null;
            
            // Only auto-progress if ALL three fields are selected
            if (isLocationSelected && isMeetingTypeSelected && isLanguageSelected) {
                nextStep(2);
            }
        }, 300); // 300ms delay to allow visual feedback to show
    }
    
    function checkAndAutoProgress(step) {
        // Add a small delay to allow the UI to update
        setTimeout(() => {
            const stepValidations = {
                1: () => {
                    return document.querySelector('input[name="location"]:checked') !== null &&
                           document.querySelector('input[name="meeting_type"]:checked') !== null &&
                           document.querySelector('input[name="preferred_language"]:checked') !== null;
                },
                2: () => document.querySelector('input[name="service_type"]:checked') !== null,
                3: () => document.querySelector('input[name="service"]:checked') !== null,
                4: () => {
                    return document.getElementById('full-name').value.trim() !== '' &&
                           document.getElementById('email').value.trim() !== '' &&
                           document.getElementById('phone').value.trim() !== '' &&
                           document.getElementById('enquiry-details').value.trim() !== '' &&
                           selectedDate !== null &&
                           selectedTime !== null;
                }
            };
            
            if (stepValidations[step] && stepValidations[step]()) {
                // All required fields for this step are filled, auto-progress
                if (step < 5) {
                    nextStep(step + 1);
                }
            }
        }, 300); // 300ms delay to allow visual feedback to show
    }
    
    function initializeCalendar() {
        const calendarGrid = document.getElementById('calendar-grid');
        const calendarTitle = document.getElementById('calendar-title');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');
        
        let currentDate = new Date();
        
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            calendarTitle.textContent = new Date(year, month).toLocaleDateString('en-US', { 
                month: 'long', 
                year: 'numeric' 
            });
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            let html = '<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;">';
            
            // Add day headers
            const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayHeaders.forEach(day => {
                html += `<div style="padding: 8px; text-align: center; font-weight: 600; color: var(--light-text); font-size: 12px;">${day}</div>`;
            });
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                html += '<div></div>';
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month, day);
                const isToday = date.toDateString() === new Date().toDateString();
                const isPast = date < new Date().setHours(0, 0, 0, 0);
                const isWeekend = date.getDay() === 0 || date.getDay() === 6;
                const isSelected = selectedDate && date.toDateString() === selectedDate.toDateString();
                
                let classes = 'calendar-day';
                if (isPast || isWeekend) classes += ' unavailable';
                if (isSelected) classes += ' selected';
                
                html += `<div class="${classes}" data-date="${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}">${day}</div>`;
            }
            
            html += '</div>';
            calendarGrid.innerHTML = html;
            
            // Add click handlers to calendar days
            document.querySelectorAll('.calendar-day:not(.unavailable)').forEach(dayEl => {
                dayEl.addEventListener('click', function() {
                    const dateStr = this.dataset.date;
                    const [year, month, day] = dateStr.split('-');
                    selectedDate = new Date(year, month - 1, day);
                    
                    document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    document.getElementById('selected-date').textContent = selectedDate.toLocaleDateString('en-AU');
                    document.getElementById('selected-date-input').value = dateStr;
                    
                    loadTimeSlots(dateStr);
                });
            });
        }
        
        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });
        
        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });
        
        renderCalendar();
    }
    
    function loadTimeSlots(date) {
        const timeSlotsContainer = document.getElementById('time-slots');
        
        // Determine timing based on selected service
        const selectedService = document.querySelector('input[name="service"]:checked');
        let timeSlots = [];
        
        if (selectedService && selectedService.closest('.service-option').dataset.timing === 'free') {
            // Free consultation: 12:00 PM - 3:00 PM, 15-minute intervals
            timeSlots = [
                '12:00 PM', '12:15 PM', '12:30 PM', '12:45 PM',
                '01:00 PM', '01:15 PM', '01:30 PM', '01:45 PM',
                '02:00 PM', '02:15 PM', '02:30 PM', '02:45 PM'
            ];
        } else if (selectedService && selectedService.closest('.service-option').dataset.timing === 'paid') {
            // Paid consultation: 10:00 AM - 5:00 PM, 30-minute intervals
            timeSlots = [
                '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
                '12:00 PM', '12:30 PM', '01:00 PM', '01:30 PM',
                '02:00 PM', '02:30 PM', '03:00 PM', '03:30 PM',
                '04:00 PM', '04:30 PM'
            ];
        } else {
            // Default time slots if no service selected
            timeSlots = [
                '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',
                '12:00 PM', '12:30 PM', '01:00 PM', '01:30 PM',
                '02:00 PM', '02:30 PM', '03:00 PM', '03:30 PM',
                '04:00 PM', '04:30 PM'
            ];
        }
        
        let html = '';
        timeSlots.forEach(time => {
            // You can add logic here to check if time slot is already booked
            // For now, all slots are available
            html += `<div class="time-slot" data-time="${time}">${time}</div>`;
        });
        
        timeSlotsContainer.innerHTML = html;
        
        // Add click handlers to time slots
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
                selectedTime = this.dataset.time;
                document.getElementById('selected-time-input').value = selectedTime;
            });
        });
    }
    
    
    function populateConfirmation() {
        // Populate confirmation details
        document.getElementById('confirm-name').textContent = document.getElementById('full-name').value;
        document.getElementById('confirm-email').textContent = document.getElementById('email').value;
        const countryCode = document.getElementById('country-code').value;
        const phoneNumber = document.getElementById('phone').value;
        document.getElementById('confirm-phone').textContent = `${countryCode} ${phoneNumber}`;
        
        // Get enquiry type
        const selectedEnquiry = document.querySelector('input[name="enquiry_type"]:checked');
        const enquiryText = selectedEnquiry ? 
            selectedEnquiry.closest('.enquiry-option').querySelector('.enquiry-title').textContent : '';
        
        const selectedService = document.querySelector('input[name="service"]:checked');
        const serviceText = selectedService ? 
            selectedService.closest('.service-option').querySelector('.service-title').textContent : '';
        
        // Combine enquiry and service for display
        document.getElementById('confirm-service').textContent = enquiryText + (serviceText ? ' - ' + serviceText : '');
        
        const selectedLocation = document.querySelector('input[name="location"]:checked');
        document.getElementById('confirm-location').textContent = selectedLocation ? 
            selectedLocation.closest('.location-option').querySelector('.location-name').textContent : '';
        
                    const selectedMeetingType = document.querySelector('input[name="meeting_type"]:checked');
                    document.getElementById('confirm-meeting-type').textContent = 
                        selectedMeetingType ? selectedMeetingType.closest('.meeting-option').querySelector('.meeting-title').textContent : '';
        
        document.getElementById('confirm-datetime').textContent = 
            `${selectedDate ? selectedDate.toLocaleDateString('en-AU') : ''} at ${selectedTime || ''}`;
        
        document.getElementById('confirm-details').textContent = document.getElementById('enquiry-details').value;
        
        // Show appropriate submit button based on service type
        const isPaid = selectedService && selectedService.value === 'paid-consultation';
        document.getElementById('submit-free').style.display = isPaid ? 'none' : 'inline-block';
        document.getElementById('submit-paid').style.display = isPaid ? 'inline-block' : 'none';
    }
    
    // Handle paid appointment submission
    document.getElementById('submit-paid').addEventListener('click', function() {
        // Here you would integrate with your payment system (Stripe, etc.)
        alert('Payment integration would be implemented here. For now, this will submit as a paid appointment.');
        document.getElementById('appointment-form').submit();
    });

    // Promo code validation
    let currentPromoCode = '';
    let currentDiscountAmount = 0;
    let currentFinalAmount = 0;

    document.getElementById('validate-promo-btn').addEventListener('click', function() {
        const promoCode = document.getElementById('promo-code').value.trim();
        const promoMessage = document.getElementById('promo-message');
        
        if (!promoCode) {
            showPromoMessage('Please enter a promo code.', 'error');
            return;
        }

        // Show loading state
        this.disabled = true;
        this.textContent = 'Validating...';

        // Get current service type for validation
        const selectedService = document.querySelector('input[name="service"]:checked');
        const serviceType = selectedService ? selectedService.value : 'tr';
        
        // Get base amount (you might want to calculate this based on service type)
        const baseAmount = getServicePrice(serviceType);

        fetch('{{ route("payments.validate-promo") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                promo_code: promoCode,
                enquiry_type: serviceType,
                amount: baseAmount
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentPromoCode = promoCode;
                currentDiscountAmount = data.discount_amount;
                currentFinalAmount = data.final_amount;
                
                showPromoMessage(data.message, 'success');
                
                // Update confirmation display if on confirmation step
                updateConfirmationDisplay();
            } else {
                showPromoMessage(data.message, 'error');
                resetPromoCode();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showPromoMessage('Error validating promo code. Please try again.', 'error');
        })
        .finally(() => {
            this.disabled = false;
            this.textContent = 'Apply';
        });
    });

    function showPromoMessage(message, type) {
        const promoMessage = document.getElementById('promo-message');
        promoMessage.textContent = message;
        promoMessage.className = 'promo-message ' + (type === 'success' ? 'success' : 'error');
        promoMessage.style.display = 'block';
        promoMessage.style.color = type === 'success' ? '#10b981' : '#ef4444';
    }

    function resetPromoCode() {
        currentPromoCode = '';
        currentDiscountAmount = 0;
        currentFinalAmount = 0;
        updateConfirmationDisplay();
    }

    function getServicePrice(serviceType) {
        const prices = {
            'tr': 150.00,
            'tourist': 100.00,
            'education': 200.00,
            'pr_complex': 300.00
        };
        return prices[serviceType] || 150.00;
    }

    function updateConfirmationDisplay() {
        // Update confirmation section with promo code info if visible
        const confirmationSection = document.getElementById('confirmation-section');
        if (confirmationSection && !confirmationSection.classList.contains('section-hidden')) {
            // Add promo code info to confirmation display
            let promoInfo = '';
            if (currentPromoCode) {
                promoInfo = `
                    <tr>
                        <th>Promo Code</th>
                        <td>${currentPromoCode} ($${currentDiscountAmount.toFixed(2)} off)</td>
                    </tr>
                `;
            }
            // You can add this to the confirmation table
        }
    }
});
</script>
@endsection
