-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 21-02-11 15:02
-- 서버 버전: 5.7.32
-- PHP 버전: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `sionsion`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--


--
-- 테이블 구조 `ci_sessions`
--
USE sionsion;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(40) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `clubbymember`
--

CREATE TABLE `clubbymember` (
  `id` int(11) NOT NULL,
  `clubname` varchar(20) DEFAULT NULL,
  `studentid` int(10) NOT NULL,
  `info_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubbymember`
--

INSERT INTO `clubbymember` (`id`, `clubname`, `studentid`, `info_id`) VALUES
(19, '께뮤', 2019102812, 26),
(18, '께뮤', 2017100582, 26),
(17, '께뮤', 2019100917, 26),
(16, '셜록', 2018100861, 38),
(15, '바람개비', 2019101191, 34),
(14, '바람개비', 2019100618, 34),
(13, '바람개비', 2016100982, 34),
(20, '께뮤', 2018103103, 26),
(21, 'HEXA', 2018101330, 6),
(22, 'HEXA', 2016100725, 6);

-- --------------------------------------------------------

--
-- 테이블 구조 `clubhead`
--

CREATE TABLE `clubhead` (
  `id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `headid` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `department` varchar(10) DEFAULT NULL,
  `headname` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubhead`
--

INSERT INTO `clubhead` (`id`, `info_id`, `headid`, `password`, `department`, `headname`, `email`) VALUES
(6, 35, '2018100912', '$2y$10$5umjJOjvu6Oq8TGmxj30W.FzHWNkddB/UCav7qVVMUZmK.XFCwQFG', '산업경영공학과', '손영은', 'son970523@naver.com'),
(8, 34, '2018105089', '$2y$10$WRDVP0SLYH7KVaUqg.VWjejG8vaLbiXuJjUYinI4WYgUkRJIc9BMe', '태권도학과', '이종민', 'zi_kevin1004@naver.com'),
(7, 100, 'admin', '$2y$10$xeZzBKXIZ5S3ZcExeBYaNezEXTFiKit8ZzO3EsD3g5BclRd38Ylka', '산업경영공학과', '신시언', 'coolguysiun@naver.com'),
(9, 38, '2018103371', '$2y$10$hQY2xwE6AULA3Aci.ERmOu7/gyn5lcBU5RJNswtKdp0PqtgCVSYBK', '응용화학과', '이성준', 'ldg1103@naver.com'),
(10, 41, '2019104773', '$2y$10$u/E0V3w2Xu103cAzLOk1uOLAPPjOovNYHJCRRRKxGdpTYPhXeUNR6', '스포츠의학과', '윤이수', 'DBSDLTN000@KHU.AC.KR'),
(12, 10, '2017102791', '$2y$10$HP2ELhriaYG4Qvn0/LsYBeIUKx0CQtX.8bVdcQxGzS78A37zDDFSm', '중국어학과', '혜정', 'scw05017@naver.com'),
(13, 26, '2019102093', '$2y$10$UBhUlr/9pv/CcWFwAyc44e9MUV9GuPJcqN2EafxhlpR4EuwbALdI.', '소프트웨어융합학과', '명승준', 'msj9518@gmail.com'),
(14, 6, '2019102528', '$2y$10$FJyAt29PYPT7JiL7W0YJVuEUjsG4g/SyJaI9FFLX/UxZpHjJ.7BX.', '시각디자인학과', '김지향', 'sa2644@naver.com');

-- --------------------------------------------------------

--
-- 테이블 구조 `clubinfo`
--

CREATE TABLE `clubinfo` (
  `c_name` varchar(10) NOT NULL,
  `c_dept` varchar(5) NOT NULL,
  `c_cont` text,
  `pic_path` varchar(70) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubinfo`
--

INSERT INTO `clubinfo` (`c_name`, `c_dept`, `c_cont`, `pic_path`, `id`) VALUES
('BMB', '연행', '본 회는 경희대학교 댄스동아리로서 여러 가지 장르의 춤을 추며 멤버들이 원하는 장르에 대해 춤을 배우고 가르쳐 줄 수 있다. 대학생활에 춤을 좋아하는 학생들의 취미생활을 도모할 수 있으며 대학문화에 큰 힘이 되기 위해 만들어졌다.', 'https://jajudy.khu.ac.kr/club/cover/404', 1),
('CBA', '종교', 'CBA는 Campus Berea Academy로서 캠퍼스에서 하나님의 말씀을 체험하고, 이천년전과 동일하게 하나님의 살아계심을 증거하는 초교파적 선교단체이다.', 'https://jajudy.khu.ac.kr/club/cover/418', 2),
('CCC', '종교', '주님의 지상명령을 성취를 적극적으로 돕고자 하는 성령충만한 그리스도의 운동을 일으키기 위해, 스스로를 훈련하며 사람들을 훈련시키고, 또 이 운동을 다음 세대에 전수시키는 것이다.', 'https://jajudy.khu.ac.kr/club/cover/420', 3),
('Finder', '전시창작', '본회는 사진을 사랑하는 사람들의 순수예술욕망을 충족시키고, 서로간의 친목을 도모하는 자율적인 단체이다.', 'https://jajudy.khu.ac.kr/club/cover/415', 4),
('HAMA', '취미교양', '본 동아리는 클로즈업, 팔러, 스테이지 등 다양한 분야의 마술에 대한 연구와 연습, 시연, 체험 및 관찰을 바탕으로 동아리원의 마술 실력을 향상하고, 이를 통해 공연자로서의 경험과 즐거움을 가지게 하며, 또한 동아리원간의 친목 도모를 통해 공동체적 가치 실현을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/449', 5),
('HEXA', '연행', '본회의 목적은 클래식 기타 연주로 회원마다 정서생활을 영위하고 회원간의 친목을 도모하는 데 있습니다. :) 편안한 분위기의 헥사로 환영합니다!', 'https://jajudy.khu.ac.kr/club/cover/410', 6),
('IVF', '종교', '본회는 기독대학생으로서 신앙적 결합을 도모함과 공동체상호간의 친목을 도모하고 공동체 내 섬김과 전도, 자아성찰에 힘쓰며, 기독교 세계관을 전수하고, 하나님나라를 살아내는 그리스도인을 양성해 가는 기독대학생으로서 이 사명을 다하는 것을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/417', 7),
('KADA', '취미교양', '과거 본회는 변화하는 시대에 적합한 인재육성을 위한 컴퓨터학술 동아리였으나 시대가 변화함에 따라 컴퓨터는 기본 소양이 되었고, 이에따라 대부분의 학생들이 컴퓨터를 다룰 줄 안다고 판단하였다. 또한 동아리 모람 전공 및 흥미 다양화와 심화교육이 가능한 인재부족 등의 사유로 인해 동아리 목적변경을 하게되었다. 취업난으로 인해 이시대의 학생들은 주입식 획일화 교육을 받으며 점차 개성을 잃어 가고 있다. 이에 영화, 책, 연극, 뮤지컬, 전시회 등 타인의 생각이 반영된 창작물을 함께 경험한 후 동아리 모람이 생각의 폭을 넓힐 수 있도록 하며 토론 및 토의를 통해 다양성을 인정할 수 있도록 한다.', 'https://jajudy.khu.ac.kr/club/cover/448', 8),
('KHUCC', '체육', '본 클럽은 스포츠 클라이밍을 통하여 회원 상호간의 친목을 도포하고 ,회원의 건강관리와 기량함양에 기여함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/6866', 9),
('KUCO', '연행', '본회는 서양고전음악의 악기연주를 통한 고전음악에 대한 이해를 바탕으로 다양한 음악을 통해 본 회 회원의 정서, 교양의 함양과 나아가 연주회를 통한 건전한 대학문화의 창조, 발전에 기여함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/407', 10),
('Newsweek', '학술', '본회는 Newsweek지를 자율적인 발표, 토론을 통해 영어 실력 향상과 지성인으로서 가치관과 세계관을 정립하고 폭넓은 인간관계 속에서 회원 상호간의 유대를 강화하여 사회적 능력을 기르며 더 나아가 인류사회 문화 발전에 기여할 지도자로서 공동체의식과 함께 훌륭한 인격과 독창적인 능력을 함양하는데 그 목적을 둔다.', 'https://jajudy.khu.ac.kr/club/cover/460', 11),
('Rap-in', '연행', '경희대학교 재학생 중 힙합 및 흑인문화에 관심 있는 자들의 친목도모 및 실력향상을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/402', 12),
('Regulus', '전시창작', '경희대학교 유일 스포츠매거진 REGULUS(레굴루스)는 2013년에 창간된 스포츠매거진동아리이다.', 'https://jajudy.khu.ac.kr/club/cover/17110', 13),
('SNAP', '체육', 'SNAP은 아마추어 농구동호회간의 발전과 화합, 나아가 한국과 전 세계의 농구를 통한 화합과 인류평화의 실현을 위해 활동한다.', 'https://jajudy.khu.ac.kr/club/cover/427', 14),
('T3', '체육', '본 회는 탁구를 통한 건강기능향상 및 친목 도모 및 대회출전을 통한 성취감 고양을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/424', 15),
('TUSI', '학술', '본 동아리는 로켓의 연구 및 저변 확대를 위해서 연구함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/462', 16),
('UP', '학술', 'MS Power Point, Prezi, Keynote 등을 활용한 \'프레젠테이션 능력의 전문성 강화\'를 통해 시대가 요구하는 \'명품 인재 육성\'을 그 목표로 한다.', 'https://jajudy.khu.ac.kr/club/cover/464', 17),
('VIP', '학술', '본 회의 목적은 회원들이 가지고 있던 아이디어들을 현실화시키고 여러 공모전등을 통해 해당 아이디어를 창업 및 특허출원 하는 데에 있다.', 'https://jajudy.khu.ac.kr/club/cover/455', 18),
('Young감', '취미교양', '본 동아리의 목적은 전문 강연이 아닌 평범한 대학생이 가벼운 주제인 ‘취미’를 선정하여 동아리 회원들 앞에서 강연을 기획 실행하는 것이다. ‘취미강연’을 통한 현실화와 구체화는 물론, 동기부여를 얻으며 후에 동아리 회원들과의 토의를 통해 정보를 공유하며 나에 대한 영감을 얻고자 한다.', 'https://jajudy.khu.ac.kr/club/cover/10863', 19),
('가스펠', '종교', '1. 음악선교 대학복음화 2. 문화선교 세계복음화 3. 순결한 복음의 확립과 복음의 선포 4. 회원의 영적 성장 및 회원과의 교제	', 'https://jajudy.khu.ac.kr/club/cover/421', 20),
('검도부', '체육', '경희대 검도부는 검도를 통하여 심신을 단련하고 부원간의 친목을 도모함으로써 풍요로운 대학생활을 추구하는 아마추어 단체이다.', 'https://jajudy.khu.ac.kr/club/cover/430', 21),
('경희극회', '연행', '본회는 역사적으로 부여받은 대학인의 창의정신을 기반으로 하여 냉철한 시대적 사회, 문화, 예술 발전 법칙에 기여함을 내용으로 하고, 대학인으로서 선진적인 형식상의 다변화와 실험정신을 가진 연극 전반활동을 수행함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 22),
('경희라이온스', '체육', '본 회의 목적은 대학인으로서의 야구실력 향상과 이를 통한 체력증진, 건강을 유지하고 물론 회원 상호간의 인간적 유대관계를 갖는데 그 목적을 둠을 물론이며 동아리에 유대감을 형성하기 위해 힘쓴다.', 'https://jajudy.khu.ac.kr/club/cover/425', 23),
('고은대', '사회', '전반적인 사회복지에 관한 연구 및 실질적인 활동을 통해 건전한 대학생활과 사회봉사를 병행하는 인간미 가득 찬 한가족 의식을 지향하는데 그 목적이 있다.', 'https://jajudy.khu.ac.kr/club/cover/398', 24),
('교정체조', '체육', '본 동아리는 체조에 대해 무지한 사람들도 기본적인 몸풀기 동작과 스트레칭 몸소 익힐 수 있도록 합니다. 또한 핸드스프링, 백핸드 등과 같은 난이도 있는 기술도 경희대학교 체조부 선수들에게 직접 배워서 체조에 대한 기능을 함양시킬 수 있도록 합니다.', 'https://jajudy.khu.ac.kr/club/cover/6442', 25),
('께뮤', '연행', '뮤지컬을 통해 대학문화 활동에 기여하고, 서로의 친목을 도모한다.', 'https://jajudy.khu.ac.kr/club/cover/403', 26),
('네비게이토', '종교', '경희대학교 국제캠퍼스 네비게이토는 스포츠를 매개체로 선교한다.', 'https://jajudy.khu.ac.kr/club/cover/416', 27),
('드레포스', '학술', '드레포스는 스포츠마케팅에 대한 열정과 노력을 모아 스포츠마케팅의 발전을 이루는 근간을 마련하고 나아가 스포츠마케팅을 움직이는 원동력이 되어 스포츠산업의 번영에 이바지하는 것을 목표로 하며, 정기 스터디와 선배님들과의 교류, 타 학교와의 연합을 통한 정기 교류, 세미나 개최를 통해 스포츠 마케팅 산업에 필요한 이론 지식과 실무 경험을 쌓는것에 목적을 둡니다.	', 'https://jajudy.khu.ac.kr/club/cover/463', 28),
('등대', '사회', '본회의 활동인 독거노인 봉사를 통하여 회원 각자의 자아발전과 사랑, 협동, 봉사, 창조의 정신을 함양하고 지도자적인 인격형성으로 보람있는 대학생활을 영위함을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/6827', 29),
('라이너스', '취미교양', '1. 회원들간의 친목을 도모한다. 2. 회원들의 기술을 향상 시킨다. 3. 사회봉사활동에 적극 참여한다. 4. 우리의 자질을 향상시키며 대외적인 홍보활동에 힘쓴다.', 'https://jajudy.khu.ac.kr/club/cover/451', 30),
('라크로스', '체육', '본 회는 Lacrosse를 통해 회원들의 친목 도모, 신체적· 정신적 단련을 통한 한국 Lacrosse의 발전을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/433', 31),
('러비스', '체육', '본 클럽은 테니스를 통하여 회원 상호간의 친목을 도모하고, 상부상조하며, 회원의 건강관리와 기량함양에 기여함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/432', 32),
('만화통신', '전시창작', '본 회의 목적은 만화에 대한 전반적인 활동과 멀티미디어로써의 만화에 대한 지식 및 기술 함양과, 회원 상호간의 인간적 유대관계를 갖는 것이다.', 'https://jajudy.khu.ac.kr/club/cover/414', 33),
('바람개비', '연행', '대중음악을 좋아하는 사람들끼리 만나 노래를 완성시켜 나가 공연을 서는 것을 목적으로 하며 준비 과정에 있어서 친목을 도모한다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 34),
('보금자리', '사회', '동물을 사랑하는 사람들끼리 모여 유기견보호소 봉사활동과 같은 실질적인 실천활동을 통해 동물보호에 대한 의식을 함양하고, 친목도모를 하는 것을 목적으로 한다.', 'https://jajudy.khu.ac.kr/image/6125e38247f7e935.png', 35),
('빛사냥', '전시창작', '본 회의 목적은 영화 창작을 통하여 영화라는 예술에 대한 이해를 도모하며 친목을 돈돈히 함은 물론 회원 간의 친목을 토대로, 활기찬 학교생활을 하기 위함을 그 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/412', 36),
('산틀', '전시창작', '본 회는 미술에 대한 이해와 미술인으로서의 전문적인 지식과 기술을 습득하며, 미술 지식의 교류를 통한 정서 생활의 함양과 회원 상호간의 친목을 도모하는 것을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/413', 37),
('셜록', '취미교양', '본 동아리는 보드게임, 크라임씬 방탈출 등의 다양한 활동을 통하여 동아리원의 친목도모를 1차목표로 하며, 그 이외에도 회원간의 친목도모 등을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/8574', 38),
('소샥', '체육', '1. 우리 회원은 스쿠버 다이빙을 통해 다져진 자연사랑과 모험 정신을 바탕으로 선후배간의 정과 신뢰를 바탕으로 모인다. 2. 회원간의 친목도모와 더불어 선후배간의 우의 증진을 도모한다.', 'https://jajudy.khu.ac.kr/club/cover/428', 39),
('소행성 B-612', '취미교양', '천체관측을 통한 정서함양을 바탕으로 각 회원 상호간의 인격도야와 친목도모 및 형제적 우애를 고양함을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/452', 40),
('손짓사랑회', '사회', '본 동아리의 목적은 회원 상호간의 친목도모와 수어의 아름다움을 널리 알리는 데에 있다. 농아들의 마음을 이해하며 봉사와 수화의 보람을 느끼는 동아리.', 'https://jajudy.khu.ac.kr/club/cover/400', 41),
('스왈링', '취미교양', '1. 회원간의 친목을 도모한다. 2. 회원들의 지식 및 기술을 향상시킨다. 3. 교내 및 사회활동에 적극 참여한다. 4. 우리의 자질을 향상시키며 대외적인 홍보활동에 힘쓴다. 5. 다양한 술을 접하고 즐기며 배운다.', 'https://jajudy.khu.ac.kr/club/cover/453', 42),
('아뉴스데이', '종교', '본회는 올바른 그리스도인의 상을 정립하고, 참 그리스도인으로 이웃에 대한 사랑의 실천을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/422', 43),
('아마축구', '체육', '본 동아리는 학우들의 친목도모 및 운동을 통한 운동능력 향상과 건강증진을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/445', 44),
('어택라인', '체육', '어택라인 배구동아리는 배구를 좋아하는 학생들이 모여 회원간의 친목을 도모하고 정신적,신체적 건강을 증진한다.', 'https://jajudy.khu.ac.kr/club/cover/17200', 45),
('요트부', '체육', '본 클럽은 요트 세일링을 통하여 회원 상호간의 친목을 도모하고 이익을 증진하고 체계적인 사업을 통해 지속적인 발전을 도모하여 해양스포츠 문화를 선도한다.', 'https://jajudy.khu.ac.kr/club/cover/426', 46),
('우리말메아리', '학술', '본 회의 목적은 대한민국 국민으로서의 국어 실력향상과 애국심을 키움은 물론 모람 상호간의 인간적인 유대관계를 갖는데 그 목적을 두며 또한 학교의 면학분위기 조성에 힘쓴다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 47),
('유니피스', '학술', '유니피스는 회원들과의 친목도모, 그리고 교내.외 평화활동을 그 목표로 한다.', 'https://jajudy.khu.ac.kr/club/cover/461', 48),
('유혼', '체육', '유도라는 운동을 통해서 서로 몸과 정신을 단련하여 건강한 인간으로 거듭나는 것, 체육대학 뿐만 아니라 다른 단과대학과 친목도모를 할 수 있다.', 'https://jajudy.khu.ac.kr/club/cover/446', 49),
('청춘별곡', '연행', '<청춘별곡>은 매학기 전문적인 보컬 트레이너들을 초빙해 레슨을 진행함과 동시에 버스킹이나 노래대회참가와 같은 음악활동을 진행하여 실제 음악활동을 즐길 수 있게 기획하고 진행하는 동아리이다. 실력과 무관하게 노래를 좋아하고 열정있는 학우들을 대상으로 한다. 꼭 레슨에 참여하지 않아도 버스킹, 축제 등과 같은 활동에 참여하거나 함께 여행을 가서 보컬활동을 하는 등 친목을 도모하고 있다. 보컬 능력 향상 및 취미 활동 활성화에 초점을 두고 동아리 활동을 진행한다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 50),
('캘리램프', '전시창작', '본 회는 ‘캘리그라피’라는 활동을 통해 ‘생활 속 예술’이라는 이름으로 예술에 대한 친밀도를 높이는 데 기여한다. 또한 정기적인 활동을 통해 회원들의 실력 향상과 친목 도모를 이룰 수 있다. 학교 행사에 참여하면서 생긴 순수익을 기부함으로써 더 밝은 세상을 만들 수 있게 노력할 것이다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 51),
('쿠러그', '학술', '\"쿠러그\"는 세상의 모든 IT 기술 및 이와 관련된 분야에 대한 연구 및 개발 활동을 주 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/456', 52),
('쿠마', '체육', 'KHU와 Marathon을 합쳐서 만들어진 쿠마는 경희대학교 국제캠퍼스의 마라톤 동아리입니다.', 'https://jajudy.khu.ac.kr/club/cover/16048', 53),
('쿠키', '사회', '본 회는 재난 발생으로 인해 도움이 필요한 이웃들에게 희망 나눔을 실천한다. 자연 재해 및 인재 등 재난이 발생할 시, 즉각적으로 피해 지역에 투입될 수 있는 인력을 기르는 데 그 목적이 있다. 비재해 상황 시, 정기적으로 집수리 봉사활동과 물품 전달 봉사활동을 통해 나눔을 실현한다. 또, 본교 및 타 대학과의 활발한 친목도모를 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/401', 54),
('탈무드', '연행', '본회는 락밴드 동아리로서 음악에 대한 실력증진과 팀활동을 통한 멤버십 등 통상 밴드에 부합한 활동을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/409', 55),
('태백', '체육', '우리는 24반 무예수련과 여럿이 함께 하는 생활을 통해 민족정신을 구현하며, 민족 무사가 됨을 목표로 한다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 56),
('통일열차', '학술', '남북의 역사, 제도, 문화 등 다양한 분야에 대해 탐구하고 다양한 실천과 교류를 통해 남북의 평화와 번영, 통일을 실현하는 것 등을 목적으로 한다.', 'https://jajudy.khu.ac.kr/images/no_image.png', 57),
('평화나비', '사회', '본 회는 일본군 ‘위안부’ 문제 해결을 최우선 목표로 하며 대한민국은 물론 세계의 진정한 반전평화와 보편적 인권의 가치를 지켜내고자 하는 대학생들의 단체이다.', 'https://jajudy.khu.ac.kr/club/cover/396', 58),
('프리스타일', '체육', '안녕하십니까 경희대 수영동아리 프리스타일입니다. 저희는 경희대학교 유일의 수영동아리입니다. 수영은 대표적인 생활스포츠로써 배우게 되면 평생을 즐길 수 있는 운동입니다. 특히 물속에서 운동을 하기 때문에 부상위험이 적고 몸의 큰 무리가 가지 않습니다. 그렇기 때문에 다른 운동과 달리 오랜시간동안 수영을 하실 수 있습니다. 또한 대표적인 자격증으로는 생활체육자격증, 라이프가드자격증이 있습니다. 이를 취득하게 되면 수영강사 등 관련된 일을 하실 수 있습니다.', 'https://jajudy.khu.ac.kr/club/cover/6900', 59),
('하이클리어', '체육', '본회의 모임은 배드민턴 실력향상과 건강관리는 물론 배드민턴을 통해 친목을 도모하고 교제를 나누며 회원간의 상호협력을 목적으로 한다.', 'https://jajudy.khu.ac.kr/club/cover/447', 60);

-- --------------------------------------------------------

--
-- 테이블 구조 `clubmember`
--

CREATE TABLE `clubmember` (
  `id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `studentid` int(10) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `department` varchar(10) DEFAULT NULL,
  `grade` int(1) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `clubname` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubmember`
--

INSERT INTO `clubmember` (`id`, `info_id`, `studentid`, `username`, `password`, `department`, `grade`, `gender`, `clubname`) VALUES
(17, 38, 2018100861, '차윤선', '$2y$10$mFEiWOVJkg/fNwVtIg0zfev7jjDVLOtxJyO3IrXZ6gGGgmtJhB70S', '사회기반시스템공학과', 3, '0', '셜록'),
(14, 34, 2016100982, '임수빈', '$2y$10$8.GKxDTp9sfMprsK9oTvD.R1BuapVPbkANzKYbnJFgpMmI0ROWjgm', '산업경영공학과', 3, '1', '바람개비'),
(15, 34, 2019100618, '강준모', '$2y$10$BAPrHMZVWuJ91Sxb8THRuelWVzKzavVf/EOBRywrO9C8KOLwOdKJC', '기계공학과', 2, '1', '바람개비'),
(16, 34, 2019101191, '김예지', '$2y$10$WXpnJBFj.MvA1Vh8SWrp2e8OSN2YbbbvHQ1rSUNTWB0bn..CI7QEO', '국제학과', 2, '0', '바람개비'),
(18, 26, 2019100917, '강희민', '$2y$10$1gFTx4QMYLq.IkHijwPraOno8qQ/gEm8BDwrIRfiAFf2GTRrLfi26', '원자력공학과', 2, '1', '께뮤'),
(19, 26, 2017100582, '김예지', '$2y$10$dnXCotpnN7kdN6tnzaLBSe/pMG2KskDK2t7dSZwP64YYNxWuWya/a', '소프트웨어융합학과', 3, '0', '께뮤'),
(20, 26, 2019102812, '최해인', '$2y$10$yiJznBF5siKqHWW92eezj.pj8hsV5denVxKZMuG8dKvR24spoqwRa', '러시아어학과', 2, '0', '께뮤'),
(21, 26, 2018103103, '최승아', '$2y$10$bZQbkYel3QnDu9Z.2jZkLucwCeZWp7Z0PHckTYptSwZ9XzC4RenZS', '한국어학과', 3, '0', '께뮤'),
(22, 6, 2018101330, '한유빈', '$2y$10$9BGhE1Xkbovil.ULInyFdudezQ5ecKSw37Ei5DSmlk6RpOy6HWRsC', '국제학과', 3, '0', 'HEXA'),
(23, 6, 2016100725, '박승호', '$2y$10$N9qVvp1IKOqH3tasPa8QROsXLSEcrUJyoGLxqIGJ0LEbAnCmpzSnK', '기계공학과', 2, '1', 'HEXA');

-- --------------------------------------------------------

--
-- 테이블 구조 `clubpicture`
--

CREATE TABLE `clubpicture` (
  `pic_id` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `club_name` varchar(20) NOT NULL,
  `info_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubpicture`
--

INSERT INTO `clubpicture` (`pic_id`, `path`, `club_name`, `info_id`) VALUES
(11, '/images/bogeum06.jpg', '보금자리', 35),
(10, '/images/bogeum05.jpg', '보금자리', 35),
(6, '/images/bogeum02.jpg', '보금자리', 35),
(7, '/images/bogeum03.jpg', '보금자리', 35),
(8, '/images/bogeum04.jpg', '보금자리', 35),
(9, '/images/bogeum01.jpg', '보금자리', 35),
(14, '/images/1581322424446.jpg', '바람개비', 34),
(15, '/images/1581311683456.jpg', '바람개비', 34),
(16, '/images/1581053419133.jpg', '바람개비', 34),
(17, '/images/1574908644197.jpg', '바람개비', 34),
(18, '/images/1564735244740.jpg', '바람개비', 34),
(19, '/images/1559008246322.jpg', '바람개비', 34),
(110, '/images/1581303379567.jpg', '손짓사랑회', 41),
(111, '/images/everytime-1583916086366.jpg', 'KUCO', 10),
(112, '/images/everytime-1583916088405.jpg', 'KUCO', 10),
(113, '/images/everytime-1583916090364.jpg', 'KUCO', 10),
(114, '/images/everytime-1583916092542.jpg', 'KUCO', 10),
(115, '/images/everytime-1583916094523.jpg', 'KUCO', 10),
(116, '/images/everytime-1583916096548.jpg', 'KUCO', 10),
(117, '/images/everytime-1583916098596.jpg', 'KUCO', 10),
(118, '/images/everytime-1583916100621.jpg', 'KUCO', 10),
(125, '/images/KakaoTalk_20191124_135806364_03.jpg', 'HEXA', 6),
(126, '/images/KakaoTalk_20191124_135806364_08.jpg', 'HEXA', 6),
(127, '/images/KakaoTalk_20191124_135806364_09.jpg', 'HEXA', 6),
(128, '/images/KakaoTalk_20191204_145549400_01.jpg', 'HEXA', 6),
(129, '/images/KakaoTalk_20191204_145549400_03.jpg', 'HEXA', 6),
(130, '/images/KakaoTalk_20191204_145549400_07.jpg', 'HEXA', 6),
(131, '/images/KakaoTalk_20191124_135806364_03.jpg', 'HEXA', 6),
(132, '/images/KakaoTalk_20191124_135806364_08.jpg', 'HEXA', 6),
(133, '/images/KakaoTalk_20191124_135806364_09.jpg', 'HEXA', 6),
(134, '/images/KakaoTalk_20191204_145549400_01.jpg', 'HEXA', 6),
(135, '/images/KakaoTalk_20191204_145549400_03.jpg', 'HEXA', 6),
(136, '/images/KakaoTalk_20191124_135806364_03.jpg', 'HEXA', 6),
(137, '/images/KakaoTalk_20191124_135806364_08.jpg', 'HEXA', 6),
(138, '/images/KakaoTalk_20191124_135806364_09.jpg', 'HEXA', 6),
(139, '/images/KakaoTalk_20191204_145549400_01.jpg', 'HEXA', 6),
(140, '/images/KakaoTalk_20191204_145549400_03.jpg', 'HEXA', 6),
(141, '/images/KakaoTalk_20191204_145549400_07.jpg', 'HEXA', 6);

-- --------------------------------------------------------

--
-- 테이블 구조 `clubreview`
--

CREATE TABLE `clubreview` (
  `r_name` varchar(10) NOT NULL,
  `c_review` text,
  `c_score` int(11) NOT NULL DEFAULT '0',
  `c_dt` datetime DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `blame` int(11) DEFAULT '0',
  `recommend` int(11) DEFAULT '0',
  `info_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `ip_address` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `clubreview`
--

INSERT INTO `clubreview` (`r_name`, `c_review`, `c_score`, `c_dt`, `username`, `password`, `blame`, `recommend`, `info_id`, `id`, `ip_address`) VALUES
('BMB', '신나고 재밌어요', 2, '2020-01-02 14:55:55', 'unknown', 'su970728', 0, 0, 1, 1, NULL),
('BMB', '공연 준비를 위주로 하며 열정이 있는 사람들은 개인으로 더 연습함.\r\n', 3, '2020-01-02 14:58:16', 'unknown', 'su970728', 0, 0, 1, 2, NULL),
('BMB', '그냥 제가 좋아서 했습니당 :)\r\n', 5, '2020-01-02 14:58:40', 'unknown', 'su970728', 0, 0, 1, 3, NULL),
('BMB', '너무 좋아요ㅎㅎㅎ\r\n', 5, '2020-01-02 14:58:51', 'unknown', 'su970728', 0, 0, 1, 4, NULL),
('BMB', '사람들이 매우 활발해서 대학 생활에 큰 즐거움이 되었습니다.\r\n', 4, '2020-01-02 14:59:02', 'unknown', 'su970728', 0, 0, 1, 5, NULL),
('BMB', '장르마다 분위기가 다르지만 대부분 자유로운 분위기라서 편합니다!\r\n', 4, '2020-01-02 14:59:10', 'unknown', 'su970728', 0, 0, 1, 6, NULL),
('BMB', '적응하는데 자신감이 필요했지만 다들 좋은 사람들이었습니다\r\n', 5, '2020-01-02 14:59:23', 'unknown', 'su970728', 0, 0, 1, 7, NULL),
('BMB', '춤을 배울 수 있는 분위기라 좋았지만 뭔가 너무 다 따로 노는 듯한 분위기였습니다ㅠㅠ\r\n', 3, '2020-01-02 14:59:32', 'unknown', 'su970728', 0, 0, 1, 8, NULL),
('CBA', '좋은 동아리 같긴 한데...너무 재미없어요 사람들이 노잼 파티ㅠㅠ\r\n', 2, '2020-01-02 14:59:55', 'unknown', 'su970728', 0, 0, 2, 9, NULL),
('CCC', '자연스럽게 이끌어져 들어왔는데, 말씀과 성경공부 하기에 너무 좋은 동아리라고 생각합니다\r\n', 5, '2020-01-02 15:00:17', 'unknown', 'su970728', 0, 0, 3, 10, NULL),
('CCC', '주님의 사랑으로 보듬어주는 선배들이 있어서 너무 좋았습니다. 많은 학생이 와서 주님의 말씀을 들었으면 좋겠습니다. \r\n', 4, '2020-01-02 15:00:29', 'unknown', 'su970728', 0, 0, 3, 11, NULL),
('Finder', '같이 출사 나가는 거 너무 재미있어용', 5, '2020-01-02 23:13:44', 'unknown', 'su970728', 0, 0, 4, 12, NULL),
('Finder', '놀러다니는건 재밌었습니다\r\n', 2, '2020-01-02 23:18:21', 'unknown', 'su970728', 0, 0, 4, 13, NULL),
('Finder', '매주 되는 사람들끼리 모여 출사를 나갑니다. 정말 편하게 활동할 수 있어 좋습니다.\r\n', 3, '2020-01-02 23:18:31', 'unknown', 'su970728', 0, 0, 4, 14, NULL),
('Finder', '찰칵찰칵 너무 좋다~\r\n', 4, '2020-01-02 23:18:38', 'unknown', 'su970728', 0, 0, 4, 15, NULL),
('KADA', '술마시기 좋은 동아리다 근데 활동은 거의 안한다\r\n', 3, '2020-01-02 23:19:12', 'unknown', 'su970728', 0, 0, 8, 16, NULL),
('KADA', '술이 늘었습니다^-^\r\n', 4, '2020-01-02 23:19:19', 'unknown', 'su970728', 0, 0, 8, 17, NULL),
('KADA', '친목좋음ㅋㅋㅋ\r\n', 4, '2020-01-02 23:19:26', 'unknown', 'su970728', 0, 0, 8, 18, NULL),
('KADA', '친목하기는 좋음\r\n', 4, '2020-01-02 23:19:31', 'unknown', 'su970728', 0, 0, 8, 19, NULL),
('KHUCC', '자유로운 분위기라 나이에 상관없이 누구나 참여가능해서 좋았다.\r\n', 5, '2020-01-02 23:19:46', 'unknown', 'su970728', 0, 0, 9, 20, NULL),
('KHUCC', '자유롭게 정해진시간에 나와서 운동하고 가면 되고 입문비용도 운동동아리 치고 높지 않은편이라 부담도 덜 됩니다. 지도교수님도 계셔서 안전하게 운동할 수 있습니다\r\n', 4, '2020-01-02 23:19:54', 'unknown', 'su970728', 0, 0, 9, 21, NULL),
('UP', '발표도 많이 하고 사람도 많이 만나고 다만 좀 바쁘다\r\n', 5, '2020-01-02 23:20:23', 'unknown', 'su970728', 0, 0, 17, 22, NULL),
('UP', '배워가는것이 많은것 같아요! 분위기도 자유로워요\r\n', 4, '2020-01-02 23:20:28', 'unknown', 'su970728', 0, 0, 17, 23, NULL),
('UP', '활동을 열심히 해야 한다는 게 좋은데 빡세다\r\n', 4, '2020-01-02 23:20:37', 'unknown', 'su970728', 0, 1, 17, 24, NULL),
('Young감', '분위기가 자유롭고 다 두루두루 친한 사이라서 좋다\r\n', 4, '2020-01-02 23:21:14', 'unknown', 'su970728', 0, 0, 19, 25, NULL),
('Young감', '생각보다 동아리 활동들이 알차고 집중적으로 할 수 있어서 매우 만족스러워요\r\n', 5, '2020-01-02 23:21:26', 'unknown', 'su970728', 0, 0, 19, 26, NULL),
('Young감', '영감은 완벽한 동아리입니다⭐\r\n', 5, '2020-01-02 23:21:34', 'unknown', 'su970728', 0, 0, 19, 27, NULL),
('Young감', '좋아용\r\n', 4, '2020-01-02 23:22:06', 'unknown', 'su970728', 0, 0, 19, 28, NULL),
('Young감', '활동분위기도 좋고 너무 좋아요.3학기째 하고 있는데 여러 동아리 가입해보았지만 지금 동아리가 제일 좋네요.\r\n', 5, '2020-01-02 23:22:15', 'unknown', 'su970728', 0, 0, 19, 29, NULL),
('경희극회', '너무좋아요\r\n', 5, '2020-01-02 23:22:36', 'unknown', 'su970728', 0, 0, 22, 30, NULL),
('경희극회', '새로운 도전을 할 수있는거 같아 좋았습니다. 기수별로 연극을 준비하는 거여서 새로운 친구를 만들기에도 좋고 술자리도 재밌습니다\r\n', 5, '2020-01-02 23:22:41', 'unknown', 'su970728', 0, 0, 22, 31, NULL),
('경희극회', '연기는 안 맞다\r\n', 5, '2020-01-02 23:22:46', 'unknown', 'su970728', 0, 0, 22, 32, NULL),
('경희극회', '체계적이지 않고 선배들한테 배워야하는 연기를 제대로 가르쳐주지않음\r\n', 2, '2020-01-02 23:22:53', 'unknown', 'su970728', 0, 0, 22, 33, NULL),
('경희극회', '힘들지만 짜릿해\r\n', 5, '2020-01-02 23:23:01', 'unknown', 'su970728', 0, 0, 22, 34, NULL),
('께뮤', '낯 가리는 사람은 좀 활동하기 어려울 거 같아요. 물론 낯을 잘 안 가리는 사람이 가입할 거 같긴 하지만요 ㅋㅋㅋㅋㅋ\r\n', 4, '2020-01-02 23:23:12', 'unknown', 'su970728', 0, 0, 26, 35, NULL),
('께뮤', '연극과는 다른 모험이 될 수 있습니다. 뮤지컬이라는 새로운 분야에 도전할 수 있었습니다!\r\n \r\n', 4, '2020-01-02 23:23:19', 'unknown', 'su970728', 0, 0, 26, 36, NULL),
('Rap-in', 'Good rapin god flex\r\n', 5, '2020-01-02 23:24:46', 'unknown', 'su970728', 0, 0, 12, 37, NULL),
('Rap-in', '갇혀서 과생활만 하니까 겁나기도 해서 3년동안 안들어가고있었는데 들어오고나니까 다른 세상 사는거같네욯ㅎ사람이든 동아리활동이든 너무 재밌고 행복합니다 대신 술살이 좀 찌네요\r\n', 5, '2020-01-02 23:24:52', 'unknown', 'su970728', 0, 0, 12, 38, NULL),
('Rap-in', '나이에 상관없이 신입생을 받아주고 재학생들이 환영해 주는게 너무 고마웠음 힙합이 좋아서 들어갔지만 동아리에 대한 애정이 더 커지는 것같음 사랑해요 래빈❤️\r\n', 5, '2020-01-02 23:24:58', 'unknown', 'su970728', 0, 0, 12, 39, NULL),
('Rap-in', '너무 분위기 좋습니다 \r\n', 5, '2020-01-02 23:25:03', 'unknown', 'su970728', 0, 0, 12, 40, NULL),
('Rap-in', '너무 자유롭고 편한 분위기이다.\r\n', 4, '2020-01-02 23:25:10', 'unknown', 'su970728', 0, 0, 12, 41, NULL),
('Rap-in', '너무 참여도 저조\r\n', 2, '2020-01-02 23:25:17', 'unknown', 'su970728', 0, 0, 12, 42, NULL),
('Rap-in', '너무나도 즐거운 자리고 선배들도 너무 좋으십니다!\r\n', 5, '2020-01-02 23:25:23', 'unknown', 'su970728', 0, 0, 12, 43, NULL),
('Rap-in', '너무나도 즐거운 자리이고 음악적 스펙트럼을 넓히는데에도 도움이 많이 되었습니다\r\n', 5, '2020-01-02 23:25:29', 'unknown', 'su970728', 0, 0, 12, 44, NULL),
('Rap-in', '넘조아요~\r\n', 5, '2020-01-02 23:25:34', 'unknown', 'su970728', 0, 0, 12, 45, NULL),
('Rap-in', '덕분에 행복합니다\r\n', 5, '2020-01-02 23:25:39', 'unknown', 'su970728', 0, 0, 12, 46, NULL),
('Rap-in', '래빈은 정말 자유롭고, 본인 참여 욕구에 따라 즐거움이 결정되는 동아리입니다.\r\n', 5, '2020-01-02 23:25:46', 'unknown', 'su970728', 0, 0, 12, 47, NULL),
('Rap-in', '매우 자유롭고 재밌으며 좋은 경험을 많이 쌓았다.\r\n', 5, '2020-01-02 23:25:50', 'unknown', 'su970728', 0, 0, 12, 48, NULL),
('Rap-in', '본인이 열정과 의지가 있다면 얼마든지 서포트 받을 수 있는  좋은 동아리! 하지만 연습이나 리허설 일정이 많아서 각오가 필요해요. 분위기는 자유롭고 편해서 좋아요!\r\n', 4, '2020-01-02 23:25:56', 'unknown', 'su970728', 0, 0, 12, 49, NULL),
('Rap-in', '분위기 굳\r\n', 4, '2020-01-02 23:26:04', 'unknown', 'su970728', 0, 0, 12, 50, NULL),
('Rap-in', '분위기가 너무너무 좋고 활동할때 행복해요\r\n', 5, '2020-01-02 23:26:11', 'unknown', 'su970728', 0, 0, 12, 51, NULL),
('Rap-in', '새로운 도전을 래빈을 만나 할 수 있게 되어서 행복합니다!\r\n', 5, '2020-01-02 23:26:18', 'unknown', 'su970728', 0, 0, 12, 52, NULL),
('Rap-in', '새로운시도하는것도 래빈을 통행 배웁니다\r\n', 5, '2020-01-02 23:26:22', 'unknown', 'su970728', 0, 0, 12, 53, NULL),
('Rap-in', '\"여느 동아리들도 그렇겠지만 좋은 점은 친해지고 싶다고 다가오는 사람이라면 누구나 다함께 친해질 수 있다는 것이라 느꼈어요\r\n공연 준비 등 같은 목적을 가지고 활동을 함께 하다보면 주변에서 도와줄 사람도 많았고, 여러 사람과 많이 가까워질 수 있었습니다\"\r\n', 4, '2020-01-02 23:26:27', 'unknown', 'su970728', 0, 0, 12, 54, NULL),
('Rap-in', '원하는 무대 마음껏 서봐서 좋았습니다\r\n', 5, '2020-01-02 23:26:33', 'unknown', 'su970728', 0, 0, 12, 55, NULL),
('Rap-in', '음악동아리인만큼 진짜 진지하게 음악하는 사람이 꽤 있었으면 하는데 어찌 걍 다 놀러왔네\r\n', 3, '2020-01-02 23:26:40', 'unknown', 'su970728', 0, 0, 12, 56, NULL),
('Rap-in', '자유로운 분위기 속에서 이루어지는 재미난 창작 활동b\r\n', 4, '2020-01-02 23:26:48', 'unknown', 'su970728', 0, 0, 12, 57, NULL),
('Rap-in', '자유로운활동 프리한분위기\r\n', 4, '2020-01-02 23:26:54', 'unknown', 'su970728', 0, 0, 12, 58, NULL),
('Rap-in', '자유롭고 개성있는 틀에박히지않은 친구들을 만날수있어서 좋아요 \r\n', 5, '2020-01-02 23:27:01', 'unknown', 'su970728', 0, 0, 12, 59, NULL),
('Rap-in', '재밋다! REAL ARTIST 가 되어가는 과정....여정.....\r\n', 4, '2020-01-02 23:27:07', 'unknown', 'su970728', 0, 0, 12, 60, NULL),
('Rap-in', '전체적인 분위기도 좋고 신입들도 잘챙겨줘서 좋은 동아리입니다\r\n', 3, '2020-01-02 23:27:15', 'unknown', 'su970728', 0, 0, 12, 61, NULL),
('Rap-in', '좋은 사람들 만나서 너무 좋고 활동도 재밌어서 계속 하고싶습니다\r\n', 5, '2020-01-02 23:27:21', 'unknown', 'su970728', 0, 0, 12, 62, NULL),
('Rap-in', '즐거운 분위기 무리가 형성되어 무리끼리 놈\r\n', 3, '2020-01-02 23:27:28', 'unknown', 'su970728', 0, 0, 12, 63, NULL),
('바람개비', '그냥 정말 마음에 드는 동아리입니다\r\n', 5, '2020-01-02 23:27:46', 'unknown', 'su970728', 0, 0, 34, 64, NULL),
('바람개비', '그냥 제가 좋아서 했습니당 :)\r\n', 5, '2020-01-02 23:27:50', 'unknown', 'su970728', 0, 0, 34, 65, NULL),
('바람개비', '기수제인 것만 빼면 노래도 많이 부르고 좋습니다\r\n', 3, '2020-01-02 23:27:56', 'unknown', 'su970728', 0, 0, 34, 66, NULL),
('바람개비', '꼰대문화 및 호칭동기제 등등이 너무 별로여서 활동이 좋아도 기분이 유쾌하진 않았습니다ㅎㅎ\r\n', 2, '2020-01-02 23:28:02', 'unknown', 'su970728', 0, 0, 34, 67, NULL),
('바람개비', '노래 부르기를 좋아하는 사람이라면 누구든지 가입해보면 좋을 것 같습니다\r\n', 4, '2020-01-02 23:28:09', 'unknown', 'su970728', 0, 0, 34, 68, NULL),
('바람개비', '동아리 활동 늘 즐겁습니다!\r\n', 5, '2020-01-02 23:28:15', 'unknown', 'su970728', 0, 0, 34, 69, NULL),
('바람개비', '분위기가 너무 따뜻해요\r\n', 5, '2020-01-02 23:28:19', 'unknown', 'su970728', 0, 0, 34, 70, NULL),
('바람개비', '분위기가 아주 좋아요. 활동도 많이해서 아주 좋은 동아리입니다\r\n', 5, '2020-01-02 23:28:24', 'unknown', 'su970728', 0, 0, 34, 71, NULL),
('바람개비', '분위기도 너무 좋고 활동도 상당히 만족스럽다\r\n', 5, '2020-01-02 23:28:28', 'unknown', 'su970728', 0, 0, 34, 72, NULL),
('바람개비', '사람들 앞에서 노래부를 수 있다는 경험이 정말 좋은 것 같아요\r\n', 4, '2020-01-02 23:28:34', 'unknown', 'su970728', 0, 0, 34, 73, NULL),
('바람개비', '사이좋게 지내는 애들은 사이좋은데 어색해지면 계속 어색하다\r\n', 4, '2020-01-02 23:28:39', 'unknown', 'su970728', 0, 0, 34, 74, NULL),
('바람개비', '선배들과 부담없이 친하게 지낼 수 있어서 좋다. \r\n', 5, '2020-01-02 23:28:44', 'unknown', 'su970728', 0, 0, 34, 75, NULL),
('바람개비', '재밌어용\r\n', 4, '2020-01-02 23:28:50', 'unknown', 'su970728', 0, 0, 34, 76, NULL),
('바람개비', '타 동아리는 어떤지 모르겠지만 동아리의 색깔을 지키며 활동도 알차게하는 동아리같아요. 다들 아마추어지만 그래도 가서 노래하다보면 분명히 배우는 게 있구요. 하지만 월회비가 좀 비싼데 이런 부분은 중동연 측에서 지원을 해주신다면 대학생들이 부담을 줄여가면서 동아리 생활을 더욱 즐길 수 있을 것같아요. 대학생들의 삶의 질을 높이고 활기찬 동아리 생활을 위해 힘써주세요.\r\n', 4, '2020-01-02 23:28:55', 'unknown', 'su970728', 0, 0, 34, 77, NULL),
('바람개비', '활동을 많이 하긴 하지만 그만큼 그 분야에 전문적인 지식과 활동을 얻을 수 있는 좋은 기회가 된다. 동아리 임원들도 굉장히 친절하고 친해질 수 있는 계기가 되어 좋다.\r\n', 4, '2020-01-02 23:29:00', 'unknown', 'su970728', 0, 0, 34, 78, NULL),
('바람개비', '회장님이 잘 챙겨주시고 제가 좋아하는 노래를 부를수 있어서 좋았습니다. 술자리도 재밌지만 기수제라 어린애들한테 존댓말 써야되는게 ㅠㅠ\r\n', 4, '2020-01-02 23:29:04', 'unknown', 'su970728', 0, 0, 34, 79, NULL),
('바람개비', '회장이 멋있어요\r\n', 4, '2020-01-02 23:29:09', 'unknown', 'su970728', 0, 2, 34, 80, NULL),
('보금자리', '고양이 봉사, 강아지 유기견 봉사 다니면서 다양한 사람도 만날 수 있었고, 매주 고양이 밥을 챙겨주다보니 그 곳에 있는 고양이들에게 애정이 생겨서 좋았습니다. 술을 그렇게 많이 마시지 않는 동아리여서 좋았습니다\r\n', 4, '2020-01-02 23:30:26', 'unknown', 'su970728', 0, 0, 35, 81, NULL),
('보금자리', '고양이를 볼 수  있음에 행복합니다.\r\n', 3, '2020-01-02 23:30:31', 'unknown', 'su970728', 0, 0, 35, 82, NULL),
('보금자리', '일주일에 한번씩 고양이를 볼 수 있다는 것이 행복해요\r\n', 5, '2020-01-02 23:30:37', 'unknown', 'su970728', 0, 0, 35, 83, NULL),
('보금자리', '저희 동아리는 활동은 활동대로 알차게 하구요 모여서 재밋게 노는 것도 잘해요\r\n', 5, '2020-01-02 23:30:42', 'unknown', 'su970728', 0, 0, 35, 84, NULL),
('보금자리', '편한 분위기\r\n', 5, '2020-01-02 23:30:47', 'unknown', 'su970728', 0, 0, 35, 85, NULL),
('빛사냥', '가입은 했는데 막상 활동을 하려니까 귀찮아져서 별로 활동을 안했네요,,,\r\n', 3, '2020-01-02 23:30:59', 'unknown', 'su970728', 0, 0, 36, 86, NULL),
('소샥', '3학년 때 들어갔는데 좋았음\r\n', 4, '2020-01-02 23:31:10', 'unknown', 'su970728', 0, 0, 39, 87, NULL),
('소샥', '세부감 ㄱㅇㄷ\r\n', 4, '2020-01-02 23:31:16', 'unknown', 'su970728', 0, 0, 39, 88, NULL),
('SNAP', '기수제임ㅇㅅㅇ\r\n', 4, '2020-01-02 23:31:50', 'unknown', 'su970728', 0, 0, 14, 89, NULL),
('스왈링', '주류동아리이지만 다들 너무 술을 못마심. 그치만 다양한 사람들 만날 수 있어서 좋았습니다. \r\n', 2, '2020-01-02 23:32:02', 'unknown', 'su970728', 0, 0, 42, 90, NULL),
('스왈링', '평소에 접해보기 어려운 다양한 술들을 접해볼 수 있었습니당\r\n', 4, '2020-01-02 23:32:07', 'unknown', 'su970728', 0, 0, 42, 91, NULL),
('아마축구', '재밌음ㅋㅋㅋㅋ\r\n', 4, '2020-01-02 23:32:37', 'unknown', 'su970728', 0, 0, 44, 92, NULL),
('아마축구', '체대생들 존나 많아서 개잘함 민폐짓할거면 들어오지 않는게 좋음ㅋㅋ\r\n', 5, '2020-01-02 23:32:44', 'unknown', 'su970728', 0, 0, 44, 93, NULL),
('아마축구', '축구 존나 잘함ㅋㅋㅋ\r\n', 4, '2020-01-02 23:32:49', 'unknown', 'su970728', 0, 0, 44, 94, NULL),
('유혼', '생각보다 동아리 활동들이 알차고 집중적으로 할 수 있어서 매우 만족스러워요\r\n', 5, '2020-01-02 23:33:01', 'unknown', 'su970728', 0, 0, 49, 95, NULL),
('유혼', '술 이빠이 마시고 운동도 이빠이 하고 \r\n', 3, '2020-01-02 23:33:07', 'unknown', 'su970728', 0, 0, 49, 96, NULL),
('캘리램프', '재밌었음ㅋㅋㅋㅋ\r\n', 4, '2020-01-02 23:34:42', 'unknown', 'su970728', 0, 0, 51, 97, NULL),
('쿠러그', '그냥 그럼 친목도 아니고 도움도 안되고\r\n', 4, '2020-01-02 23:34:50', 'unknown', 'su970728', 0, 0, 52, 98, NULL),
('쿠러그', '문과인데 좀 끼기어려웠으뮤\r\n', 4, '2020-01-02 23:34:54', 'unknown', 'su970728', 0, 0, 52, 99, NULL),
('탈무드', '우리 학교에 제가 알기로는 유일한 락밴드 중동이라서 가입하게 되었는데 같은 취향을 가진 사람들이 모여서 좋았어요~~!!!\r\n', 3, '2020-01-02 23:35:35', 'unknown', 'su970728', 0, 0, 55, 100, NULL),
('탈무드', '제발 모든동아리 기수제 폐지됐으면좋겠습니다~ \r\n', 4, '2020-01-02 23:35:43', 'unknown', 'su970728', 0, 0, 55, 101, NULL),
('평화나비', '목적이나 활동내용은 좋았으나 너무 자주 만남을 추진해 부담이 됨\r\n', 3, '2020-01-02 23:36:07', 'unknown', 'su970728', 0, 0, 58, 102, NULL),
('하이클리어', '배드민턴 치고 싶어서 들어갔는데 생각보다 괜찮은 것 같습니다.\r\n', 5, '2020-01-02 23:36:28', 'unknown', 'su970728', 0, 0, 60, 103, NULL),
('하이클리어', '일주일에 두 번 씩 배드민턴 칠 수 있다는 것이 행복합니다\r\n', 5, '2020-01-02 23:36:33', 'unknown', 'su970728', 0, 0, 60, 104, NULL),
('하이클리어', '체대 동아리다보니 체대생이 많았고 자기들끼리 끼리끼리 치는 문화가 싫었습니다.\r\n', 3, '2020-01-02 23:36:58', 'unknown', 'su970728', 0, 0, 60, 106, NULL),
('HEXA', '기타를 배울수 있었습니다\r\n', 3, '2020-01-02 23:37:23', 'unknown', 'su970728', 0, 0, 6, 107, NULL),
('HEXA', '연애의장\r\n', 5, '2020-01-02 23:37:30', 'unknown', 'su970728', 0, 0, 6, 108, NULL),
('CCC', '은혜롭습니다.', 4, '2020-01-10 14:05:10', 'unknown', 'su970728', 0, 0, 3, 109, NULL),
('CCC', 'God Bless You ♡', 5, '2020-02-14 15:59:59', '13번째 제자', '$2y$10$nHtv4K050sXZy976KMtsEeEgn1xjX9diW2Dpjq8lUiZ/cvx0g3Nju', 0, 0, 3, 110, NULL),
('KUCO', '쿠코 짱 20주년 연주회 화이팅♥', 5, '2020-02-14 17:58:36', 'scw05017', '$2y$10$xQ9C1/4J0rNrP6DuyteaveFdpFsFBaLYyXxrQy1TghkZMWyBlDnQa', 0, 0, 10, 111, NULL),
('KUCO', '쿠코짱', 5, '2020-02-14 18:04:41', 'Sukizzang', '$2y$10$TtwLDxgfBs5m/T5z1LDIcu1HF3ScsWjnZz5kG9KNzMGLjp7eK5s86', 0, 0, 10, 112, NULL),
('보금자리', '아주 좋아용 매주 고양이도 보고 강아지 봉사도 가요!!', 5, '2020-02-14 18:04:50', 'Si', '$2y$10$i.r.JiCVETlcuEBt/gjvH.4jSB4iGC0YiUpL1cYbVmAki.auybdzK', 0, 0, 35, 113, NULL),
('KUCO', '쿠코 재밌어요~ 술만 마시는게 아니라 악기도 배우고, 연주도 하면서 친목도모하시 좋습니다><', 5, '2020-02-14 18:05:50', 'molly921', '$2y$10$W7YAg3DemlARf3mvMRLk6OeNF5M9aoj3jcAJppnIjjb3rmp9/b6bi', 0, 0, 10, 114, NULL),
('KUCO', '다른 동아리는 흐지부지 생활하는 경우가 많은데, 여기선 악기도 배우고 훨씬 즐겁게 학교 다닐 수 있습니다!', 5, '2020-02-14 18:09:12', '지나가는쿠코인', '$2y$10$K2HadjVDOHz6tfv.m.r4gueWdGP2Y0ECAl8vGLMIPxj16cDcnE0xy', 0, 0, 10, 115, NULL),
('KUCO', '화목하고 구성원 모두가 열심히 하려는 모습이 있어 좋습니다ㅎㅎ', 5, '2020-02-14 18:12:52', 'mingxian', '$2y$10$tpLJTOHQO8syY31l3YEA/OwaLB.BbCZ8BQS5zqmt8hG9117D9J/Lm', 0, 0, 10, 116, NULL),
('KUCO', '악기 처음 접하는 사람도 하나부터 차근차근 알려줍니당 단순 술만 마시는 동아리는 아니구 음악할땐 진지해요 다들 ㅎㅎ연주회 한번 준비만 같이해도 가족보다 많이보는 사이가 됩니당', 5, '2020-02-14 18:14:00', '나징징', '$2y$10$BNKuDMu5mdnV.sLigbrXXewKb5OFqKGiKxVuf3bh5dLTztTZm4BZu', 0, 0, 10, 117, NULL),
('KUCO', '사교성이 없는 편이여서 잘 못친해지는 편인데, 연주회를 준비하면서 다들 너무 잘챙겨줘서 다들 너무 금방 친해졌어요.', 5, '2020-02-14 19:22:36', 'ppw', '$2y$10$5wqUuZcywM8kLWdwotNtDuseCTnTbQR.z1KWkWw.CxtOP9OkBsXS6', 0, 0, 10, 118, NULL),
('CCC', '하나님의 사랑으로 서로를 사랑하는 귀한 공동체입니다:) 대학에 와서 만나는 많은 인간관계들과 다르다고 느꼈습니다. 어떤 이해관계로 움직이는 것도 아니고,  그 누구도 소외되지 않도록 애쓰는 공동체입니다. 배려, 인내, 사랑, 포용, 용서를 배워가고 연습할 수 있는 곳인 것 같습니다:) 물론 완벽하지는 않지만, 많은 사람들이 바르고 따뜻한 가치관으로 성숙해져가는 곳입니다. 환영해요-!', 5, '2020-02-14 19:32:10', 'ThanksGod', '$2y$10$wfVeEpfyc0rM.oYiw7ZI0.Ql5BHHwNrDThsuiLCcaRPb0AYuU0rxi', 0, 1, 3, 119, NULL),
('KUCO', '동아리 사람들 너무 착하고 좋아요! 연주회 한 번 같이하면 짱친을 넘어서 가족이 될 수 있음>___&lt; 악기 못해도 처음부터 다 가르쳐주기때문에 좋아요~.~ 쿠코짱', 5, '2020-02-15 00:47:53', '플룻부는쿼카', '$2y$10$WjDW6DUkwsmmz7QNWQ1o8ek829.AiOlTDHPS7xuolWnzntI2NgXeW', 0, 0, 10, 120, NULL),
('KUCO', '처음 시작하는 사람도 열정만 있다면 참가할 수 있다는게 좋아요. 이런 것이  대학교 동아리구나 싶어요.', 5, '2020-02-14 19:21:54', '안녕하세', '$2y$10$H4.DkblipOWUt6WXH0/XfumbJLVJ6TLirUV/PxzvTmdvyH/ETNmv2', 0, 1, 10, 121, NULL),
('KUCO', '방학중에는 정기연주회 연습을 하고, 개강하면 정기연주회를 합니다. 유튜브에 KUCO검색하면 영상보실 수 있어요!  학기중에는 멘토링, 작은연주회(1학기), 쿠코인의밤(2학기/연말 연주회를 겸한 행사) 등의 프로그램이 있습니다.   악기 처음 잡아봐도, 공동구매를 통해서 연습용 악기 구할 수도 있고, 멘토링으로 선배들한테서 즐겁게 악기 배울 수도 있어요. 전공준비하다 온 친구들도 있고, 취미로 하지만 실력 좋은 친구들도 많이 있습니다. 쿠코에 와서 악기 시작한 친구들도 많고요. 즐겁게 악기 연주하면서 대학생활하며 취미생활도 같이 하면 좋을 것 같아요! ', 5, '2020-02-15 15:53:01', 'info', '$2y$10$ByEAF.1Sk.X2LEsgRCE8S.iJfb1kYhr/QhiaxqXm.hTF6XcKcUnru', 0, 0, 10, 122, NULL),
('KUCO', '학기중에 바빠서 중앙동아리인 KUCO를 하기까지 고민이 많았었는데, 대학와서 가장 잘한 일 중 하나에요. 힘들때마다 쿠코활동들, 쿠코에서 사귄 친구들이 힘이 많이 되어줬던 것 같습니다. 대학와서 마음붙일 곳 있었으면 좋겠고, 취미하나 배워보고 싶다면 쿠코 추천합니다ㅎㅎ ', 5, '2020-02-15 15:54:58', 'bee', '$2y$10$Idit4J61ZWoI59/MmivP1OzDjtdxk6zAyOKJOHhs/SNhephXapzG.', 0, 0, 10, 123, NULL),
('탈무드', '탈무드 들어와서 처음 악기를 배웠는데 열심히 할 수 있었고 친구들이랑 합주할 때 너무 재미있어요 음악에 진지한 동아리라 배우는 게 많고 뿌듯해요~~', 5, '2020-02-15 18:03:00', '????', '$2y$10$/abppeBWVaSBleIM0P/Gy.TWCBpuFXqy71YJeE0Q/MBMfoHQLGIrK', 0, 0, 55, 124, NULL),
('UP', '많은 사람들 앞에서 다양한 주제의 발표를 해볼 수 있다는 것이 장점', 4, '2020-02-16 10:44:08', '1232', '$2y$10$M0fnqwSyuXZh30e.Kv28ce1wFzxosp0s3wiaZBO7N7TynBNKZG1ZO', 0, 0, 17, 125, NULL),
('바람개비', '노래에, 무대에 애정이 있는 사람이라면 활동하면서 얻는 것들이 정말 많은 동아리! 성실히 임하다보면 실력도 그만큼 늘어있어요. *친목도모 너무 즐기다가 학점 빠이빠이하게 될 수 있음 주의*', 5, '2020-02-28 17:55:20', ' ', '$2y$10$webTVhdYu9HFtG.NqJMckecBPG.SETtJJR2up946UqlGjY.aHJZ06', 0, 0, 34, 126, '118.220.212.23'),
('께뮤', '대학생활에서 가장 기억에 남는 순간이 언제냐고 물어본다면 무대 위에 있던 시간들이라고 할 것 같습니다. 뮤지컬 동아리 안했으면 아마 계속 후회했을거에요!', 5, '2020-03-30 16:25:49', ':P', '$2y$10$ornsdpgjxvmfHltujsY1N.TKrrHsgH6rClhghivphfMqOA6RGEcoe', 0, 0, 26, 127, '121.136.82.126');

-- --------------------------------------------------------

--
-- 테이블 구조 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `comment`
--

INSERT INTO `comment` (`id`, `info_id`, `review_id`, `username`, `password`, `reg_date`, `content`) VALUES
(1, 3, 119, '1', '$2y$10$lVxjBTnPnyoIhJUsqf4wW.H6cJLyPXHhO4lTyjdf2KQWWm2EYu0J2', '2020-02-26', '1'),
(2, 3, 119, '11', '$2y$10$w/uD/OBRPxtludRKsqdwZeYfmW/jHSw5nREZuTpOg9qDTi3W3xhBm', '2020-02-26', '별루다'),
(4, 19, 29, '1', '$2y$10$MqilNW.cm9/UNUnys.YZkeHGS38Rk8HNQPBzqcsRpLdQK33i.rxMO', '2020-02-27', '1'),
(5, 34, 80, 'Qwer', '$2y$10$2ErpsKnhkclkFLA8oFGr6O3RSDwwLgCaYkldxxZ3ECcRHeIM6M0Ja', '2020-02-28', '거짓말하지마세여');

-- --------------------------------------------------------

--
-- 테이블 구조 `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dept` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `department`
--

INSERT INTO `department` (`id`, `dept`) VALUES
(1, '기계공학과'),
(2, '산업경영공학과'),
(3, '원자력공학과'),
(4, '화학공학과'),
(5, '정보전자신소재공학과'),
(6, '사회기반시스템공학과'),
(7, '건축공학과'),
(8, '환경학 및 환경공학과'),
(9, '건축학과(5년제)'),
(10, '전자공학과'),
(11, '생체의공학과'),
(12, '컴퓨터공학과'),
(13, '소프트웨어융합학과'),
(14, '응용수학과'),
(15, '응용물리학과'),
(16, '응용화학과'),
(17, '우주과학과'),
(18, '유전공학과'),
(19, '식품생명공학과'),
(20, '한방재료공학과'),
(21, '식물·환경신소재공학과'),
(22, '원예생명공학과'),
(23, '국제학과'),
(24, '프랑스어학과'),
(25, '스페인어학과'),
(26, '러시아어학과'),
(27, '중국어학과'),
(28, '일본어학과'),
(29, '한국어학과'),
(30, '글로벌커뮤니케이션학부'),
(31, '산업디자인학과'),
(32, '시각디자인학과'),
(33, '환경조경디자인학과'),
(34, '의류디자인학과'),
(35, '디지털콘텐츠학과'),
(36, '도예학과'),
(37, 'Post Modern 음악학과'),
(38, '연극영화학과'),
(39, '체육학과'),
(40, '스포츠의학과'),
(41, '골프산업학과'),
(42, '태권도학과'),
(43, '스포츠지도학과');

-- --------------------------------------------------------

--
-- 테이블 구조 `picture`
--

CREATE TABLE `picture` (
  `pic_id` int(11) NOT NULL,
  `board_id` int(11) DEFAULT NULL,
  `pic_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `picture`
--

INSERT INTO `picture` (`pic_id`, `board_id`, `pic_path`) VALUES
(34, 1, '/images/global01.jpg'),
(35, 2, '/images/publish01.jpg'),
(36, 3, '/images/publish01.jpg'),
(37, 4, '/images/scholarship01.jpg'),
(38, 5, '/images/event01.jpg'),
(41, 8, '/images/sketch.jpg'),
(43, 10, '/images/11.PNG'),
(48, 15, '/images/'),
(49, 16, '/images/sayclub.ico');

-- --------------------------------------------------------

--
-- 테이블 구조 `reviews`
--

CREATE TABLE `reviews` (
  `comment_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `reg_date` datetime DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `comment_txt` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `reviews`
--

INSERT INTO `reviews` (`comment_id`, `board_id`, `reg_date`, `username`, `comment_txt`) VALUES
(8, 1, '2020-01-28 04:03:50', 'advisor', '정말 보기좋아요\n');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `reg_date`) VALUES
(1, 'admin', '1234', '2020-02-18 12:35:33');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
/*ALTER TABLE `board`
  ADD PRIMARY KEY (`board_id`);*/

--
-- 테이블의 인덱스 `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- 테이블의 인덱스 `clubbymember`
--
ALTER TABLE `clubbymember`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentid` (`studentid`);

--
-- 테이블의 인덱스 `clubhead`
--
ALTER TABLE `clubhead`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_id` (`info_id`);

--
-- 테이블의 인덱스 `clubinfo`
--
ALTER TABLE `clubinfo`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `clubmember`
--
ALTER TABLE `clubmember`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_id` (`info_id`);

--
-- 테이블의 인덱스 `clubpicture`
--
ALTER TABLE `clubpicture`
  ADD PRIMARY KEY (`pic_id`),
  ADD KEY `club_name` (`club_name`);

--
-- 테이블의 인덱스 `clubreview`
--
ALTER TABLE `clubreview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`info_id`);

--
-- 테이블의 인덱스 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`);

--
-- 테이블의 인덱스 `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`pic_id`),
  ADD KEY `picture` (`board_id`);

--
-- 테이블의 인덱스 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `reviews` (`board_id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
/*ALTER TABLE `board`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;*/

--
-- 테이블의 AUTO_INCREMENT `clubbymember`
--
ALTER TABLE `clubbymember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `clubhead`
--
ALTER TABLE `clubhead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `clubinfo`
--
ALTER TABLE `clubinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 테이블의 AUTO_INCREMENT `clubmember`
--
ALTER TABLE `clubmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `clubpicture`
--
ALTER TABLE `clubpicture`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- 테이블의 AUTO_INCREMENT `clubreview`
--
ALTER TABLE `clubreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- 테이블의 AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- 테이블의 AUTO_INCREMENT `picture`
--
ALTER TABLE `picture`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- 테이블의 AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `clubreview`
--
ALTER TABLE `clubreview`
  ADD CONSTRAINT `club_id` FOREIGN KEY (`info_id`) REFERENCES `clubinfo` (`id`);

--
-- 테이블의 제약사항 `picture`
--
/*ALTER TABLE `picture`
  ADD CONSTRAINT `picture` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON UPDATE CASCADE;*/
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
