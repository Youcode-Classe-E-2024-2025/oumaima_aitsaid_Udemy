-- Création de la base de données
CREATE DATABASE IF NOT EXISTS youdemy;
USE youdemy;

-- Création de la table Utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table Catégories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Création de la table Cours
CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES utilisateurs(id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Création de la table Ressources_Cours
CREATE TABLE ressources_cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    type ENUM('video', 'document') NOT NULL,
    title VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES cours(id) ON DELETE CASCADE
);

-- Création de la table Étiquettes
CREATE TABLE Tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Création de la table Cours_Etiquettes (pour la relation many-to-many)
CREATE TABLE cours_tags (
    course_id INT,
    tag_id INT,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Création de la table Inscriptions
CREATE TABLE inscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES cours(id) ON DELETE CASCADE
);

-- Insertion de données d'exemple

-- Insertion d'Utilisateurs
INSERT INTO utilisateurs (username, email, password, role) VALUES
('john_doe', 'john@example.com', 'hashed_password', 'student'),
('jane_smith', 'jane@example.com', 'hashed_password', 'teacher'),
('admin_user', 'admin@example.com', 'hashed_password', 'admin');

-- Insertion de Catégories
INSERT INTO categories (name) VALUES
('Développement Web'),
('Science des Données'),
('Développement Mobile');

-- Insertion de Cours
INSERT INTO cours (title, description, teacher_id, category_id) VALUES
('Introduction à HTML', 'Apprenez les bases de HTML', 2, 1),
('Python pour l''analyse de données', 'Maîtrisez l''analyse de données avec Python', 2, 2),
('Développement d''applications iOS', 'Construisez votre première application iOS', 2, 3);

-- Insertion de Ressources_Cours
INSERT INTO ressources_cours (course_id, type, title, file_path) VALUES
(1, 'video', 'Introduction à HTML - Partie 1', '/videos/html_intro_part1.mp4'),
(1, 'document', 'Guide HTML pour débutants', '/documents/html_beginner_guide.pdf'),
(2, 'video', 'Analyse de données avec Pandas', '/videos/pandas_data_analysis.mp4'),
(2, 'document', 'Exercices Python', '/documents/python_exercises.pdf'),
(3, 'video', 'Création d''une interface iOS', '/videos/ios_ui_creation.mp4'),
(3, 'document', 'Documentation Swift', '/documents/swift_documentation.pdf');

-- Insertion d'Étiquettes
INSERT INTO tags (name) VALUES
('débutant'),
('programmation'),
('web'),
('données'),
('mobile');

-- Insertion de Cours_Etiquettes
INSERT INTO cours_tags (course_id, tag_id) VALUES
(1, 1), (1, 2), (1, 3),
(2, 2), (2, 4),
(3, 1), (3, 2), (3, 5);

-- Insertion d'Inscriptions
INSERT INTO inscriptions (student_id, course_id) VALUES
(1, 1),
(1, 2);


-- Statistique
--Nombre total de cours:
"SELECT COUNT(*) as total FROM cours"
--répartition par catégorie
"SELECT c.name as category, COUNT(co.id) as count
                  FROM categories c
                  LEFT JOIN cours co ON c.id = co.category_id
                  GROUP BY c.id
                  ORDER BY count DESC"
--Le cour avec le plus d' étudiants
"SELECT c.title, COUNT(i.id) as student_count
                  FROM cours c
                  LEFT JOIN inscriptions i ON c.id = i.course_id
                  GROUP BY c.id
                  ORDER BY student_count DESC
                  LIMIT 1";
--Les Top 3 enseignants:
"SELECT u.username, COUNT(DISTINCT c.id) as course_count, COUNT(i.id) as student_count
                  FROM utilisateurs u
                  LEFT JOIN cours c ON u.id = c.teacher_id
                  LEFT JOIN inscriptions i ON c.id = i.course_id
                  WHERE u.role = 'teacher'
                  GROUP BY u.id
                  ORDER BY student_count DESC
                  LIMIT 3"

-- Nombre d’étudiants inscrits
"SELECT COUNT(DISTINCT student_id) as total FROM inscriptions"
-- Nombre de cours:
"SELECT AVG(course_count) as average
                  FROM (
                      SELECT student_id, COUNT(DISTINCT course_id) as course_count
                      FROM inscriptions
                      GROUP BY student_id
                  ) as student_courses";