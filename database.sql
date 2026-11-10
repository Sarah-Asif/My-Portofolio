-- Portfolio database: import via phpMyAdmin (Import tab) or `mysql -u root < database.sql`
CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_db;

DROP TABLE IF EXISTS messages, projects, skills, education, profile, admins;

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE profile (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  title VARCHAR(150) NOT NULL,
  bio TEXT NOT NULL,
  email VARCHAR(120) NOT NULL,
  phone VARCHAR(30),
  location VARCHAR(100),
  career_start DATE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL,
  category VARCHAR(50) NOT NULL,
  level TINYINT UNSIGNED NOT NULL CHECK (level BETWEEN 0 AND 100)
) ENGINE=InnoDB;

CREATE TABLE education (
  id INT AUTO_INCREMENT PRIMARY KEY,
  degree VARCHAR(150) NOT NULL,
  institution VARCHAR(150) NOT NULL,
  period VARCHAR(50) NOT NULL,
  description TEXT
) ENGINE=InnoDB;

CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  category VARCHAR(50) NOT NULL,
  tech VARCHAR(200) NOT NULL,
  link VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  subject VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Admin login: username = admin , password = password  (CHANGE THIS - see README)
INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- >>> Replace with YOUR OWN details <<<
INSERT INTO profile (full_name, title, bio, email, phone, location, career_start) VALUES
('Your Full Name', 'Computer Systems Engineering Student & Web Developer',
 'I am a 3rd-year Computer Systems Engineering student at Mehran University of Engineering and Technology, Jamshoro. I enjoy building responsive, data-driven web applications and solving real engineering problems with clean code.',
 'you@example.com', '+92 300 0000000', 'Jamshoro, Sindh, Pakistan', '2023-10-01');

INSERT INTO skills (name, category, level) VALUES
('HTML5 & CSS3', 'Frontend', 90), ('Bootstrap', 'Frontend', 85), ('JavaScript', 'Frontend', 75),
('PHP', 'Backend', 70), ('MySQL', 'Backend', 70),
('C / C++', 'Programming', 80), ('Python', 'Programming', 65),
('Git & GitHub', 'Tools', 70);

INSERT INTO education (degree, institution, period, description) VALUES
('BE Computer Systems Engineering', 'Mehran University of Engineering and Technology, Jamshoro', '2023 - Present', 'Coursework: Data Structures, Databases, Web Engineering, Operating Systems.'),
('Intermediate (Pre-Engineering)', 'Your College Name', '2021 - 2023', 'Mathematics, Physics, Chemistry.'),
('Matriculation (Science)', 'Your School Name', '2019 - 2021', 'Completed with distinction.');

INSERT INTO projects (title, description, category, tech, link) VALUES
('Student Management System', 'A CRUD web app to manage student records, courses and results with role-based login.', 'Web', 'PHP, MySQL, Bootstrap', 'https://github.com/yourname/student-management'),
('Smart Home Controller', 'Arduino/ESP32 based system to control appliances over Wi-Fi with a mobile-friendly dashboard.', 'Embedded', 'C++, ESP32, MQTT', NULL),
('Weather Dashboard', 'Fetches and visualises weather data for chosen cities using a public API.', 'Web', 'JavaScript, HTML, CSS', 'https://github.com/yourname/weather-dashboard'),
('Library Database Design', 'Normalised ER design and SQL queries for a university library system.', 'Database', 'MySQL, ER Modelling', NULL);
