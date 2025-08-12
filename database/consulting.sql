-- phpMyAdmin SQL Dump - Detailed Offer Descriptions Version
-- Database: consulting

DROP DATABASE IF EXISTS consulting;
CREATE DATABASE consulting CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE consulting;

-- ---------------------------
-- Table: user
-- ---------------------------
CREATE TABLE `user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `status` ENUM('client', 'admin') DEFAULT 'client',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` DATETIME DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `status`, `created_at`)
VALUES
(1, 'Amine Khalfaoui', 'amine@example.com', 'hashed_password', 'client', '2020-03-28 13:07:17'),
(2, 'Nourhene Ben Othmen', 'nourhene@example.com', 'hashed_password', 'client', '2020-03-28 13:07:17'),
(3, 'Wissal Khalfaoui', 'wissal@example.com', 'hashed_password', 'client', '2020-03-28 13:07:17');

-- ---------------------------
-- Table: offer
-- ---------------------------
CREATE TABLE `offer` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(255) NOT NULL,
  `item_category` VARCHAR(255) NOT NULL,
  `item_image` VARCHAR(255) NOT NULL,
  `item_description` TEXT NOT NULL,
  `item_subdescription` VARCHAR(255) NOT NULL,
  `item_register` DATETIME DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `offer` (`item_id`, `item_name`, `item_category`, `item_image`, `item_description`, `item_subdescription`, `item_register`) VALUES
(1, 'Jobs in France', 'Jobs', './images/offers/job offers france.jpg',
'France is a leading destination for skilled professionals in fields such as software development, engineering, healthcare, and finance.
The job market in France is highly competitive, offering attractive salaries and benefits for qualified candidates.
Working in France provides an opportunity to experience its rich culture, cuisine, and lifestyle.
French companies often look for bilingual candidates, especially those fluent in English and French.
The technology sector is particularly strong in cities like Paris, Lyon, and Toulouse.
France offers strong labor protections, including paid vacation, health insurance, and retirement benefits.
Many companies offer remote or hybrid work options, especially in IT and digital services.
Work permits and visas are available for qualified foreign professionals under various programs.
Networking and professional certifications can significantly improve job prospects.
Overall, France provides a stable and rewarding environment for career growth and personal development.',
'Design and build modern applications for the French job market.', '2020-03-28 11:08:57'),

(2, 'Jobs in Qatar', 'Jobs', './images/offers/job offers qatar.jpg',
'Qatar offers diverse job opportunities in sectors such as oil and gas, construction, healthcare, and education.
With its rapidly growing economy, Qatar attracts professionals from all over the world.
Tax-free salaries and generous benefits make Qatar an attractive choice for expatriates.
The country has invested heavily in infrastructure, leading to a surge in construction and engineering roles.
Healthcare professionals are in high demand, especially with the expansion of hospitals and clinics.
English is widely used in the workplace, though knowledge of Arabic can be beneficial.
Qatar offers modern living standards, world-class shopping, and cultural activities.
The government has streamlined work visa processes for skilled workers.
Major events, such as the FIFA World Cup, have boosted employment in tourism and hospitality.
Living in Qatar also means access to high-quality education and safe communities.',
'Monitor access points, patrol premises, and secure assets in Qatar.', '2020-03-28 11:08:57'),

(3, 'Jobs in Saudia', 'Jobs', './images/offers/job offers saudia.jpeg',
'Saudi Arabia presents a wide range of job opportunities in sectors like oil and gas, IT, finance, and construction.
The Vision 2030 plan has created demand for skilled workers to support economic diversification.
Expatriates benefit from tax-free income and generous employment packages.
English-speaking professionals are welcomed, especially in international companies.
Saudi Arabia is investing in renewable energy, creating new roles in green technology.
Healthcare and education sectors are expanding rapidly, requiring experienced staff.
The country offers modern housing, healthcare, and recreational facilities for workers.
Work visas are granted to professionals with relevant qualifications and experience.
Cultural adaptation is essential, but companies often support expatriates through orientation programs.
Saudi Arabia’s job market continues to grow, offering stability and long-term opportunities.',
'Wide range of job roles across various industries in Saudi Arabia.', '2020-03-28 11:08:57'),

(4, 'Jobs in Serbia', 'Jobs', './images/offers/job offers.jpg',
'Serbia is becoming an attractive location for professionals in IT, manufacturing, and engineering.
Its strategic location in Europe makes it a hub for international business.
The IT sector is growing rapidly, with many companies hiring software developers and engineers.
Living costs in Serbia are relatively low compared to Western Europe.
English proficiency is common in the business community, especially in tech companies.
Foreign professionals can find opportunities in multinational companies and startups.
Serbia offers work permits for skilled professionals in high-demand sectors.
Cultural diversity and hospitality make integration easier for expatriates.
Government initiatives aim to attract foreign investments, boosting employment.
Working in Serbia offers both professional growth and a high quality of life.',
'Growing market with increasing opportunities for professionals in Serbia.', '2020-03-28 11:08:57'),

(5, 'Residence Canada', 'Residence', './images/offers/residence permanante canada.jpg',
'Canada offers several immigration pathways for skilled workers, entrepreneurs, and students.
The Express Entry system is one of the fastest ways to obtain permanent residency.
Provincial Nominee Programs allow candidates to settle in specific provinces.
Canada values professionals with experience in healthcare, IT, and engineering.
Permanent residents enjoy free healthcare and access to quality education.
The country is known for its cultural diversity and inclusive society.
Canada has a strong economy with low unemployment rates in many regions.
Work-life balance is a priority, with generous vacation and family benefits.
Language skills in English and/or French improve immigration chances.
Living in Canada provides safety, stability, and opportunities for the whole family.',
'Multiple immigration programs to settle and work in Canada.', '2020-03-28 11:08:57'),

(6, 'Study in Romania', 'Study', './images/offers/study offers romania.jpg',
'Romania is home to several prestigious universities offering affordable tuition fees.
International students can choose programs in English, French, or Romanian.
The cost of living is lower compared to many European countries.
Romania’s education system is recognized across the EU and beyond.
Students can pursue degrees in medicine, engineering, IT, and arts.
Scholarships are available for international students through various programs.
Romania offers a vibrant cultural life with historic cities and modern amenities.
Student visas allow part-time work during studies.
Graduates have opportunities to work in Romania or other EU countries.
Romania combines quality education with a rich cultural experience.',
'Affordable education opportunities in Romania for international students.', '2020-03-28 11:08:57'),

(7, 'Visa Europe', 'Visa', './images/offers/visa europe.jpg',
'Europe offers a wide range of visa options for work, study, and tourism.
The Schengen Visa allows travel to multiple European countries with a single permit.
Work visas vary by country and profession but often prioritize skilled workers.
Student visas grant access to world-class education across Europe.
Many countries offer family reunification programs for visa holders.
Visa applications usually require proof of income, accommodation, and insurance.
Some nations provide long-term residence permits after a certain stay period.
Business visas are available for entrepreneurs and investors.
Europe’s visa policies encourage cultural exchange and mobility.
Living in Europe provides access to healthcare, education, and cultural opportunities.',
'Various visa types and opportunities across European countries.', '2020-03-28 11:08:57'),

(8, 'Visa Qatar', 'Visa', './images/offers/visa qatar.jpg',
'Qatar provides multiple visa types, including work, tourist, and residence visas.
Work visas are available for professionals with confirmed job offers.
Tourist visas allow short-term visits for leisure and events.
Residence visas are granted to expatriates working in Qatar and their families.
Visa applications require sponsorship from an employer or relative.
Processing times are generally quick, especially for skilled workers.
Qatar offers modern infrastructure and high living standards for residents.
Long-term visa holders enjoy access to healthcare and education.
Visa regulations are updated regularly to meet labor market needs.
Living in Qatar offers cultural diversity and economic opportunities.',
'Work, tourist, and residence visas available for Qatar.', '2020-03-28 11:08:57');

-- ---------------------------
-- Table: favorites
-- ---------------------------
CREATE TABLE `favorites` (
  `favorite_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `item_id` INT(11) NOT NULL,
  PRIMARY KEY (`favorite_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `offer`(`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------
-- Table: newsletter
-- ---------------------------
CREATE TABLE `newsletter` (
  `news_id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `subscribed_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------
-- Table: chatbot
-- ---------------------------
CREATE TABLE `chatbot` (
  `query_id` INT AUTO_INCREMENT PRIMARY KEY,
  `queries` VARCHAR(255) NOT NULL,
  `replies` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `chatbot` (`queries`, `replies`) VALUES
('hello', 'Hello! How can I help you?'),
('bye', 'Goodbye! Have a great day!'),
('thanks', 'You\'re welcome! If you have any more questions, feel free to ask.'),
('What kind of consulting services do you offer?', 'We offer a wide range of consulting services including business strategy, IT and software development, digital marketing, HR solutions, and legal advisory.'),
('How much do your consulting services cost?', 'Our pricing depends on the type of service, project scope, and consultant experience.'),
('Is there someone available to help me this week?', 'Yes, many of our consultants have open slots this week.'),
('What kind of consulting services do you offer?', 'Business Consulting, IT & Software Consulting, Digital Marketing, and more.');
