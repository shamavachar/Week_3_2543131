-- Database Schema for GitHub Weekly Commit Challenge
-- Database: college_db

-- Table structure for table `students`
CREATE TABLE IF NOT EXISTS `students` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `roll_no` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100),
  `class` VARCHAR(50) DEFAULT 'BCA-III (SEM-VI)',
  `commits_count` INT DEFAULT 0,
  `last_commit_date` DATE,
  `github_url` VARCHAR(255)
);

-- Sample data for the challenge
INSERT INTO `students` (`roll_no`, `name`, `email`, `commits_count`, `last_commit_date`, `github_url`) VALUES
('BCA301', 'Rahul Sharma', 'rahul.s@example.com', 12, '2026-01-16', 'https://github.com/rahul-s'),
('BCA302', 'Priya Patil', 'priya.p@example.com', 15, '2026-01-17', 'https://github.com/priya-p'),
('BCA303', 'Amit Deshmukh', 'amit.d@example.com', 8, '2026-01-15', 'https://github.com/amit-d'),
('BCA304', 'Sneha Kulkarni', 'sneha.k@example.com', 20, '2026-01-17', 'https://github.com/sneha-k'),
('BCA305', 'Vikram Pawar', 'vikram.p@example.com', 5, '2026-01-14', 'https://github.com/vikram-p');
