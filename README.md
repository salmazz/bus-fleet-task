# Bus Management System API

## Table of Contents

- [Introduction](#introduction)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
    - [1. Available Seat](#1-available-seats)
    - [2. BookSeat](#2-book-seat)
- [Design Patterns](#design-patterns)
- [Docker](#docker)
- [Authentication](#authentication)
- [Postman Collection](#postman-collection)

## Introduction

This project provides a set of APIs for managing a mini bus reservation system. It include

## Database Schema

### Entities and Attributes

- `users`: id, name, email, password,email_verified_at
- `buses `: id, vehicle_number', 'capacity
- `trips` : id, bus_id
- `stations` : id, name
- `trip_stations` : id,trip_id,station_id,arrival_time, order
- `booking` : id, user_id, trip_id, trip_station_from_id, trip_station_to_id, seat_number 

## API Endpoints

## Path Table

| Method | Path                     | Description     |
|--------|--------------------------|-----------------|
| POST   | /api/book-seat           | Book Seat       |
| GET    | /api/available-seats/    | Available Seats |

### 2. Book Seat

Endpoint: `/api/book-seat`

Description: Book Seat with send data for that and ensure for no duplicate for the seat twice


**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- 
  **Parameter:**
```json
{
  "trip_station_from_id": 1,
  "trip_station_to_id": 4,
  "date": "2024-04-25",
  "trip_id": 1,
  "seat_number": 1
}
```
**Request Body:**
```json
{
    "code": 200,
    "message": "Booked successfully",
    "data": {
        "booking": {
            "user_id": 2,
            "trip_id": 1,
            "trip_station_from_id": 1,
            "trip_station_to_id": 2,
            "seat_number": 3,
            "updated_at": "2024-04-21T01:00:25.000000Z",
            "created_at": "2024-04-21T01:00:25.000000Z",
            "id": 2
        }
    }
}
``` 

### 2. Check Availability

Endpoint: `/api/available-seats`

Description: Get the available seats with trip information when enter the start and end city with date.

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Parameter:**
```json
{
  "trip_station_from_id": 1,
  "trip_station_to_id": 4,
  "date": "2024-04-25",
  "trip_id": 1
}
```

**Request Body:**
```json

{
    "code": 200,
    "message": "Available seats retrieved successfully",
    "data": {
        "available_seats": [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12
        ]
    }
}
```

## Postman Collection

To facilitate testing and integration, provide a Postman collection that includes sample requests for each API endpoint, along with expected responses. This will help users understand how to interact with your API.

[Link to Postman Collection]https://elements.getpostman.com/redirect?entityId=6208228-fb33e9ef-8780-46b3-b343-0331edc1da37&entityType=collection) - Update this link once you create the collection.

Please Add in Booking Env

- app_url: with your app link
- In Every Api Body have example about request

## Design Pattern
Using Repository Design pattern with Service Layer


# Requirements
- PHP 8.2
- MySQL

## Getting Started

1. Clone this repository.
2. Install the required dependencies.
3. Set up your database and configure the `.env` file.
4. Migrate and seed the database.
5. Run the application.
6. Run The Jobs

## Clone
Clone this repo to your local machine using https://github.com/salmazz/bus-fleet-mangment
and run
```
git clone https://github.com/salmazz/bus-fleet-mangment
cd bus-fleet-mangment
cp .env.example .env
composer install
composer dumpautoload
```

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
```

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate --seed
 ````

## Run Tests
```bash
 ./vendor/bin/sail artisan test
 ````
