# 🛠️ API Design For Service Management

Developed by **Weng**, **Van Con**, and **Suki**

## 📊 Data Table Specification for Service Request Management

| Field Name         | Description                     | Mandatory / Optional | Manual / System Assigned | Specification          | Sample Data         |
|--------------------|---------------------------------|----------------------|--------------------------|------------------------|---------------------|
| `booking_reference`| Booking Reference Number        | Mandatory            | System Assigned           | Primary Key, String (6) | `BK0001`, `BK0002`  |
| `resident_id`      | Resident ID                     | Mandatory            | Manually Input            | Foreign Key of Resident Table | Follows Resident Table |
| `tradie_id`        | Tradie ID                       | Mandatory            | Manually Input            | Foreign Key of Tradies Table | Follows Tradies Table |
| `service_id`       | Service ID                      | Mandatory            | Manually Input            | Foreign Key of Service Management Table | Follows Service Management Table |
| `booking_date`     | Booking Date                    | Mandatory            | Manually Input            | Date                   | `2024-09-30`        |
| `booking_session`  | Booking Session (Morning/Afternoon) | Mandatory            | Manually Input            | Boolean (0 = Morning, 1 = Afternoon) | 0 or 1              |
| `status`           | Booking Status                  | Mandatory            | System Assigned           | String (2 characters)  | `CR` (Created), `CD` (Cancelled) |

---

## 🛠️ Microservice Functionality

### 1. Create a New Service Request 📅
- **API Method**: `POST`
- **Path**: `/api/service-requests`
- **Body**:
  ```json
  {
      "resident_id": "resident1",
      "tradie_id": "tradie1",
      "service_id": "service1",
      "booking_date": "2024-09-30",
      "booking_session": true
  }
  ```
- **Response**: Creates a new booking and returns the booking details with a generated `booking_reference`.

### 2. Retrieve Booking by Booking Reference 🔍
- **API Method**: `GET`
- **Path**: `/api/service-requests/booking_reference/{Booking Reference}`
- **User Group**: Resident or Admin
- **Response**: Returns the booking information for the specified booking reference.

### 3. Retrieve Booking by Tradie ID 🛠️
- **API Method**: `GET`
- **Path**: `/api/service-requests/tradie_id/{Tradie ID}`
- **User Group**: Tradie or Admin
- **Response**: Returns all bookings associated with a given tradie.

### 4. Cancel a Booking (Update Status to "Cancelled") ❌
- **API Method**: `PUT`
- **Path**: `/api/service-requests/booking_reference/{Booking Reference}`
- **Body**:
  ```json
  {
      "status": "Cancelled"
  }
  ```
- **Response**: Updates the booking status to `Cancelled`.

### 5. Delete a Booking 🗑️
- **API Method**: `DELETE`
- **Path**: `/api/service-requests/booking_reference/{Booking Reference}`
- **Response**: Deletes the specified booking.

---

## 💻 How to Run Locally

### Prerequisites:
Ensure you have the following tools installed on your machine:
- PHP (>= 7.4)
- Composer
- SQLite or MySQL (or your preferred database)
- Git

### Step-by-Step Guide:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/WengHebero/ServiceRequestManagement.git
   cd ServiceRequestManagement
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Set Up Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Configure the database in `.env`.

4. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

5. **Serve the Application**:
   ```bash
   php artisan serve
   ```

   The application will now be running on `http://127.0.0.1:8000`.

---

## 🧪 API Testing with Postman

### Example Requests:

- **Create a Booking** (`POST`):
   ```json
   {
      "resident_id": "resident1",
      "tradie_id": "tradie1",
      "service_id": "service1",
      "booking_date": "2024-09-30",
      "booking_session": true
   }
   ```

- **Get All Bookings** (`GET`):
   ```bash
   GET http://127.0.0.1:8000/api/service-requests
   ```

- **Update Booking Status** (`PUT`):
   ```json
   {
       "status": "Completed"
   }
   ```

- **Delete a Booking** (`DELETE`):
   ```bash
   DELETE http://127.0.0.1:8000/api/service-requests/booking_reference/BK0001
   ```
