SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `detail_presensi` (
  `id` int(11) NOT NULL,
  `id_presensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `H` tinyint(1) NOT NULL DEFAULT 0,
  `S` tinyint(1) NOT NULL DEFAULT 0,
  `I` tinyint(1) NOT NULL DEFAULT 0,
  `A` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `detail_tugas_tambahan` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `kegiatan` text NOT NULL,
  `jml` int(11) NOT NULL,
  `tugas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `kegiatan` text NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `kelas_has_mapel` (
  `id` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama_mapel` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `judul` varchar(255) DEFAULT NULL,
  `pesan` mediumtext DEFAULT NULL,
  `kind` tinyint(4) DEFAULT NULL,
  `shw` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `H` smallint(6) NOT NULL,
  `S` smallint(6) NOT NULL,
  `I` smallint(6) NOT NULL,
  `A` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `session` (
  `id_user` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `timestamp` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kind` tinyint(4) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_stamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tugas_tambahan` (
  `id` int(11) NOT NULL,
  `nama_tugas` text NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `ttd` varchar(255) NOT NULL DEFAULT 'empty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `detail_presensi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `detail_tugas_tambahan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kelas_has_mapel`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `timestamp`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tugas_tambahan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `detail_presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `detail_tugas_tambahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kelas_has_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
