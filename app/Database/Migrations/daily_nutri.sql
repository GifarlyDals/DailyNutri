-- Database: daily_nutri
CREATE DATABASE IF NOT EXISTS daily_nutri;
USE daily_nutri;

-- ======================
-- Table: user
-- ======================
CREATE TABLE user (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- ======================
-- Table: makanan
-- ======================
CREATE TABLE makanan (
    idMakanan INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    namaMakanan VARCHAR(100) NOT NULL,
    kalori INT NOT NULL,
    deskripsi TEXT,
    tags VARCHAR(255),
    FOREIGN KEY (idUser) REFERENCES user(idUser) ON DELETE CASCADE
);

-- ======================
-- Table: makanan_planner
-- ======================
CREATE TABLE makanan_planner (
    idPlanMakan INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    idMakanan INT,
    planMakan VARCHAR(100),
    totalKalori INT,
    totalPorsi INT,
    waktuMakan DATETIME,
    type VARCHAR(50),
    FOREIGN KEY (idUser) REFERENCES user(idUser) ON DELETE CASCADE,
    FOREIGN KEY (idMakanan) REFERENCES makanan(idMakanan) ON DELETE SET NULL
);

-- ======================
-- Table: minum_planner
-- ======================
CREATE TABLE minum_planner (
    idPlanMinum INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    targetML INT DEFAULT 2000,
    currentML INT DEFAULT 0,
    tanggal DATE,
    FOREIGN KEY (idUser) REFERENCES user(idUser) ON DELETE CASCADE
);

-- ======================
-- Table: dashboard
-- ======================
CREATE TABLE dashboard (
    idDashboard INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    totalKaloriHariIni INT DEFAULT 0,
    totalMakananHariIni INT DEFAULT 0,
    tanggal DATE,
    FOREIGN KEY (idUser) REFERENCES user(idUser) ON DELETE CASCADE
);
