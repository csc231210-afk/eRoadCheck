-- Development sample data. The bcrypt hash below is for the demo password "password".
USE eroadcheck;
INSERT INTO users (full_name, username, email, password_hash, role, status)
VALUES ('System Administrator', 'admin', 'admin@example.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', 'admin', 'active');

INSERT INTO drivers (full_name, date_of_birth, gender, phone, address) VALUES
('Amina Yusuf', '1990-04-12', 'female', '08000000001', 'Kano, Nigeria'),
('Musa Ibrahim', '1985-09-20', 'male', '08000000002', 'Kaduna, Nigeria');
INSERT INTO driver_licenses (driver_id, license_number, license_class, issue_date, expiry_date, status) VALUES
(1, 'DL-DEMO-0001', 'B', CURDATE() - INTERVAL 1 YEAR, CURDATE() + INTERVAL 2 YEAR, 'active'),
(2, 'DL-DEMO-0002', 'B', CURDATE() - INTERVAL 5 YEAR, CURDATE() - INTERVAL 1 DAY, 'active');
INSERT INTO vehicles (driver_id, plate_number, make, model, colour, manufacture_year, vin, engine_number) VALUES
(1, 'KNA-123AA', 'Toyota', 'Corolla', 'Silver', 2019, 'DEMO-VIN-000001', 'DEMO-ENG-000001'),
(2, 'KAD-456BB', 'Honda', 'Accord', 'Black', 2016, 'DEMO-VIN-000002', 'DEMO-ENG-000002');
INSERT INTO vehicle_documents (vehicle_id, document_type, reference_number, issue_date, expiry_date, status) VALUES
(1, 'registration', 'REG-DEMO-0001', CURDATE() - INTERVAL 1 YEAR, CURDATE() + INTERVAL 1 YEAR, 'valid'),
(1, 'roadworthiness', 'RW-DEMO-0001', CURDATE() - INTERVAL 1 MONTH, CURDATE() + INTERVAL 11 MONTH, 'valid'),
(2, 'registration', 'REG-DEMO-0002', CURDATE() - INTERVAL 2 YEAR, CURDATE() - INTERVAL 1 DAY, 'valid');
INSERT INTO revenue_records (vehicle_id, revenue_type, reference_number, amount, payment_date, expiry_date, payment_status) VALUES
(1, 'Road tax', 'TAX-DEMO-0001', 15000.00, CURDATE(), CURDATE() + INTERVAL 1 YEAR, 'paid'),
(2, 'Road tax', 'TAX-DEMO-0002', 15000.00, NULL, CURDATE() + INTERVAL 1 YEAR, 'unpaid');
