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
-- 테이블 구조 `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `idno` varchar(15) NOT NULL,
  `name` varchar(10) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `hit` int(11) DEFAULT '0',
  `file_name_0` varchar(100) DEFAULT NULL,
  `file_copied_0` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- 테이블의 덤프 데이터 `review`
--

INSERT INTO `review` (`no`, `idno`, `name`, `subject`, `content`, `password`, `date`, `hit`, `file_name_0`, `file_copied_0`) VALUES
(54, 'fdfdfd123', '김영희', '먼 길을 왔는데', '안 왔으면 후회했을 것 같은 그런 행사였습니다. \r\n신나는 슈퍼키드의 음악이 아직도 들리는듯 합니다.', 'a12345', '2015-08-18 11:32:00', 8, '', ''),
(55, 'mcthedm', '최성훈', '아무것도 안하고 싶다', '아무것도 안하고있지만 더 격렬하게 아무것도 하고싶지않다\r\n집에가서 치킨 먹어야지 힝힣힣', '1234', '2015-08-18 11:32:46', 3, '', ''),
(51, 'hong123', '이홍기', '락페란 이런것이다', '라는 것을 잘 보여준 락페가 아닐까 합니다.\r\n\r\n3명의 헤드라이너+십수개의 팀이 있어야 락페는 아니잖습니까 중요한건 음악과 관객의 조화가 아닐까 합니다. 음악과 관객이 어우러지는 훌륭한 락페였습니다.', 'a12345', '2015-08-18 11:30:00', 12, '', ''),
(52, 'hong123', '이홍기', '오랜만에 좋은 공연 잘 봤습니다.', '친한 동생이 이 행사 꼭 가보라고 해서 갔었는데 학창시절에 스쿨밴드에서 베이스를 치던 생각이 나며 저에게도 아직 락음악을 들으면 뜨거워지는 피가 아직 흐르는 것을 재확인 했습니다.\r\n\r\n덕분에 당일날 뮤지션들의 모든 굿즈를 구매했지요 후후후\r\n\r\n오랜만에 베이스를 다시 잡아봐야겠습니다.', 'a12345', '2015-08-18 11:30:23', 8, '', ''),
(53, 'myadmin', '에드민', '이번에 같이 갈 파티워 모집함', '혼자가긴 싫고 가고는 싶고 둘이가곤 싶고 둘은 없고 셋은 셋이지 넷이겠느냐 넷이면 넷이지 다섯이겟느냐 다섯이면 다섯이지 그러니깐 같이가자!', '1234', '2015-08-18 11:30:39', 3, '', ''),
(47, 'mcthedm', '최성훈', '나도 가고싶닭', '하지만 인천이라 멀어서 못간다능 ㅠ', 'a123456', '2015-08-18 11:26:23', 6, '', ''),
(48, 'hodam', '김호담', '평일에도 하다니 대단하군요', '정말 대단 우왕 꿍따리 샤바라 빠빠빠\r\n신기방기 얄리얄리얄라셩 ㅋㅋ', '1234', '2015-08-18 11:27:22', 9, '', ''),
(49, 'hodam', '김호담', '물폭탄 준비해주세요', '버킷으로 통쨰로 부어드림 우리집 물대포집함 \r\n헿헤헿헿 다음달엔 안더웠음 좋겟닭', '1234', '2015-08-18 11:28:07', 5, '', ''),
(46, 'zener', '이고은', '작년 캠핑존에서 치맥 후 공연감상 후기!! ', '캠핑존까지 치킨 배달 잘와요! \r\n\r\n치킨 든든하게 먹고 저녁공연 참여해보세요 \r\n\r\n같이 때창하려면 역시 닭으로 충전을!', 'a123456', '2015-08-18 11:18:07', 5, '', '');
