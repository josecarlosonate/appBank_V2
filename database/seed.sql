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
    '$2y$12$9St2VX6wLFNPikI04meWKOOiqWLE/wl1gM6USaiwl6xCr5LmKWXpa'
),
(
    2,
    'Jhon',
    'Doe',
    '987654321',
    '$2y$12$9St2VX6wLFNPikI04meWKOOiqWLE/wl1gM6USaiwl6xCr5LmKWXpa'
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
);