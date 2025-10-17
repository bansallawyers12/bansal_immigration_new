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
/* Modern Design System Variables - Matching Website Colors */
:root {
    --primary-blue: #1e3a8a;
    --primary-blue-light: #3b82f6;
    --secondary-blue: #2563eb;
    --light-blue: #dbeafe;
    --dark-blue: #1e40af;
    --light-gray: #f8fafc;
    --border-gray: #e2e8f0;
    --text-gray: #1f2937;
    --light-text: #6b7280;
    --hero-text: #ffffff;
    --success-color: #10b981;
    --error-color: #ef4444;
    --accent-gold: #f59e0b;
    --accent-orange: #f97316;
    --accent-green: #059669;
    --accent-purple: #7c3aed;
    --accent-red: #dc2626;
    --white: #ffffff;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

/* Typography - Matching Website Font */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: var(--text-gray);
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Hero Section */
.appointment-hero {
    height: 400px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-background-image {
    position: absolute;
    inset: 0;
    background: url('{{asset('img/appointment-hero.jpeg')}}') center/cover no-repeat;
    z-index: 1;
    transition: transform 0.8s ease;
}

.appointment-hero:hover .hero-background-image {
    transform: scale(1.05);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.3s ease-out, transform 0.3s ease-out;
}

.appointment-hero:hover .hero-content {
    opacity: 1;
    transform: translateY(0);
}

.hero-cta {
    margin-top: 2rem;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: white;
    text-decoration: none;
    padding: 16px 32px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hero-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.hero-btn:hover::before {
    left: 100%;
}

.hero-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(27, 77, 137, 0.4);
    background: linear-gradient(135deg, var(--primary-blue-light), var(--primary-blue));
}

.hero-btn:active {
    transform: translateY(-1px);
}

.btn-text {
    position: relative;
    z-index: 1;
}

.btn-icon {
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease;
    font-size: 20px;
}

.hero-btn:hover .btn-icon {
    transform: translateX(5px);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.hero-btn:hover {
    animation: none;
}

/* Container System - Matching Website */
.appointment-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

@media (min-width: 640px) {
    .appointment-container {
        padding: 0 1.5rem;
    }
}

@media (min-width: 1024px) {
    .appointment-container {
        padding: 0 2rem;
    }
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

/* Card Styles - Matching Website */
.appointment-card {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-gray);
    overflow: hidden;
    margin-bottom: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}

.appointment-card:hover {
    box-shadow: var(--shadow-xl);
    transform: translateY(-2px);
}

.appointment-card-body {
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

@media (min-width: 768px) {
    .appointment-card-body {
        padding: 2.5rem;
    }
}

/* Step Navigation - Modern Design */
.appointment-steps {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--light-gray);
    border-radius: 12px;
    border: 1px solid var(--border-gray);
}

.step {
    display: flex;
    align-items: center;
    margin: 0 0.5rem;
    position: relative;
}

.step-number {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--white);
    color: var(--light-text);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-right: 0.75rem;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 2px solid var(--border-gray);
    box-shadow: var(--shadow-sm);
}

.step.active .step-number {
    background: var(--primary-blue);
    color: var(--white);
    transform: scale(1.05);
    border-color: var(--primary-blue);
    box-shadow: var(--shadow-md);
}

.step.completed .step-number {
    background: var(--success-color);
    color: var(--white);
    border-color: var(--success-color);
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

.step.completed .step-text {
    color: var(--success-color);
}

/* Form Elements - Modern Design */
.form-group {
    margin-bottom: 1.5rem;
}

.form-section {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-gray);
    font-size: 14px;
}

.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-gray);
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
    font-family: inherit;
    box-sizing: border-box;
    background: var(--white);
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    background: var(--white);
}

.form-input:hover, .form-select:hover, .form-textarea:hover {
    border-color: var(--primary-blue-light);
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

/* Timezone Indicator */
.timezone-indicator {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
}

.timezone-icon {
    font-size: 20px;
}

.timezone-text {
    flex: 1;
    font-size: 14px;
    line-height: 1.4;
}

.timezone-text strong {
    font-weight: 700;
    font-size: 15px;
}

@media (max-width: 768px) {
    .timezone-indicator {
        padding: 10px 14px;
    }
    
    .timezone-text {
        font-size: 13px;
    }
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

/* Buttons - Modern Design */
.appointment-btn {
    background: var(--primary-blue);
    color: var(--white);
    border: 2px solid var(--primary-blue);
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.appointment-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: var(--primary-blue-light);
    border-color: var(--primary-blue-light);
}

.appointment-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
    background: var(--light-text);
    border-color: var(--light-text);
}

.appointment-btn-secondary {
    background: transparent;
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
}

.appointment-btn-secondary:hover {
    background: var(--primary-blue);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
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

/* Information Section - Modern Design */
.info-section {
    background: var(--light-gray);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid var(--border-gray);
    box-shadow: var(--shadow-sm);
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

/* Sidebar - Modern Design */
.appointment-sidebar {
    background: var(--white);
    border-radius: 16px;
    padding: 0;
    overflow: hidden;
    flex: 1;
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-gray);
}

.sidebar-section {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-gray);
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
    color: var(--white);
    text-align: center;
    padding: 2rem 1.5rem;
    border-radius: 16px 16px 0 0;
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
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0;
    color: var(--white);
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 0.5px;
}

.company-tagline {
    font-size: 0.875rem;
    margin: 0;
    color: rgba(255,255,255,0.95);
    font-style: italic;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.sidebar-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--primary-blue);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.title-icon {
    font-size: 1.125rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--white);
    border-radius: 12px;
    border: 1px solid var(--border-gray);
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-blue);
}

.contact-icon {
    font-size: 1.25rem;
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: var(--white);
    border-radius: 8px;
}

.contact-details {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.contact-label {
    font-size: 0.75rem;
    color: var(--light-text);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 0.875rem;
    color: var(--text-gray);
    font-weight: 600;
}

.hours-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.hours-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1rem;
    background: var(--white);
    border-radius: 8px;
    border: 1px solid var(--border-gray);
    transition: all 0.3s ease;
}

.hours-item:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.hours-item.closed {
    opacity: 0.6;
    background: var(--light-gray);
}

.hours-days {
    font-weight: 600;
    color: var(--text-gray);
    font-size: 0.875rem;
}

.hours-time {
    font-weight: 500;
    color: var(--primary-blue);
    font-size: 0.8125rem;
}

.locations-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.location-item {
    padding: 1rem;
    background: var(--white);
    border-radius: 12px;
    border: 1px solid var(--border-gray);
    transition: all 0.3s ease;
}

.location-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-blue);
}

.location-header {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    margin-bottom: 0.5rem;
}

.location-icon {
    font-size: 1.125rem;
}

.location-name {
    font-weight: 700;
    color: var(--primary-blue);
    font-size: 1rem;
}

.location-address {
    font-size: 0.8125rem;
    color: var(--light-text);
    line-height: 1.4;
    margin-left: 1.75rem;
}

.features-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem;
    background: var(--white);
    border-radius: 8px;
    border: 1px solid var(--border-gray);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateX(4px);
    box-shadow: var(--shadow-sm);
    border-color: var(--accent-green);
}

.feature-icon {
    font-size: 1rem;
    color: var(--accent-green);
}

.feature-text {
    font-size: 0.875rem;
    color: var(--text-gray);
    font-weight: 500;
}

.stats-section {
    background: linear-gradient(135deg, var(--accent-orange), #f97316);
    color: var(--white);
}

.stats-section .sidebar-title {
    color: var(--white);
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.stat-item {
    text-align: center;
    padding: 0.75rem 0.5rem;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    background: rgba(255,255,255,0.3);
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 0.1875rem;
}

.stat-label {
    font-size: 0.625rem;
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

/* Inline Field Error Styling */
.field-error {
    display: none;
    margin-top: 8px;
    padding: 10px 12px;
    background-color: #fef2f2;
    border-left: 4px solid var(--error-color);
    border-radius: 6px;
    font-size: 14px;
    color: var(--error-color);
    animation: slideDown 0.3s ease;
}

.field-error.show {
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.error-icon {
    font-size: 16px;
    flex-shrink: 0;
    line-height: 1.4;
}

.error-text {
    flex: 1;
    line-height: 1.4;
}

/* Error State for Input Fields */
.form-input.error,
.form-textarea.error,
.form-select.error {
    border-color: var(--error-color);
    background-color: #fef2f2;
}

.form-input.error:focus,
.form-textarea.error:focus,
.form-select.error:focus {
    border-color: var(--error-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Error State for Radio Button Groups */
.location-options.error,
.meeting-options.error,
.language-options.error,
.service-selection-options.error,
.service-options.error {
    border: 2px solid var(--error-color);
    border-radius: 12px;
    padding: 12px;
    background-color: #fef2f2;
}

/* Success State (optional for good UX) */
.form-input.success,
.form-textarea.success {
    border-color: var(--success-color);
}

/* Error Animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design - Mobile First */
@media (max-width: 768px) {
    .appointment-grid {
        flex-direction: column;
    }
    
    .appointment-left,
    .appointment-right {
        flex: 1 1 auto;
    }
    
    .appointment-hero {
        height: 300px;
    }
    
    .hero-btn {
        padding: 14px 28px;
        font-size: 16px;
    }
    
    .appointment-container {
        padding: 0 1rem;
    }
    
    .appointment-card-body {
        padding: 1.5rem;
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
        padding: 1rem;
        gap: 0.5rem;
    }
    
    .step {
        flex-shrink: 0;
        margin: 0 0.25rem;
    }
    
    .step-text {
        display: none;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        margin-right: 0;
    }
}

@media (max-width: 480px) {
    .appointment-card-body {
        padding: 1.25rem;
    }
    
    .service-header {
        flex-direction: column;
        text-align: center;
    }
    
    .service-image {
        margin-right: 0;
        margin-bottom: 0.75rem;
    }
    
    .appointment-hero {
        height: 250px;
    }
    
    .hero-btn {
        padding: 12px 24px;
        font-size: 14px;
    }
    
    .hero-cta {
        margin-top: 1rem;
    }
    
    .step-number {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }
    
    .appointment-steps {
        padding: 0.75rem;
    }
}
</style>

<!-- Hero Section -->
<div class="appointment-hero">
    <div class="hero-background-image"></div>
    <div class="hero-content">
        <div class="hero-cta">
            <a href="#appointment-form" class="hero-btn">
                <span class="btn-text">Book Your Consultation</span>
                <span class="btn-icon">→</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-16" style="background-color: var(--light-gray);">
    <div class="appointment-container">
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
                    <input type="hidden" name="enquiry_type" id="enquiry-type-input">
                    <input type="hidden" name="location" id="location-input">
                    <input type="hidden" name="meeting_type" id="meeting-type-input">
                    <input type="hidden" name="preferred_language" id="preferred-language-input">
                    <input type="hidden" name="service_type" id="service-type-input">
                    <input type="hidden" name="specific_service" id="service-input">
                            
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
                                    <div class="field-error" id="location-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
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
                                        <div class="meeting-option" data-meeting="video-call" id="video-call-option" style="opacity: 0.5; pointer-events: none;">
                                            <input type="radio" name="meeting_type" value="video-call" id="meeting-video" disabled>
                                            <div class="meeting-icon">📹</div>
                                            <div class="meeting-title">
                                                Video Call 
                                                <span style="color: var(--accent-orange); font-size: 14px; margin-left: 4px;">★</span>
                                            </div>
                                            <div class="meeting-subtitle">
                                                Online consultation
                                                <span style="color: var(--accent-orange); font-size: 11px; display: block; margin-top: 4px;">
                                                    * Available for paid appointments only
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-error" id="meeting-type-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
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
                                    <div class="field-error" id="preferred-language-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
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
                                                <div class="service-selection-title">Complex matters: ART, Protection visa, Federal Case</div>
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
                                    <div class="field-error" id="service-type-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
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
                                            <strong>In-depth professional consultation:</strong> Comprehensive case analysis, detailed migration strategy, complex visa applications, ART appeals, visa cancellations, protection visas, and personalized action plans. Suitable for overseas applicants and complex cases.
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
                                <div class="field-error" id="service-error" style="display: none;">
                                    <span class="error-icon">⚠️</span>
                                    <span class="error-text"></span>
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
                                        <div class="field-error" id="full-name-error" style="display: none;">
                                            <span class="error-icon">⚠️</span>
                                            <span class="error-text"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" id="email" name="email" class="form-input" required>
                                        <div class="field-error" id="email-error" style="display: none;">
                                            <span class="error-icon">⚠️</span>
                                            <span class="error-text"></span>
                                        </div>
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
                                    <div class="field-error" id="phone-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-details">Details of Enquiry</label>
                                    <textarea id="enquiry-details" name="enquiry_details" class="form-textarea" placeholder="Please provide detailed information about your enquiry..." required></textarea>
                                    <div class="field-error" id="enquiry-details-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
                                    </div>
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
                                    
                                    <!-- NEW: Timezone Indicator -->
                                    <div class="timezone-indicator" id="timezone-indicator" style="display: none;">
                                        <span class="timezone-icon">🕐</span>
                                        <span class="timezone-text" id="timezone-text">
                                            All times shown in <strong>Adelaide Time (ACST)</strong>
                                        </span>
                                    </div>
                                    
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
                                    <div class="field-error" id="appointment-date-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
                                    </div>
                                    <div class="field-error" id="appointment-time-error" style="display: none;">
                                        <span class="error-icon">⚠️</span>
                                        <span class="error-text"></span>
                                    </div>
                                    <input type="hidden" id="selected-date-input" name="appointment_date">
                                    <input type="hidden" id="selected-time-input" name="appointment_time">
                                </div>

                                <div class="text-center" style="margin-top: 24px;">
                                    <button type="button" class="appointment-btn appointment-btn-secondary" onclick="prevStep(3)" style="margin-right: 12px;">Previous</button>
                                    <button type="button" class="appointment-btn" onclick="nextStep(5)">Review & Confirm</button>
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
                                        <span class="feature-text">Over 10+ years experience</span>
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
                                        <div class="stat-number">10,000+</div>
                                        <div class="stat-label">Clients</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">10+</div>
                                        <div class="stat-label">Years Experience</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">95%</div>
                                        <div class="stat-label">Success Rate</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">100%</div>
                                        <div class="stat-label">Licensed Agents</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Information Section -->
        <div class="info-section" style="margin-top: 40px;">
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
                            <h6>Consultation Fee:</h6> Our fee is $150 for most types of migration advice. Please select this option if your matter is complicated and includes Administrative Review Tribunal (ART) cases, Visa cancellations, or Protection visas, etc. If you believe it will require more than 10 minutes to discuss, please select this paid option.
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
    </div>
</section>

<script>
// Modern appointment booking JavaScript
// Make these global so external JS files can access them
window.selectedDate = null;
window.selectedTime = null;

document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    
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
                
                // Show/hide and enable/disable video call option based on service
                const videoCallOption = document.querySelector('.meeting-option[data-meeting="video-call"]');
                const videoCallRadio = document.getElementById('meeting-video');
                
                if (videoCallOption && videoCallRadio) {
                    const isPaidService = this.dataset.service === 'paid-consultation' || 
                                         this.dataset.service === 'overseas-enquiry';
                    
                    if (isPaidService) {
                        // Enable video call for paid services
                        videoCallOption.style.opacity = '1';
                        videoCallOption.style.pointerEvents = 'auto';
                        videoCallRadio.disabled = false;
                    } else {
                        // Disable video call for free services
                        videoCallOption.style.opacity = '0.5';
                        videoCallOption.style.pointerEvents = 'none';
                        videoCallRadio.disabled = true;
                        
                        // If video call was selected, deselect it
                        if (videoCallRadio.checked) {
                            videoCallRadio.checked = false;
                            videoCallOption.classList.remove('selected');
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
                       window.selectedDate !== null &&
                       window.selectedTime !== null;
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
                           window.selectedDate !== null &&
                           window.selectedTime !== null;
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
                const isSelected = window.selectedDate && date.toDateString() === window.selectedDate.toDateString();
                
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
                    window.selectedDate = new Date(year, month - 1, day);
                    
                    document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    document.getElementById('selected-date').textContent = window.selectedDate.toLocaleDateString('en-AU');
                    document.getElementById('selected-date-input').value = dateStr;
                    
                    loadTimeSlots(dateStr);
                });
            });
            
            // Check for blocked dates and mark them as unavailable
            checkBlockedDates();
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
    
    function checkBlockedDates() {
        // Get current month dates
        const calendarDays = document.querySelectorAll('.calendar-day:not(.unavailable)');
        const selectedServiceType = document.querySelector('input[name="service_type"]:checked');
        
        let enquiryType = 'tr'; // default
        
        // Map service types to enquiry types
        if (selectedServiceType) {
            const serviceTypeMapping = {
                'permanent-residency': 'pr_complex',
                'temporary-residency': 'tr',
                'jrp-skill-assessment': 'tr',
                'tourist-visa': 'tourist',
                'education-visa': 'education',
                'complex-matters': 'pr_complex',
                'visa-cancellation': 'pr_complex',
                'international-migration': 'pr_complex'
            };
            enquiryType = serviceTypeMapping[selectedServiceType.value] || 'tr';
        }
        
        // Check each date for blocked times
        calendarDays.forEach(dayEl => {
            const dateStr = dayEl.dataset.date;
            
            // Get selected location
            const selectedLocation = document.querySelector('input[name="location"]:checked');
            const location = selectedLocation ? selectedLocation.value : 'melbourne';
            
            // Check if this date has any available slots
            fetch(`/api/appointments/available-slots?date=${dateStr}&enquiry_type=${enquiryType}&location=${location}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success || !data.available_slots || data.available_slots.length === 0) {
                        // No available slots, mark as unavailable
                        dayEl.classList.add('unavailable');
                        dayEl.style.opacity = '0.3';
                        dayEl.style.cursor = 'not-allowed';
                    }
                })
                .catch(error => {
                    console.error('Error checking blocked dates:', error);
                });
        });
    }
    
    function loadTimeSlots(date) {
        const timeSlotsContainer = document.getElementById('time-slots');
        
        // Show loading state
        timeSlotsContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">Loading available time slots...</div>';
        
        // Determine enquiry type based on selected service
        const selectedService = document.querySelector('input[name="service"]:checked');
        const selectedServiceType = document.querySelector('input[name="service_type"]:checked');
        
        let enquiryType = 'tr'; // default
        
        // Map service types to enquiry types
        if (selectedServiceType) {
            const serviceTypeMapping = {
                'permanent-residency': 'pr_complex',
                'temporary-residency': 'tr',
                'jrp-skill-assessment': 'tr',
                'tourist-visa': 'tourist',
                'education-visa': 'education',
                'complex-matters': 'pr_complex',
                'visa-cancellation': 'pr_complex',
                'international-migration': 'pr_complex'
            };
            enquiryType = serviceTypeMapping[selectedServiceType.value] || 'tr';
        }
        
        // Get selected location
        const selectedLocation = document.querySelector('input[name="location"]:checked');
        const location = selectedLocation ? selectedLocation.value : 'melbourne';
        
        // Call API to get available time slots
        fetch(`/api/appointments/available-slots?date=${date}&enquiry_type=${enquiryType}&location=${location}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.available_slots && data.available_slots.length > 0) {
                    let html = '';
                    data.available_slots.forEach(slot => {
                        html += `<div class="time-slot" data-time="${slot.time}">${slot.display}</div>`;
                    });
                    timeSlotsContainer.innerHTML = html;
                    
                    // Add click handlers to time slots
                    document.querySelectorAll('.time-slot').forEach(slot => {
                        slot.addEventListener('click', function() {
                            document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                            this.classList.add('selected');
                            window.selectedTime = this.dataset.time;
                            document.getElementById('selected-time-input').value = window.selectedTime;
                        });
                    });
                } else {
                    timeSlotsContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">No available time slots for this date. Please select another date.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading time slots:', error);
                timeSlotsContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: #ef4444;">Error loading time slots. Please try again.</div>';
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
            `${window.selectedDate ? window.selectedDate.toLocaleDateString('en-AU') : ''} at ${window.selectedTime || ''}`;
        
        document.getElementById('confirm-details').textContent = document.getElementById('enquiry-details').value;
        
        // Show appropriate submit button based on service type
        const isPaid = selectedService && selectedService.value === 'paid-consultation';
        document.getElementById('submit-free').style.display = isPaid ? 'none' : 'inline-block';
        document.getElementById('submit-paid').style.display = isPaid ? 'inline-block' : 'none';
    }
    
    // Form submission handlers moved to separate files for better organization

    // JavaScript functionality moved to separate files for better organization

    // Update timezone display based on selected location
    function updateTimezoneDisplay() {
        const selectedLocation = document.querySelector('input[name="location"]:checked');
        const timezoneIndicator = document.getElementById('timezone-indicator');
        const timezoneText = document.getElementById('timezone-text');
        
        if (selectedLocation) {
            const location = selectedLocation.value;
            
            if (location === 'adelaide') {
                timezoneText.innerHTML = 'All times shown in <strong>Adelaide Time (ACST)</strong>';
            } else if (location === 'melbourne') {
                timezoneText.innerHTML = 'All times shown in <strong>Melbourne Time (AEST)</strong>';
            }
            
            timezoneIndicator.style.display = 'flex';
        }
    }

    // Add event listeners to location options
    document.querySelectorAll('.location-option').forEach(option => {
        option.addEventListener('click', function() {
            setTimeout(updateTimezoneDisplay, 100);
        });
    });

    // Also update when radio button is clicked directly
    document.querySelectorAll('input[name="location"]').forEach(radio => {
        radio.addEventListener('change', updateTimezoneDisplay);
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

<!-- Include separate JavaScript files for better organization -->
<script src="{{ asset('js/appointment-form-errors.js') }}"></script>
<script src="{{ asset('js/appointment-form-steps.js') }}"></script>
<script src="{{ asset('js/appointment-form-submission.js') }}"></script>

@endsection
