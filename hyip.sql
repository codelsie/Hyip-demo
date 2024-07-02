CREATE TABLE IF NOT EXISTS users (
    id INT primary key Auto_increment,
    email VARCHAR(225),
    `name` VARCHAR(225),
    `password` VARCHAR(225),
    user_balance VARCHAR(225) NOT NULL
);

CREATE TABLE IF NOT EXISTS investment_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_name VARCHAR(100) NOT NULL,
    description TEXT,
    target_amount DECIMAL(10,2) NOT NULL,
    monthly_contribution DECIMAL(10,2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS user_investments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  investment_amount DECIMAL(10,2) NOT NULL,
  investment_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  investment_type VARCHAR(50) NOT NULL,
  investment_status VARCHAR(50) NOT NULL,
  investment_balance FLOAT NOT NULL DEFAULT 0.00

);

CREATE TABLE IF NOT EXISTS user_deposits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  deposit_amount DECIMAL(10,2) NOT NULL,
  deposit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deposit_method VARCHAR(50),
  deposit_status VARCHAR(50) NOT NULL DEFAULT 'pending'
);

CREATE TABLE IF NOT EXISTS user_withdrawals (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  withdrawal_amount DECIMAL(10,2) NOT NULL,
  withdrawal_date DATE NOT NULL,
  withdrawal_method VARCHAR(50) NOT NULL,
  withdrawal_status VARCHAR(50) NOT NULL
);

