-- Create tutors table
CREATE TABLE tutors (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mbti VARCHAR(4) NOT NULL,
    program VARCHAR(255) NOT NULL,
    availability VARCHAR(255) NOT NULL,
    rating DECIMAL(3,2) NOT NULL DEFAULT 0.00
);

-- Create tutees table
CREATE TABLE tutees (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT(11) NOT NULL,
    address VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    program VARCHAR(255) NOT NULL,
    mbti VARCHAR(4) NOT NULL
);

-- Create matches table
CREATE TABLE matches (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tutor_id INT(11) UNSIGNED NOT NULL,
    tutee_id INT(11) UNSIGNED NOT NULL,
    FOREIGN KEY (tutor_id) REFERENCES tutors(id),
    FOREIGN KEY (tutee_id) REFERENCES tutees(id)
);

-- Create mbti_results table
CREATE TABLE mbti_results (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    ei_score INT(11) NOT NULL,
    sn_score INT(11) NOT NULL,
    tf_score INT(11) NOT NULL,
    jp_score INT(11) NOT NULL,
    mbti_type VARCHAR(4) NOT NULL
);