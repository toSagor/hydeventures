-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 10:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hydeventures_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `admin_address` text NOT NULL,
  `admin_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_phone`, `admin_address`, `admin_status`) VALUES
(1, 'Hydeventures', 'admin@gmail.com', '21232f297a57a5a74#tg#3894a0e4a801fc3', '+49100000000', 'Frankfurt, Germany', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `is_featured` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `detail`, `logo`, `banner`, `site_link`, `is_featured`, `status`, `created_at`) VALUES
(1, 'Dylan Field, CEO and co-founder, Figma', 'Making world-class design accessible to everyone.', 'CM_LOGO20210622040419.png', 'CM_BAN20210622040419.png', 'https://www.bicyclehealth.com/', 1, 1, '2021-06-21 22:04:19'),
(2, 'Linda Lian, CEO and co-founder, Common Room', 'Reinventing customer relationships through community.', 'CM_LOGO20210622040519.png', 'CM_BAN20210622040519.jpg', 'https://www.brex.com/', 1, 1, '2021-06-21 22:05:19'),
(3, 'Pedro Franceschi and Henrique Dubugras, co-founders, Brex', 'Building the next generation of B2B financial services.', 'CM_LOGO20210622040615.png', 'CM_BAN20210622040615.jpg', 'https://mybrightwheel.com/', 1, 1, '2021-06-21 22:06:15'),
(4, 'Sue Khim, CEO and co-founder, Brilliant', 'Inspiring people to achieve their goals in STEM.', 'CM_LOGO20210622040742.png', 'CM_BAN20210622040742.jpg', 'https://brilliant.org/', 1, 1, '2021-06-21 22:07:42'),
(5, 'Samir Goel and Wemimo Abbey, co-founders, Esusu', 'Ensuring that deserving individuals and families have access to affordable housing.', 'CM_LOGO20210622040846.png', 'CM_BAN20210622040846.jpg', 'https://thebrowser.company/', 1, 1, '2021-06-21 22:08:46'),
(6, 'Josh Miller, CEO and co-founder, The Browser Company', 'Building the modern web browser.', 'CM_LOGO20210622041002.png', 'CM_BAN20210622041002.jpg', 'https://www.cameo.com/', 1, 1, '2021-06-21 22:10:02'),
(7, 'Steven Galanis, CEO and co-founder, Cameo', 'Making impossible fan connections possible.', 'CM_LOGO20210622041120.png', 'CM_BAN20210622041120.jpg', 'https://www.cloudera.com/', 1, 1, '2021-06-21 22:11:20'),
(8, 'Alexandr Wang, CEO and founder, Scale', 'Advancing innovation in AI.', 'CM_LOGO20210622041307.png', 'CM_BAN20210622041307.jpg', 'https://www.commonroom.io/', 1, 1, '2021-06-21 22:13:07'),
(9, 'Ann Crady Weiss and Dave Weiss, Co-founders, Hatch', 'Helping families sleep better.', 'CM_LOGO20210622041401.png', 'CM_BAN20210622041401.jpg', 'https://craftable.com/', 1, 1, '2021-06-21 22:14:01'),
(10, 'Ivan Zhao, CEO and co-founder, Notion', 'Empowering every team through all-in-one workspaces.', 'CM_LOGO20210622041504.png', 'CM_BAN20210622041504.jpg', 'https://www.crickethealth.com/', 1, 1, '2021-06-21 22:15:04'),
(11, 'Phillip Wang, CEO and co-founder, Gather', 'Building the metaverse.', 'CM_LOGO20210622041614.png', 'CM_BAN20210622041614.jpg', 'https://www.curlmix.com/', 1, 1, '2021-06-21 22:16:14'),
(12, 'Kimberly Lewis, CEO and co-founder, CurlMix', 'Creating products to serve overlooked communities.', 'CM_LOGO20210622041659.png', 'CM_BAN20210622041659.jpg', 'https://edlyft.com/', 1, 1, '2021-06-21 22:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `category` tinyint(2) NOT NULL,
  `is_featured` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `detail`, `type`, `banner`, `link`, `category`, `is_featured`, `status`, `created_at`) VALUES
(1, 'Vision to Values: A Complete Guide', 'Vision to Values: A Complete Guide', 'NEW CONTENT', 'SI_BAN20210622051601.png', '#', 1, 1, 1, '2021-06-21 23:16:01'),
(2, 'The Management Framework that Propelled LinkedIn to a $20 Billion Company', 'The Management Framework that Propelled LinkedIn to a $20 Billion Company', 'FIRST ROUND REVIEW', 'SI_BAN20210622051743.jpg', 'https://review.firstround.com/the-management-framework-that-propelled-LinkedIn-to-a-20-billion-company', 1, 1, 1, '2021-06-21 23:17:43'),
(3, 'The Three Pillars of Effective Leadership [3 hr online course]', 'The Three Pillars of Effective Leadership [3 hr online course]', 'LINKEDIN', 'SI_BAN20210622051843.jpg', 'https://www.linkedin.com/learning/on-leadership-by-jeff-weiner/welcome-to-on-leadership?u=104', 1, 1, 1, '2021-06-21 23:18:43'),
(4, 'In Sports or Business, Always Prepare for the Next Play', 'In Sports or Business, Always Prepare for the Next Play', 'THE NEW YORK TIMES', 'SI_BAN20210622051940.png', 'https://www.nytimes.com/2012/11/11/business/jeff-weiner-of-linkedin-on-the-next-play-philosophy.html?ref=business', 1, 0, 1, '2021-06-21 23:19:40'),
(5, 'The Most Valuable Lesson I\'ve Learned as a CEO', 'The Most Valuable Lesson I\'ve Learned as a CEO', 'LINKEDIN', 'SI_BAN20210622052021.png', 'https://www.linkedin.com/pulse/20140203145935-22330283-the-most-valuable-lesson-i-ve-learned-as-a-ceo/', 1, 0, 1, '2021-06-21 23:20:21'),
(6, 'Avoiding the Unintended Consequences of Casual Feedback', 'Avoiding the Unintended Consequences of Casual Feedback', 'LINKEDIN', 'SI_BAN20210622052049.png', 'https://www.linkedin.com/pulse/20140602024642-22330283-avoiding-the-unintended-consequences-of-casual-feedback/', 1, 0, 1, '2021-06-21 23:20:49'),
(7, 'Quarterly Business Reviews at LinkedIn: A True Game-Changer', 'Quarterly Business Reviews at LinkedIn: A True Game-Changer', 'LINKEDIN', 'SI_BAN20210622052115.png', 'https://www.linkedin.com/pulse/quarterly-business-reviews-linkedin-true-game-changer-brian-rumao/', 1, 0, 1, '2021-06-21 23:21:15'),
(8, 'Three Golden Rules for Effective Public Speaking', 'Three Golden Rules for Effective Public Speaking', 'LINKEDIN', 'SI_BAN20210622052152.png', 'https://www.linkedin.com/pulse/20121022044446-22330283-from-crickets-chirping-to-a-standing-ovation-three-rules-of-effective-public-speaking/', 1, 0, 1, '2021-06-21 23:21:52'),
(9, 'The Five-Tool Superstar', 'The Five-Tool Superstar', 'LINKEDIN', 'SI_BAN20210622052225.png', '#', 1, 0, 1, '2021-06-21 23:22:25'),
(10, 'Forecasting Framework and Best Practices', 'Forecasting Framework and Best Practices', 'NEW CONTENT', 'SI_BAN20210622052511.png', '#', 2, 0, 1, '2021-06-21 23:25:11'),
(11, 'Four Questions to Elicit Great Feedback', 'Four Questions to Elicit Great Feedback', 'LINKEDIN', 'SI_BAN20210622052546.png', 'https://www.linkedin.com/pulse/20140514142230-13106360-want-great-feedback-ask-these-four-questions/', 2, 0, 1, '2021-06-21 23:25:46'),
(12, 'The Importance of Scheduling Nothing', 'The Importance of Scheduling Nothing', 'LINKEDIN', 'SI_BAN20210622052627.png', 'https://www.linkedin.com/pulse/20130403215758-22330283-the-importance-of-scheduling-nothing/', 2, 0, 1, '2021-06-21 23:26:27'),
(13, 'Leading Through Company Culture and Values', 'Leading Through Company Culture and Values', 'CULTUREMARK', 'SI_BAN20210622052708.png', 'https://www.youtube.com/watch?v=iNBVP74f39k', 3, 0, 1, '2021-06-21 23:27:08'),
(14, 'The Art of Conscious Leadership', 'The Art of Conscious Leadership', 'WISDOM 2.0', 'SI_BAN20210622052744.png', 'https://www.youtube.com/watch?v=2x0fOLqj2Zw', 3, 0, 1, '2021-06-21 23:27:44'),
(15, 'The New Leader: Harnessing Wisdom and Compassion', 'The New Leader: Harnessing Wisdom and Compassion', 'WISDOM 2.0', 'SI_BAN20210622052816.png', 'https://www.youtube.com/watch?v=W-TU9omqM-4', 3, 0, 1, '2021-06-21 23:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `general_info`
--

CREATE TABLE `general_info` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `footer_info` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_info`
--

INSERT INTO `general_info` (`id`, `company_name`, `logo`, `twitter_link`, `linkedin_link`, `email`, `location`, `footer_info`, `last_update`) VALUES
(1, 'HYDE Ventures', 'LI20210624020312.jpeg', 'https://twitter.com/', 'https://linkedin.com/', 'info@hydeventuresss.com', 'Jacson height, NYC 1211', 'Copyright © 2021 HYDE Ventures,  ALL RIGHTS RESERVED', '2021-06-19 09:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_impact`
--

CREATE TABLE `social_impact` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_featured` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_impact`
--

INSERT INTO `social_impact` (`id`, `title`, `detail`, `logo`, `banner`, `link`, `is_featured`, `status`, `created_at`) VALUES
(1, 'Concrete Rose Capital and Foundation', 'Concrete Rose Capital is an early stage investment platform focused on capitalizing underrepresented founders, investing in companies serving underrepresented consumers, and helping early stage companies build diverse teams. In addition to driving impact through investments, Concrete Rose Capital commits 50% of net proceeds to the Concrete Rose Foundation, which identifies and funds nonprofits closing opportunity gaps for underrepresented talent in America. Jeff is a founding LP and serves on the Investment Committee, and Brian is an LP. ', 'SI_LOGO20210622041907.png', 'SI_BAN20210622041907.jpg', 'https://concreterosecapital.com/', 1, 1, '2021-06-21 22:19:07'),
(2, 'The Compassion Project', 'The Compassion Project is a first-of-its-kind national initiative to provide compassion education to elementary school students across the US. It’s mission is to ensure that every primary school student in the US understands what compassion is and how to practice it. \r\n\r\nIn less than two years, over 16,000 schools and 29,000 teachers have registered, with almost 400,000 students impacted. The Compassion Project is a collaboration between Jeff, a vocal leader on compassionate management, and global education innovator EVERFI, who was named to Fast Company’s 2020 List of World’s Most Innovative Companies for its work developing The Compassion Project.', 'SI_LOGO20210622041952.png', 'SI_BAN20210622041952.jpg', 'https://thecompassionproject.com/', 1, 1, '2021-06-21 22:19:52'),
(3, 'Boys & Girls Clubs of the Peninsula', 'The Boys and Girls Clubs of the Peninsula’s mission is to provide the low-income youth of our community with the opportunities they need to achieve school success. BGCP serves East Palo Alto, Redwood City, and Menlo Park, and in total 2,500 students attend BGCP programs 4 days a week. Students receive 740 hours of expanded learning time, a 60% increase over the school day alone. 85% of the youth avoid summer learning loss by participating in our Summer Learning Academy. 90% of our youth graduate from high school with a post-secondary education plan. \r\n\r\nJeff has served on the Advisory Board since 2011 and Brian has been on the Board of Directors since 2015.', 'SI_LOGO20210622042040.png', 'SI_BAN20210622042040.jpg', 'https://www.bgcp.org/', 1, 1, '2021-06-21 22:20:40'),
(4, 'DonorsChoose’s mission is to make it easy for anyone to help a classroom in need', 'DonorsChoose’s mission is to make it easy for anyone to help a classroom in need, moving us closer to a nation where students in every community have the tools and experiences they need for a great education. Public school teachers from every corner of America create classroom project requests, and you can give any amount to the project that inspires you. Since 2000, teachers at 84% of public schools in America have posted a project on DonorsChoose, reaching 4.2M donors, who have contributed $964M in classroom funding, benefiting 40M students. \r\n\r\nJeff has served on the Board of Directors since 2007.', 'CM_LOGO20210622042458.png', 'CM_BAN20210622042458.png', 'https://www.donorschoose.org/', 0, 1, '2021-06-21 22:24:58'),
(5, 'Him For Her is a social impact venture aimed at accelerating diversity on corporate boards', 'Him For Her is a social impact venture aimed at accelerating diversity on corporate boards. To bridge the network gap responsible for the sparsity of women in the boardroom, Him For Her engages business luminaries to connect the world’s most talented “Hers” to board service.\r\n\r\nSince its founding in 2018, Him For Her has built a referral-only talent network of 1,500+ board-ready women and delivered free board-referral lists to 200+ companies ranging from start-ups to S&P 100. Him For Her creates warm introductions between board candidates and CEOs through its series of events guest-hosted by renowned leaders. Jeff has been a supporter and advisor since 2018.', 'SI_LOGO20210622042334.png', 'SI_BAN20210622042334.png', 'https://www.himforher.org/', 2, 1, '2021-06-21 22:23:34'),
(6, 'Year Up\'s mission is to close the Opportunity Divide by ensuring that young adults gain', 'Year Up\'s mission is to close the Opportunity Divide by ensuring that young adults gain the skills, experiences, and support that will empower them to reach their potential through careers and higher education. By providing early-in-career professionals with the business and technical skills hiring companies need, YearUp ensures they can launch successful careers, while providing businesses with an untapped source of bright, motivated talent. Two years after Year Up, alumni earn 40% more on average than similar peers. Jeff has been an advisor since 2015.', 'SI_LOGO20210622042424.png', 'SI_BAN20210622042424.png', 'https://www.yearup.org/', 2, 1, '2021-06-21 22:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `linkedin_link` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `email`, `phone`, `image`, `facebook_link`, `twitter_link`, `linkedin_link`, `designation`, `detail`, `status`, `created_at`) VALUES
(1, 'Jeff Weiner', 'jeff@gmail.com', '+88 02 7745412', 'MEMBER20210622042738.jpg', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'Founding Partner', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-06-21 22:27:38'),
(2, 'Brian Rumao', 'brian@gmail.com', '+88 02 7745412', 'MEMBER20210622042828.png', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'Managing Director', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-06-21 22:28:28'),
(3, 'Sean Mendy', 'sean@gmail.com', '+88 02 7745412', 'MEMBER20210622042916.jpg', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'Venture Partner', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-06-21 22:29:16'),
(4, 'Mike Gamson', 'mike@gmail.com', '+88 02 7745412', 'MEMBER20210622043000.jpg', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'Venture Partner', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-06-21 22:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_info`
--
ALTER TABLE `general_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_impact`
--
ALTER TABLE `social_impact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `general_info`
--
ALTER TABLE `general_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_impact`
--
ALTER TABLE `social_impact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
