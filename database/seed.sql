-- =============================================
-- TEST CREDENTIALS
-- =============================================
-- All seeded customers use the same password:
-- Password: Test123
--
-- These credentials are for local development only.
-- Do not use them in production.

-- =============================================
-- CUSTOMERS
-- =============================================

INSERT INTO customers (
    id,
    first_name,
    last_name,
    document_number,
    password
) VALUES
(
    1,
    'Jose',
    'Demo',
    '123456789',
    '$2y$12$hyQLRTKNcQLYHlWrVYIQleVvNTnkjZJ0IzEaeBGYPIr4bmYH3yCVC'
),
(
    2,
    'Jhon',
    'Doe',
    '987654321',
    '$2y$12$hyQLRTKNcQLYHlWrVYIQleVvNTnkjZJ0IzEaeBGYPIr4bmYH3yCVC'
),
(
    3,
    'Maria',
    'Lopez',
    '456789123',
    '$2y$12$hyQLRTKNcQLYHlWrVYIQleVvNTnkjZJ0IzEaeBGYPIr4bmYH3yCVC'
),
(
    4,
    'Carlos',
    'Martinez',
    '741852963',
    '$2y$12$hyQLRTKNcQLYHlWrVYIQleVvNTnkjZJ0IzEaeBGYPIr4bmYH3yCVC'
);


-- =============================================
-- ACCOUNTS
-- =============================================

INSERT INTO accounts (
    id,
    customer_id,
    balance,
    account_type,
    account_number,
    is_active
) VALUES
(
    1,
    1,
    5000000.00,
    'SAVINGS',
    '23-45661-124',
    1
),
(
    2,
    1,
    4000000.00,
    'CHECKING',
    '31-72978-990',
    1
),
(
    3,
    2,
    3000000.00,
    'SAVINGS',
    '38-59868-742',
    1
),
(
    4,
    2,
    2500000.00,
    'CHECKING',
    '42-13579-864',
    1
),
(
    5,
    3,
    6500000.00,
    'SAVINGS',
    '51-24680-135',
    1
),
(
    6,
    3,
    1200000.00,
    'CHECKING',
    '64-97531-246',
    1
),
(
    7,
    4,
    8500000.00,
    'SAVINGS',
    '72-86420-357',
    1
),
(
    8,
    4,
    750000.00,
    'CHECKING',
    '83-75319-468',
    0
);