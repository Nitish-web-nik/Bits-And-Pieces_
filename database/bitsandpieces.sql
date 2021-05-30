-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 04:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitsandpieces`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` blob NOT NULL,
  `msg` mediumtext NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `image`, `msg`, `createdat`, `status`) VALUES
(8, 1, '# Spreading smiles in the form of food packets:)', 0x382e6a7067, 'Due to rapid growth in covid cases, everyone was suggested to stay indoors with proper safety. The virtual platform became the only help for maximum kinds of problems. I am Rakesh Kumar, a social worker from Indoor. Recently I got a  request from an old age home. On researching about them I felt that they were living a miserable life. There was scarcity of food and medicines for them. I felt that somewhere I needed to take some responsibility for the sake of humanity. I started looking at some kind of virtual platform that could help me with this problem, then I came across a website named Bits and Pieces. After verifying its genuinity, I searched for some well sanitized food and medicines. After all the research I made a request to their platform and also talked on their helpline number. Within a few hours I received the help and donated that to the old age home. Satisfaction on their wrinkled face, can’t be described in a few words. I would like to thank all the donors who contributed their parts in this small help toward the society, also cheers to the “Bits and Pieces” who is doing an amazing work:)', '2021-05-29 12:50:36', 1),
(9, 1, '#Thank you for the clothes, you didn’t throw away', 0x4d414333365f574f4d454e535f434c4f544845535f504f53542e6a7067, 'I  Anushka from Hyderabad, was currently walking through a slum area. Some NGOs were donating them some essential groceries. The scene was like everyone was trying to grab the ration with some untidy and torn clothes on. Everyone was just aimed at food despite any other need. The clothes were hardly covering their body and intotal it was sure that this way they were inviting some kind of disease. I wondered if I could help them in any possible way. I ran toward my home but could find just 3-4 old clothes. Corona was at its peak, so I decided to get some help via a digital platform. After much research I came across a website, “Bits and Pieces”. They were collecting old clothes from a large number of people. After verification, I sent them a request convincing them to help those people. Within a few hours, they sent me a reasonable number of old clothes in proper condition. I took those clothes and helped those people in slums. After receiving the clothes they felt some vibes of festivals and seeing satisfaction in their eyes I was overwhelmed. I would like to thank all the hands who were a part of this satisfaction. Thank you for the clothes you didn’t throw away. Special thanks to “Bits and Pieces” who is proving ‘help’ via platform. Keep serving society. Thank you.', '2021-05-29 12:55:57', 1),
(10, 1, '# Your Medicines Became our Life Saviour', 0x31322e6a7067, 'I am Veena Shrivastva, from Godda. Our family recently got affected by coronavirus. Actually in our area there were many active cases. In that scenario, things got worse. The chemist said  that medicines  were insufficient and the supply rate was very low. All chemists started to sell their drugs at double or triple the rate. Middle class people like us were already  suffering from financial problems, and after this case we were shaken from inside. I started seeking help from some online platform, but there was nothing as we were looking for. In that crucial time, “Bits and Pieces” came into our life as a blessing. On visiting the website I found that many people who recovered from corona were donating their remaining mediciences on their website. I verified every factor and requested them to provide some help. I requested them on their platform with the prescription. They verified everything and within a few hours I received the medicines. Thanks to everyone who was playing a part in our recovery. Special thanks to “Bits and Pieces” who made things possible and became our life saviour. We  will continue this chain of helping and donating.\r\n', '2021-05-29 12:57:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donationtype`
--

CREATE TABLE `donationtype` (
  `id` int(11) NOT NULL,
  `dType` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donationtype`
--

INSERT INTO `donationtype` (`id`, `dType`, `status`, `createdAt`) VALUES
(1, 'Food', 1, '2021-05-27 11:20:36'),
(2, 'Oxygen Cylinder', 1, '2021-05-27 11:20:36'),
(3, 'Clothes', 1, '2021-05-27 11:20:55'),
(4, 'Other Covid Essential', 1, '2021-05-27 12:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dType_id` int(11) NOT NULL,
  `objectName` varchar(255) NOT NULL,
  `objectImg` blob NOT NULL,
  `quantity` int(11) NOT NULL,
  `shrt_desc` mediumtext NOT NULL,
  `comp_desc` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `dType_id`, `objectName`, `objectImg`, `quantity`, `shrt_desc`, `comp_desc`, `status`, `createdAt`, `duration`) VALUES
(3, 1, 4, 'Mediciness', 0x31322e6a7067, 50, 'Medicines (*to be used under prescription)', 'Some medicines are donated by Mr Kapoor, post recovery of corona. These medicines include Azithromycin(250mg), Paracetamol tablets(500mg), Vitamin C tablets, Betadine and some other multivitamins. These medicines are to be donated to the people who are in need. Quantity and quality is approved. You can receive it by leaving a request on our platform or you can also refer to someone so that we can contact the needy people. For more details you can directly contact Mr Kapoor on 0239-32429', 1, '2021-05-28 12:33:21', '4'),
(4, 1, 3, 'clothes', 0x31352e6a7067, 10, 'Old wearable clothes, 10 pieces', 'Mr Luthra, is donating some old wearable clothes to those people who can hardly afford their livelihood. The clothes consist of 5 shirts and 5 lowers. All the clothes are well maintained. Quantity and quality is approved. You can receive it by leaving a request on our platform or you can also refer to someone so that we can contact the needy people. For more details you can directly contact Mr Luthra on 0239-32429.', 1, '2021-05-28 12:37:06', '12'),
(6, 1, 1, 'Poori and Sabji', 0x322e6a7067, 30, 'Poori and Sabji: One time meal enough for feeding 30 people.', 'The meal, donated by Mrs Sinha, from ashok colony, patna is enough for feeding 30 people. She was having a Puja at her place and decided to throw a helping hand for the society. She intentionally prepared food at her home keeping health in mind. She is willing to donate this to those members of society who can’t afford food. Quality and quantity of food is well tasted.You can receive it by leaving a request on our platform or you can also refer to someone so that we can contact the needy people. For more details you can directly contact Mrs Sinha 0239-32429.', 1, '2021-05-28 12:40:32', '3'),
(7, 1, 1, 'Immunity Booster Kadha', 0x332e6a7067, 150, 'Immunity Booster Kadha:  Health drink enough for distributing in about 150 people', 'This immunity booster kadha, is prepared and donated by Mr Kumar, a well known nutritionist. Seeing the current condition of society, he decided to help the society in order to boost the immunity of people who can’t afford the special ingredients used in it. Quality and quantity of the drink is well tasted. You can receive it by leaving a request on our platform or you can also refer to someone so that we can contact the needy people. For more details you can directly contact Mr Kumar 0239-32429.\r\n', 1, '2021-05-28 12:42:24', '3'),
(8, 1, 1, 'Oats Khichdi', 0x342e6a7067, 50, 'Oats Khichdi: One time meal, enough to feed about 50 people', 'This well cooked and healthy Khichdi, donated by Social club, patna is a one time meal enough to feed approx 50 people. Social club collected some funds and prepared this khichdi full of health benefits and is willing to donate this to the people who are struggling with the current scenario of covid.  Quality and quantity of this meal is well tasted. You can receive it by leaving a request on our platform or you can also refer to someone so that we can contact the needy people. For more details you can directly contact Mr Kumar 0239-32429.', 1, '2021-05-28 12:43:29', '3');

-- --------------------------------------------------------

--
-- Table structure for table `registeredusers`
--

CREATE TABLE `registeredusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailId` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registeredusers`
--

INSERT INTO `registeredusers` (`id`, `name`, `emailId`, `phone`, `pswd`, `status`, `createdAt`) VALUES
(7, 'saurabh kumar', 'saurabhprakash1@gmail.com', 8709919014, 'd79c8788088c2193f0244d8f1f36d2db', 1, '2021-05-30 02:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `profilePic` blob NOT NULL,
  `alt_phn_no` bigint(20) NOT NULL,
  `pincode` bigint(20) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `landMark` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `userId`, `profilePic`, `alt_phn_no`, `pincode`, `city`, `state`, `address`, `area`, `landMark`, `createdAt`, `status`) VALUES
(21, 1, 0x62616e6e6572372e706e67, 8765432191, 800001, 'patna', 'bihar', 'boring road,patna', 'mhuilyfuktdyitrous', 'nfhgdhdjydt', '2021-05-28 14:15:04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donationtype`
--
ALTER TABLE `donationtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donationtype`
--
ALTER TABLE `donationtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registeredusers`
--
ALTER TABLE `registeredusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
