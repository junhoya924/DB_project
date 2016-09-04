-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 14-06-20 09:47
-- 서버 버전: 5.6.13
-- PHP 버전: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `courier`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `clientinfo`
--

CREATE TABLE IF NOT EXISTS `clientinfo` (
  `identi_num` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone_num` text NOT NULL,
  `address` text NOT NULL,
  `courier_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `clientinfo`
--

INSERT INTO `clientinfo` (`identi_num`, `name`, `phone_num`, `address`, `courier_count`) VALUES
(1, 'Tom', '01077352738', '경기도 용인시 기흥구 서천동 313-3', 4),
(2, 'David', '01073853542', '경기도 용인시 기흥구 서천동 322-11', 1),
(3, 'Cathy', '01037541324', '경기도 성남시 기흥구 서천동 804', 0),
(4, 'Jonathan', '01016957565', '경기도 성남시 분당구 야탑동 경남 아너스빌아파트', 0),
(5, 'Nancy', '01078334896', '경기도 수원시 영통구 영통동 1019-13', 0),
(6, '김소희', '01097853565', '경기도 용인시 기흥구 서천동 322-17', 0),
(7, '강경일', '01053367887', '경기도 수원시 영통구 영통동 1019-13', 0),
(8, '박형준', '01079335465', '서울특별시 종로구 인사동 190-2', 0),
(9, '최은진', '01067721586', '서울특별시강남구대치2동998', 0),
(10, '조경민', '01055786345', '경기도 성남시 중원구 중앙동 1152', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `courierinfo`
--

CREATE TABLE IF NOT EXISTS `courierinfo` (
  `identi_num` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `type` text NOT NULL,
  `receiver_identi` int(11) NOT NULL,
  `delivery_identi` int(11) NOT NULL,
  `isdelivered` int(11) NOT NULL,
  `sender_name` text NOT NULL,
  `date` text NOT NULL,
  `isevaluate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `courierinfo`
--

INSERT INTO `courierinfo` (`identi_num`, `profit`, `size`, `type`, `receiver_identi`, `delivery_identi`, `isdelivered`, `sender_name`, `date`, `isevaluate`) VALUES
(101, 100, 100, '의류', 1, 51, 0, '김민수', '2014/05/28', 1),
(200, 200, 200, '전자기기', 1, 51, 1, '김수민', '2014/05/29', 0),
(300, 300, 300, '도서', 1, 53, 2, '고세원', '2014/05/27', 1),
(400, 400, 400, '가구', 1, 54, 0, '김준호', '2014/06/02', 0),
(500, 500, 500, '도서', 2, 51, 0, '전영우', '2014/05/27', 0),
(600, 600, 600, '도서', 3, 53, 0, 'Tiffany', '2014/06/08', 0),
(700, 700, 700, '가구', 5, 54, 0, 'Ryan', '2014/06/06', 0),
(800, 800, 800, '전자기기', 5, 52, 1, 'Bryan', '2014/06/02', 0),
(900, 900, 900, '가구', 0, 55, 1, 'Rebecca', '2014/05/30', 0),
(1000, 1000, 1000, '도서', 0, 53, 0, '서민석', '2014/05/28', 0),
(1100, 1100, 1100, '도서', 0, 52, 1, '최록산', '2014/05/27', 0),
(1200, 1200, 1200, '운동화', 6, 51, 2, '곽원석', '2014/06/16', 1),
(1300, 1300, 1300, '미용도구', 7, 51, 2, '김유니', '2014/06/15', 0),
(1400, 1400, 1400, '도서', 8, 51, 2, '신푸른', '2014/06/14', 0),
(1500, 1500, 1500, '사무용품', 9, 51, 2, '김소언', '2014/06/12', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `deliveryinfo`
--

CREATE TABLE IF NOT EXISTS `deliveryinfo` (
  `identi_num` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone_num` text NOT NULL,
  `income` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `deliveryinfo`
--

INSERT INTO `deliveryinfo` (`identi_num`, `name`, `phone_num`, `income`) VALUES
(51, 'Joe', '01042318864', 5000),
(52, 'Jack', '01096454358', 10000),
(53, 'Lebecca', '01012315344', 7000),
(54, 'Robinson', '01043888353', 8000),
(55, 'Ryan', '01043833363', 15000),
(56, 'Tiffany', '01032435665', 100),
(57, '최진성', '01015425534', 5000),
(58, '김용완', '01088653285', 6000),
(59, '박재호', '01099783588', 7000);

-- --------------------------------------------------------

--
-- 테이블 구조 `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `evaluation_info` text NOT NULL,
  `courier_identi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `evaluation`
--

INSERT INTO `evaluation` (`evaluation_info`, `courier_identi`) VALUES
('thanks', 101),
('감사합니다', 300),
('감사영', 1200);

-- --------------------------------------------------------

--
-- 테이블 구조 `logininfo`
--

CREATE TABLE IF NOT EXISTS `logininfo` (
  `id` text NOT NULL,
  `password` text NOT NULL,
  `identi_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `logininfo`
--

INSERT INTO `logininfo` (`id`, `password`, `identi_num`) VALUES
('rooot', 'admin', 1),
('abc', '123', 51),
('qwer', '123', 3),
('fani', 'haha', 2),
('junhoya', 'jhjh', 4),
('qaz', '442', 5),
('asbf', '4ww3', 52),
('57te', 'asd3', 53),
('d244e', '536', 54),
('dani', 'h89', 55),
('jun', '123', 56),
('111', '222', 6),
('w453', '1534', 57),
('g4hh', '5654', 58),
('fg24', '9978', 59),
('qdd3', '1443', 7),
('zr23', '4465', 8),
('ffd2', '7887', 9),
('qwe22', '2232', 10);

-- --------------------------------------------------------

--
-- 테이블 구조 `nonmemberinfo`
--

CREATE TABLE IF NOT EXISTS `nonmemberinfo` (
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `courier_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `nonmemberinfo`
--

INSERT INTO `nonmemberinfo` (`name`, `phone`, `address`, `courier_num`) VALUES
('박민수', '01023443565', '서울특별시 강동구 명일1동 327-6', 900),
('서원준', '01025603665', '서울특별시 마포구 아현동 677', 1000),
('이원준', '01018864899', '서울특별시 종로구 삼청동 102', 1100);
--
-- 데이터베이스: `test`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
