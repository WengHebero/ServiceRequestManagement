```markdown
# Service Request Management API

## Developed by
Weng, Van Con, and Suki

## Table of Contents
- [Introduction](#introduction)
- [Data Table Specification](#data-table-specification)
- [Microservice for Service Request Management](#microservice-for-service-request-management)
- [Running Locally](#running-locally)
- [Docker Deployment](#docker-deployment)
- [Updating the GitHub Repository](#updating-the-github-repository)

## Introduction
This is an API designed for managing service requests. It allows residents and tradies to create, view, and manage service bookings.

## Data Table Specification
| Field Name          | Description                                     | Mandatory / Optional | Manual / System Assigned | Specification                        | Sample Data           |
|---------------------|-------------------------------------------------|-----------------------|--------------------------|-------------------------------------|------------------------|
| booking_reference    | Booking Reference Number                         | Mandatory             | System Assigned          | Primary Key, String (6)            | “BK” + 4 digits        |
|                     |                                                 |                       |                          |                                     | BK0001, BK0002 …      |
| resident_id         | Resident ID                                     | Mandatory             | Manually Input           | Foreign Key of Resident Table       | Follow Resident Table   |
| tradie_id           | Tradie ID                                       | Mandatory             | Manually Input           | Foreign Key of Tradies Table        | Follow Tradies Table    |
| service_id          | Service ID                                      | Mandatory             | Manually Input           | Foreign Key of Service Management Table | Follow Service Management Table |
| booking_date        | Booking Date                                    | Mandatory             | Manually Input           | Date                                |                        |
| booking_session      | Boolean                                         | Mandatory             | Manually Input           | 0 – Morning, 1 – Afternoon          |                        |
| status              | Booking Status                                  | Mandatory             | System Assigned          | Character (2)                       | CR – create, CD – cancelled |

## Microservice for Service Request Management
1. **New Booking Creation**  
   - API method: `POST`  
   - Path: `/api/service-requests`

2. **Search Booking Information by Booking Reference Number**  
   - API method: `GET`  
   - Path: `/api/service-requests/booking_reference/[Booking Reference No]`  
   - User group: Resident or Admin

3. **Search Booking Information by Tradie ID**  
   - API method: `GET`  
   - Path: `/api/service-requests/tradie_id/[Tradie Id]`  
   - User group: Tradie or Admin

4. **Cancel Booking**  
   - API method: `PUT`  
   - Path: `/api/service-requests/booking_reference/[Booking Reference No]`  
   - Path: `/api/service-requests/tradie_id/[Tradie Id]`  
   - User group: Residents 

5. **Delete Booking**  
   - API method: `DELETE`  
   - Path: `/api/service-requests/booking_reference/[Booking Reference No]`  
   - Path: `/api/service-requests/tradie_id/[Tradie Id]`  
   - User group: Residents 

## Running Locally
To run the project locally, follow these steps:

1. **Clone the Repository**
   ```bash
   git clone https://github.com/WengHebero/ServiceRequestManagement.git
   cd ServiceRequestManagement
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup the Environment**
   - Rename `.env.example` to `.env` and set up your database configuration.

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```

## Docker Deployment
To deploy the application using Docker, follow these steps:

1. **Create a `docker-compose.yml` file** (if not already present):
   ```yaml
   version: '3.8'

   services:
     app:
       build:
         context: .
         dockerfile: Dockerfile
       ports:
         - "8000:8000"
       volumes:
         - .:/var/www
       networks:
         - app-network

   networks:
     app-network:
       driver: bridge
   ```

2. **Build the Docker Image**
   ```bash
   docker-compose build
   ```

3. **Run the Docker Container**
   ```bash
   docker-compose up -d
   ```

4. **Access the Application**
   - Open your browser and navigate to `http://localhost:8000`.

## Updating the GitHub Repository
To update the GitHub repository with new changes:

1. **Stage Changes**
   ```bash
   git add .
   ```

2. **Commit Changes**
   ```bash
   git commit -m "Your commit message"
   ```

3. **Push Changes**
   ```bash
   git push origin main
   ```
