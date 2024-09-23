# 🛠️ API Design For Service Management

Developed by **Weng**, **Van Con**, and **Suki**

## 📋 Data Table Specification for Service Request Management

| **Field Name**        | **Description**            | **Mandatory / Optional** | **Manual / System Assigned** | **Specification**       | **Sample Data**          |
|-----------------------|----------------------------|--------------------------|------------------------------|-------------------------|--------------------------|
| `booking_reference`    | Booking Reference Number   | Mandatory                 | System Assigned               | Primary Key, String (6)  | BK0001, BK0002 …          |
| `resident_id`          | Resident ID                | Mandatory                 | Manually Input                | Foreign Key              | Follow Resident Table     |
| `tradie_id`            | Tradie ID                  | Mandatory                 | Manually Input                | Foreign Key              | Follow Tradies Table      |
| `service_id`           | Service ID                 | Mandatory                 | Manually Input                | Foreign Key              | Follow Service Management |
| `booking_date`         | Booking Date               | Mandatory                 | Manually Input                | Date                     | 2024-09-30                |
| `booking_session`      | Booking Session            | Mandatory                 | Manually Input                | Boolean (0 – Morning, 1 – Afternoon) | 0, 1 |
| `status`               | Booking Status             | Mandatory                 | System Assigned               | Character (2)            | CR – Create, CD – Cancelled |

## 🧱 Microservice for Service Request Management

### 1️⃣ New Booking Creation 
- **API method**: POST
- **Path**: `/api/service-requests`
  
### 2️⃣ Search Booking Information by Booking Reference Number 
- **API method**: GET
- **Path**: `/api/service-requests/booking_reference/[Booking Reference No]`
- **User group**: Resident or Admin

### 3️⃣ Search Booking Information by Tradie ID  
- **API method**: GET
- **Path**: `/api/service-requests/tradie_id/[Tradie ID]`
- **User group**: Tradie or Admin

### 4️⃣ Cancel Booking (Update status)
- **API method**: PUT
- **Path**: `/api/service-requests/booking_reference/[Booking Reference No]`
- **Path**: `/api/service-requests/tradie_id/[Tradie ID]`
- **User group**: Residents

### 5️⃣ Delete Booking 
- **API method**: DELETE
- **Path**: `/api/service-requests/booking_reference/[Booking Reference No]`
- **Path**: `/api/service-requests/tradie_id/[Tradie ID]`
- **User group**: Residents

## 🚀 How to Run the API
1. Clone the repository:  
   ```bash
   git clone https://github.com/WengHebero/ServiceRequestManagement.git
