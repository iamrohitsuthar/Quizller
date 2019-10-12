CREATE TABLE `teachers` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `classes` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `tests` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`teacher_id` INT NOT NULL,
	`name` varchar(255) NOT NULL,
	`date` date NOT NULL,
	`status_id` INT NOT NULL,
	`subject` varchar(255) NOT NULL,
	`total_questions` INT NOT NULL,
	`class_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `status` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `students` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`test_id` INT NOT NULL,
	`rollno` INT NOT NULL,
	`password` varchar(255) NOT NULL,
	`score` INT(255) NOT NULL,
	`status` BOOLEAN NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Questions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`optionA` varchar(255) NOT NULL,
	`optionB` varchar(255) NOT NULL,
	`optionC` varchar(255) NOT NULL,
	`optionD` varchar(255) NOT NULL,
	`correctAns` varchar(255) NOT NULL,
	`score` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `question_test_mapping` (
	`question_id` INT NOT NULL,
	`test_id` INT NOT NULL,
	PRIMARY KEY (`question_id`,`test_id`)
);

CREATE TABLE `score` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`test_id` INT NOT NULL,
	`question_id` INT NOT NULL,
	`correct_count` INT NOT NULL,
	`wrong_count` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `student_data` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`rollno` BIGINT NOT NULL,
	`class_id` INT,
	PRIMARY KEY (`id`)
);

ALTER TABLE `tests` ADD CONSTRAINT `tests_fk0` FOREIGN KEY (`teacher_id`) REFERENCES `teachers`(`id`);

ALTER TABLE `tests` ADD CONSTRAINT `tests_fk1` FOREIGN KEY (`status_id`) REFERENCES `status`(`id`);

ALTER TABLE `tests` ADD CONSTRAINT `tests_fk2` FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`);

ALTER TABLE `students` ADD CONSTRAINT `students_fk0` FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`);

ALTER TABLE `students` ADD CONSTRAINT `students_fk1` FOREIGN KEY (`rollno`) REFERENCES `student_data`(`id`);

ALTER TABLE `question_test_mapping` ADD CONSTRAINT `question_test_mapping_fk0` FOREIGN KEY (`question_id`) REFERENCES `Questions`(`id`);

ALTER TABLE `question_test_mapping` ADD CONSTRAINT `question_test_mapping_fk1` FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`);

ALTER TABLE `score` ADD CONSTRAINT `score_fk0` FOREIGN KEY (`test_id`) REFERENCES `tests`(`id`);

ALTER TABLE `score` ADD CONSTRAINT `score_fk1` FOREIGN KEY (`question_id`) REFERENCES `Questions`(`id`);

ALTER TABLE `student_data` ADD CONSTRAINT `student_data_fk0` FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`);

