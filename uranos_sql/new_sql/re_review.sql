-- phpMyAdmin SQL Dump
-- version 3.2.2
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 15-08-18 11:38 
-- 서버 버전: 5.1.73
-- PHP 버전: 5.5.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `uranos`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `re_review`
--

CREATE TABLE IF NOT EXISTS `re_review` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(15) NOT NULL,
  `id` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 테이블의 덤프 데이터 `re_review`
--

INSERT INTO `re_review` (`no`, `parent`, `id`, `password`, `name`, `content`, `date`) VALUES
(59, '54', 'fdfdfd123', '', '', '슈퍼키드는 처음 봤는데 정말 에너지 넘치네요!!덕분에 좋은 기운 받아가는것 같아욬ㅋㅋㅋㅋㅋ 저도 아직가지 신납니다~~~~~', '2015-08-18 11:33:25'),
(60, '52', 'fdfdfd123', '', '', '와 멋있으시네요!!', '2015-08-18 11:33:46'),
(58, '52', 'titikaka', '', '', '굿즈!!! 많이 나왔나요 ㅠㅠ 월급 말일에 예매까지 하느라 굿즈는 보지도 못했는데', '2015-08-18 11:33:10'),
(56, '54', 'titikaka', '', '', '무대에서 방방 뛰는데 완전 귀여웠어요!!!!!', '2015-08-18 11:32:23'),
(57, '51', 'fdfdfd123', '', '', '슈퍼키드는 처음 봤는데 정말 에너지 넘치네요!!덕분에 좋은 기운 받아가는것 같아욬ㅋㅋㅋㅋㅋ 저도 아직가지 신납니다~~~~~', '2015-08-18 11:32:33'),
(53, '51', 'zener', '', '', '흑 ㅠㅠ 음반나온거 통째로 다 불러주고 갔으면 좋겠어요 공연시간이 짧아요', '2015-08-18 11:30:57'),
(54, '51', 'myadmin', '', '', '네 다음분', '2015-08-18 11:31:00'),
(55, '48', 'myadmin', '', '', '주말에도 하더라구요  전 주말에 갑니다.', '2015-08-18 11:31:21'),
(49, '46', 'hodam', '', '', '충전은 닭이지요', '2015-08-18 11:25:55'),
(50, '47', 'zener', '', '', 'ㅠㅠㅠ땅이라도 파서 오라능 ㅠㅠ ', '2015-08-18 11:28:23'),
(51, '48', 'zener', '', '', '평일에 하면 ㅠㅠ 직장인은 어쩌죠 ㅠㅠ ', '2015-08-18 11:28:57'),
(52, '49', 'zener', '', '', '+ 불쇼도 추천합니다!!!! 람슈타인정도 와야 불쇼하나요 ', '2015-08-18 11:29:29');
