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
-- 테이블 구조 `reserlist`
--

CREATE TABLE IF NOT EXISTS `reserlist` (
  `no` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `stdate` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `reserlist`
--

INSERT INTO `reserlist` (`no`, `subject`, `stdate`, `password`, `content`) VALUES
(6, '9월의 시작 6회차 예매', '2015-09-05', '1234', '9월 첫주에 시작되는 uranos 페스티벌에 참여하는 스페셜 게스트는 크라잉넛과 노브레인 그리고 펑크락의 문화를 추구하고 전파하는 오리지널 펑크 까지 함꼐 가세하여 더욱 즐거운 퍼포먼스를 즐기실수 있습니다!'),
(3, '3회차 예매 시작', '2015-08-23', '1234', '이번 3회차에는 특별게스트로 sum41과 paramore 가 참여할 예정입니다. 까메오로 출연한다고하니 관객들 사이에 숨어있는 가수들을 찾아보세요!'),
(4, '4회차 예매 시작', '2015-08-23', '1234', '4회차 예매가 시작되었습니다. \r\n특별게스트로는 로맨틱 펀치와 그룸 피아가 추령ㄴ할 예정이오니 많은 예매 바랍니다!'),
(5, '8월의 마지막 5회차 예매 시작', '2015-08-30', '1234', '8월의 마지막 uranos페스티벌입니다. 이번 5회차 야간에는 일렉트로닉 클럽 파티가 진행될 예정이오니 많은 참여 바랍니다'),
(1, '대망의 1회차 예매시작!', '2015-08-19', '1234', '드디어 uranos 페스티벌이 1회차를 맞게되었습니다.\r\n오프닝 행사민 야간에는 불꽃놀이도 진행할 예정이오니 많은 참여 부탁드립니다!'),
(2, '무더위를 날려버릴 uranos 페스티벌 2회차!', '2015-08-22', '1234', '푹푹찌는여름 시원하게 날려버릴 uranos 페스티벌 2회차 예매가 시작되었습니다.\r\n이번 2회차에는 물폭탄 및 물총 싸움이 있을 예정입니다!');
