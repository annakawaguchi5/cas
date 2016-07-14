-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2016 年 7 月 05 日 10:09
-- サーバのバージョン: 5.5.8
-- PHP のバージョン: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `dbk2016`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_course`
--

CREATE TABLE IF NOT EXISTS `tb_course` (
  `cid` int(11) NOT NULL,
  `cname` varchar(32) NOT NULL,
  `detail` text,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_course`
--

INSERT INTO `tb_course` (`cid`, `cname`, `detail`) VALUES
(1, '情報技術応用コース', '履修モデルの中から興味・適性のある情報技術および適用分野をいくつか選択し、それらの専門的知識を身につけ、実問題へ応用する方法を学ぶコース。'),
(2, '情報科学総合コース', '情報科学・情報技術を基礎から総合的に学んだ上で、履修モデルの中から興味・適性のある情報技術および適用分野を選択するコース。');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_decide`
--

CREATE TABLE IF NOT EXISTS `tb_decide` (
  `uid` varchar(16) NOT NULL,
  `uname` varchar(32) NOT NULL,
  `cid` char(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_decide`
--

INSERT INTO `tb_decide` (`uid`, `uname`, `cid`) VALUES
('jiro', '松田次郎', '2'),
('S1001', '相川一輝', '1'),
('S1002', '岩崎優太', '1'),
('S1004', '岸桃子', '1'),
('S1005', '小池大河', '2'),
('taro', '島田太郎', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_entry`
--

CREATE TABLE IF NOT EXISTS `tb_entry` (
  `uid` varchar(32) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `etime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_entry`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `tb_gp`
--

CREATE TABLE IF NOT EXISTS `tb_gp` (
  `grade` char(1) NOT NULL,
  `point` int(11) DEFAULT NULL,
  PRIMARY KEY (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_gp`
--

INSERT INTO `tb_gp` (`grade`, `point`) VALUES
('A', 3),
('B', 2),
('C', 1),
('D', 0),
('S', 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_study`
--

CREATE TABLE IF NOT EXISTS `tb_study` (
  `uid` char(5) NOT NULL DEFAULT '',
  `subid` char(3) NOT NULL DEFAULT '',
  `grade` char(1) DEFAULT NULL,
  PRIMARY KEY (`uid`,`subid`),
  KEY `subid` (`subid`),
  KEY `grade` (`grade`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_study`
--

INSERT INTO `tb_study` (`uid`, `subid`, `grade`) VALUES
('S1001', 'T01', 'A'),
('S1003', 'T12', 'A'),
('S1011', 'T10', 'A'),
('S1015', 'T10', 'A'),
('S1019', 'T04', 'A'),
('S1002', 'T03', 'B'),
('S1006', 'T03', 'B'),
('S1008', 'T11', 'B'),
('S1009', 'T06', 'B'),
('S1011', 'T05', 'B'),
('S1016', 'T03', 'B'),
('S1001', 'T03', 'C'),
('S1003', 'T01', 'C'),
('S1007', 'T04', 'C'),
('S1007', 'T11', 'C'),
('S1013', 'T05', 'C'),
('S1002', 'T01', 'D'),
('S1005', 'T11', 'D'),
('S1008', 'T12', 'D'),
('S1012', 'T04', 'D'),
('S1014', 'T10', 'D'),
('S1015', 'T06', 'D'),
('S1016', 'T05', 'D'),
('S1005', 'T04', 'S'),
('S1009', 'T11', 'S'),
('S1012', 'T01', 'S'),
('S1017', 'T12', 'S'),
('S1018', 'T08', 'S');

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_subcourse`
--

CREATE TABLE IF NOT EXISTS `tb_subcourse` (
  `subid` char(3) NOT NULL,
  `cname` varchar(32) NOT NULL,
  `credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`subid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_subcourse`
--

INSERT INTO `tb_subcourse` (`subid`, `cname`, `credit`) VALUES
('T01', 'ロボット工学', 2),
('T02', '情報セキュリティ', 2),
('T03', '人間情報学', 2),
('T04', 'データベース', 3),
('T05', '信号処理', 2),
('T06', 'English Reading', 1),
('T07', 'ソフトウェア工学', 2),
('T08', '情報処理演習', 1),
('T09', '情報教育', 3),
('T10', '統計学', 2),
('T11', 'プログラミング言語', 2),
('T12', '計算社会学', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `tb_subject`
--

CREATE TABLE IF NOT EXISTS `tb_subject` (
  `sid` char(3) NOT NULL,
  `sname` varchar(32) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_subject`
--


-- --------------------------------------------------------

--
-- テーブルの構造 `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `uid` varchar(16) NOT NULL,
  `uname` varchar(32) NOT NULL,
  `upass` varchar(16) NOT NULL,
  `urole` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータをダンプしています `tb_user`
--

INSERT INTO `tb_user` (`uid`, `uname`, `upass`, `urole`) VALUES
('foo', 'ユーザA', 'ge87', 2),
('jiro', '松田次郎', 'ab37', 1),
('joho', '情報はなこ', '6arY', 2),
('mgr', '管理', '123', 9),
('S1001', '相川一輝', 'aikawa', 1),
('S1002', '岩崎優太', 'iwasaki', 1),
('S1003', '神木友亮', 'kamiki', 1),
('S1004', '岸桃子', 'kishi', 1),
('S1005', '小池大河', 'koike', 1),
('S1006', '桜庭ひなた', 'sakuraba', 1),
('S1007', '白石将生', 'shiraishi', 1),
('S1008', '瀧宏典', 'taki', 1),
('S1009', '永瀬佳乃', 'nagase', 1),
('S1010', '野田龍太郎', 'noda', 1),
('S1011', '林佳奈美', 'hayashi', 1),
('S1012', '樋口涼介', 'higuchi', 1),
('S1013', '福本理央', 'fukumoto', 1),
('S1014', '星野美和', 'hoshino', 1),
('S1015', '町田みのり', 'machida', 1),
('S1016', '三島明日香', 'mishima', 1),
('S1017', '村原沙也加', 'murahara', 1),
('S1018', '本村奈緒子', 'motomura', 1),
('S1019', '山田剛', 'yamada', 1),
('S1020', '吉野圭人', 'yoshino', 1),
('taro', '島田太郎', 'hi93', 1);
