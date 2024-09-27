```markdown
# 🛠️ API Design For Service Management

Developed by **Weng**, **Van Cong**, and **Suki**

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
- Docker (optional for containerized deployment)

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

4. **Configure Database**:
   - If you're using **SQLite**, follow these steps:
     1. Create an SQLite database file:
        ```bash
        touch /full/path/to/database.sqlite
        ```
     2. Update your `.env` file as follows:
        ```bash
        DB_CONNECTION=sqlite
        DB_DATABASE=/full/path/to/database.sqlite
        ```
   - If you're using **MySQL**, configure your `.env` file like this:
     ```bash
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```
     Make sure you create the MySQL database:
     ```bash
     mysql -u your_database_username -p
     CREATE DATABASE your_database_name;
     ```

5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

6. **Start the Development Server**:
   ```bash
   php artisan serve
   ```

   The application will now be running on `http://127.0.0.1:8000`.

---

## 🐳 How to Deploy with Docker

### Step-by-Step Guide:

1. **Ensure Docker and Docker Compose are Installed**:
   Make sure you have [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/) installed on your machine.

2. **Create a `docker-compose.yml` File**:
   Create a file named `docker-compose.yml` in the root of your project with the following content:
   ```yaml
   version: '3.8'
   services:
     app:
       image: php:8.1-fpm
       container_name: app
       volumes:
         - .:/var/www/html
       networks:
         - app-network
     db:
       image: mysql:5.7
       container_name: db
       restart: always
       environment:
         MYSQL_ROOT_PASSWORD: your_root_password
         MYSQL_DATABASE: your_database_name
         MYSQL_USER: your_database_username
         MYSQL_PASSWORD: your_database_password
       networks:
         - app-network
   networks:
     app-network:
       driver: bridge
   ```

3. **Build and Start the Containers**:
   Run the following command in your terminal:
   ```bash
   docker-compose up -d --build
   ```

4. **Access the Application**:
   The application should now be accessible at `http://localhost` or the port specified in your `docker-compose.yml`.

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
