Berikut adalah dokumentasi dalam bentuk Markdown untuk penggunaan CRUD API:

markdown
Copy code
# API Documentation

## Departments
### 1. Get All Departments
```bash
curl -X GET http://127.0.0.1:8000/api/departments \
     -H "Accept: application/json"
2. Create a New Department
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/departments \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Cardiology",
           "description": "Heart-related department"
         }'
3. Get a Department by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/departments/1 \
     -H "Accept: application/json"
4. Update a Department
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/departments/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Updated Department",
           "description": "Updated Description"
         }'
5. Delete a Department
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/departments/1 \
     -H "Accept: application/json"
Categories
1. Get All Categories
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/categories \
     -H "Accept: application/json"
2. Create a New Category
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/categories \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Emergency",
           "description": "Emergency services category"
         }'
3. Get a Category by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/categories/1 \
     -H "Accept: application/json"
4. Update a Category
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/categories/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Updated Category",
           "description": "Updated Description"
         }'
5. Delete a Category
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/categories/1 \
     -H "Accept: application/json"
Doctors
1. Get All Doctors
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/doctors \
     -H "Accept: application/json"
2. Create a New Doctor
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/doctors \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Dr. John Doe",
           "specialization": "Cardiology",
           "phone": "123456789",
           "email": "johndoe@example.com"
         }'
3. Get a Doctor by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/doctors/1 \
     -H "Accept: application/json"
4. Update a Doctor
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/doctors/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Updated Doctor",
           "specialization": "Updated Specialization",
           "phone": "987654321",
           "email": "updated@example.com"
         }'
5. Delete a Doctor
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/doctors/1 \
     -H "Accept: application/json"
Patients
1. Get All Patients
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/patients \
     -H "Accept: application/json"
2. Create a New Patient
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/patients \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Jane Doe",
           "age": 30,
           "gender": "female",
           "phone": "123456789",
           "address": "123 Street Name"
         }'
3. Get a Patient by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/patients/1 \
     -H "Accept: application/json"
4. Update a Patient
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/patients/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Updated Patient",
           "age": 35,
           "gender": "male",
           "phone": "987654321",
           "address": "Updated Address"
         }'
5. Delete a Patient
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/patients/1 \
     -H "Accept: application/json"
Appointments
1. Get All Appointments
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/appointments \
     -H "Accept: application/json"
2. Create a New Appointment
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/appointments \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "patient_id": 1,
           "doctor_id": 1,
           "appointment_date": "2025-01-15",
           "notes": "Follow-up checkup"
         }'
3. Get an Appointment by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/appointments/1 \
     -H "Accept: application/json"
4. Update an Appointment
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/appointments/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "patient_id": 1,
           "doctor_id": 1,
           "appointment_date": "2025-01-20",
           "notes": "Updated notes"
         }'
5. Delete an Appointment
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/appointments/1 \
     -H "Accept: application/json"
Rooms
1. Get All Rooms
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/rooms \
     -H "Accept: application/json"
2. Create a New Room
bash
Copy code
curl -X POST http://127.0.0.1:8000/api/rooms \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "ICU Room",
           "type": "ICU",
           "capacity": 2,
           "status": "available",
           "notes": "Equipped with ventilator"
         }'
3. Get a Room by ID
bash
Copy code
curl -X GET http://127.0.0.1:8000/api/rooms/1 \
     -H "Accept: application/json"
4. Update a Room
bash
Copy code
curl -X PUT http://127.0.0.1:8000/api/rooms/1 \
     -H "Accept: application/json" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Updated Room",
           "type": "Updated Type",
           "capacity": 4,
           "status": "occupied",
           "notes": "Fully occupied"
         }'
5. Delete a Room
bash
Copy code
curl -X DELETE http://127.0.0.1:8000/api/rooms/1 \
     -H "Accept: application/json"