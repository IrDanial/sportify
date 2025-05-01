-- Tabel Users
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    birthdate DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Workout_Plans
CREATE TABLE Workout_Plans (
    plan_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Tabel Exercises
CREATE TABLE Exercises (
    exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    plan_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    sets INT NOT NULL DEFAULT 0,
    reps INT DEFAULT 0,
    duration INT DEFAULT NULL,
    notes TEXT DEFAULT NULL,
    FOREIGN KEY (plan_id) REFERENCES Workout_Plans(plan_id)
);

-- Tabel Nutrition_Logs
CREATE TABLE Nutrition_Logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    meal_type ENUM('Sarapan', 'Makan Siang', 'Makan Malam') NOT NULL,
    food_item VARCHAR(100) NOT NULL,
    calories INT DEFAULT 0,
    protein FLOAT DEFAULT 0.0,
    carbs FLOAT DEFAULT 0.0,
    fats FLOAT DEFAULT 0.0,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Tabel Progress_Tracker
CREATE TABLE Progress_Tracker (
    progress_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    weight_kg FLOAT,
    body_fat_percent FLOAT,
    muscle_mass FLOAT,
    notes TEXT DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Tabel Appointments
CREATE TABLE Appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    coach_name VARCHAR(100),
    scheduled_date DATETIME NOT NULL,
    location VARCHAR(255),
    session_type VARCHAR(100),
    status ENUM('Scheduled', 'Complete', 'Canceled') DEFAULT 'Scheduled',
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
