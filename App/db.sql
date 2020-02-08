CREATE TABLE employee (
  employee_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  employee_fname VARCHAR(35) NOT NULL,
  employee_lname VARCHAR(35) NOT NULL,
  employee_email VARCHAR(255) NOT NULL UNIQUE,
  employee_password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE food (
  food_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  food_name VARCHAR(100) NOT NULL,
  food_category VARCHAR(50) NOT NULL,
  food_time INT(255) NOT NULL UNIQUE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE section (
  section_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  section_name VARCHAR(100) NOT NULL,
);


SELECT section_name.section_id, employee.employee_fname, employee.employee_lname FROM employee INNER JOIN section ON section.employee_id = employee.employee_id where employee_id = '$employee_id';

GRANT ALL PRIVILEGES ON mydb.* TO 'root'@'localhost' IDENTIFIED BY 'root';
