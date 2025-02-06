# JobSpace - Modern Job Board Platform

![Laravel Version](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel)  
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.3-%2338B2AC?logo=tailwind-css)

A modern job board platform with real-time notifications, role-based access control, and an admin dashboard.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)

## Features
- Real-time notifications using Pusher
- Admin dashboard with analytics
- Role-based access control (Admin/Employer/User)
- Job management system
- Responsive Tailwind CSS design
- Livewire components
- Real Time notifications

## Requirements
- PHP 8.2+
- Composer 2.5+
- Node.js 18+ & npm 9+
- MySQL 8.0+
- Pusher account

## Installation

### Clone the Repository
```bash
git clone https://github.com/mustanjid/jobspacesrc.git
cd jobspacesrc

### Install Dependencies
- composer install
- npm install
- Set Up the Environment File
- Run Migrations and Seed the Database
- Compile Assets
### Project Folder Structure
jobspacesrc/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeds/
├── public/
│   ├── assets/
│   └── index.php
├── resources/
│   ├── views/
│   ├── js/
│   └── sass/
├── routes/
│   ├── api.php
│   └── web.php
├── storage/
├── tests/
├── .env
├── .gitignore
├── composer.json
├── package.json
└── README.md

