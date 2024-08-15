CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    garage_id INT,
    name VARCHAR(255) NOT NULL,
    cost_price DOUBLE,
    price DOUBLE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (garage_id) REFERENCES garages(garage_id)
);

// codes 4 error_reporting

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//staff

CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    garage_id INT,
    service_id INT,
    name VARCHAR(255) NOT NULL,
    age VARCHAR(255) NOT NULL,
    contact VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (garage_id) REFERENCES garages(id),
    FOREIGN KEY (service_id) REFERENCES services(id)
);