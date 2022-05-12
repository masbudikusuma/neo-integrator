-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for feeder_api
CREATE DATABASE IF NOT EXISTS `feeder_api` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `feeder_api`;

-- Dumping structure for table feeder_api.activity
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) DEFAULT NULL,
  `User` varchar(50) DEFAULT NULL,
  `PT` varchar(50) DEFAULT NULL,
  `DateIn` varchar(50) DEFAULT NULL,
  `Ip` varchar(50) DEFAULT NULL,
  `aksi` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.activity: 0 rows
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;

-- Dumping structure for table feeder_api.cekmahasiswa
CREATE TABLE IF NOT EXISTS `cekmahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `prodi_uuid` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `Jenis_masuk` int(11) DEFAULT NULL,
  `jk` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `Tempat_Lahir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Agama` int(11) DEFAULT NULL,
  `NIK` bigint(20) DEFAULT NULL,
  `ibu` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Biaya_Masuk` int(11) DEFAULT NULL,
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.cekmahasiswa: 0 rows
/*!40000 ALTER TABLE `cekmahasiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `cekmahasiswa` ENABLE KEYS */;

-- Dumping structure for table feeder_api.cekmatakuliah
CREATE TABLE IF NOT EXISTS `cekmatakuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mata_kuliah` varchar(15) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) DEFAULT NULL,
  `id_jenis_mata_kuliah` varchar(30) NOT NULL,
  `id_kelompok_mata_kuliah` varchar(30) DEFAULT NULL,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `metode_kuliah` varchar(30) DEFAULT NULL,
  `ada_sap` varchar(30) DEFAULT NULL,
  `ada_silabus` varchar(30) DEFAULT NULL,
  `ada_bahan_ajar` varchar(30) DEFAULT NULL,
  `ada_acara_praktek` varchar(30) DEFAULT NULL,
  `ada_diktat` varchar(30) DEFAULT NULL,
  `tanggal_mulai_efektif` varchar(30) DEFAULT NULL,
  `tanggal_selesai_efektif` varchar(30) DEFAULT NULL,
  `err` varchar(30) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.cekmatakuliah: 0 rows
/*!40000 ALTER TABLE `cekmatakuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `cekmatakuliah` ENABLE KEYS */;

-- Dumping structure for table feeder_api.feeder_nilaitransfer
CREATE TABLE IF NOT EXISTS `feeder_nilaitransfer` (
  `id_transfer` varchar(36) NOT NULL,
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `nim` int(20) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `id_periode_masuk` int(11) NOT NULL,
  `kode_mata_kuliah_asal` varchar(9) NOT NULL,
  `nama_mata_kuliah_asal` varchar(50) NOT NULL,
  `sks_mata_kuliah_asal` int(11) NOT NULL,
  `nilai_huruf_asal` varchar(3) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kode_matkul_diakui` varchar(20) NOT NULL,
  `nama_mata_kuliah_diakui` varchar(50) NOT NULL,
  `sks_mata_kuliah_diakui` int(11) NOT NULL,
  `nilai_huruf_diakui` varchar(1) NOT NULL,
  `nilai_angka_diakui` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id_transfer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.feeder_nilaitransfer: 0 rows
/*!40000 ALTER TABLE `feeder_nilaitransfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `feeder_nilaitransfer` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getakm
CREATE TABLE IF NOT EXISTS `getakm` (
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nim` int(11) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program_studi` varchar(50) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(25) NOT NULL,
  `id_status_mahasiswa` varchar(1) NOT NULL,
  `nama_status_mahasiswa` varchar(50) NOT NULL,
  `ips` varchar(50) NOT NULL DEFAULT '',
  `ipk` varchar(50) NOT NULL DEFAULT '',
  `sks_semester` varchar(50) NOT NULL DEFAULT '',
  `sks_total` varchar(50) NOT NULL DEFAULT '',
  `biaya_kuliah_smt` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_registrasi_mahasiswa`,`id_semester`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getakm: 0 rows
/*!40000 ALTER TABLE `getakm` DISABLE KEYS */;
/*!40000 ALTER TABLE `getakm` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getdosen
CREATE TABLE IF NOT EXISTS `getdosen` (
  `id_dosen` varchar(36) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nidn` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `nama_ibu_kandung` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `nama_agama` varchar(20) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_jenis_sdm` varchar(50) NOT NULL,
  `no_sk_pengangkatan` varchar(50) NOT NULL,
  `nama_lembaga_pengangkatan` varchar(50) NOT NULL,
  `nama_wilayah` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_status_aktif` varchar(20) NOT NULL,
  `nama_status_aktif` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dosen`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getdosen: 0 rows
/*!40000 ALTER TABLE `getdosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `getdosen` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getkelaskuliah
CREATE TABLE IF NOT EXISTS `getkelaskuliah` (
  `id_kelas_kuliah` varchar(36) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_program_studi` varchar(50) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(16) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kode_mata_kuliah` varchar(200) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `nama_kelas_kuliah` varchar(5) NOT NULL,
  `bahasan` varchar(100) NOT NULL DEFAULT '',
  `tanggal_mulai_efektif` varchar(200) NOT NULL,
  `tanggal_akhir_efektif` varchar(50) DEFAULT NULL,
  `kapasitas` varchar(50) NOT NULL DEFAULT '0',
  `id_key` varchar(100) DEFAULT NULL COMMENT 'semester_kode-kelas_kode-mk_idprodi',
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getkelaskuliah: 0 rows
/*!40000 ALTER TABLE `getkelaskuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `getkelaskuliah` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getkurikulum
CREATE TABLE IF NOT EXISTS `getkurikulum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenj_didik` varchar(36) NOT NULL,
  `jml_sem_normal` varchar(36) NOT NULL,
  `id_kurikulum` varchar(36) NOT NULL,
  `nama_kurikulum` varchar(50) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `id_semester` varchar(50) NOT NULL DEFAULT '',
  `semester_mulai_berlaku` varchar(16) NOT NULL,
  `jumlah_sks_lulus` varchar(50) NOT NULL DEFAULT '0',
  `jumlah_sks_wajib` varchar(50) NOT NULL DEFAULT '',
  `jumlah_sks_pilihan` varchar(50) NOT NULL DEFAULT '',
  `jumlah_sks_mata_kuliah_wajib` varchar(50) NOT NULL DEFAULT '',
  `jumlah_sks_mata_kuliah_pilihan` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kurikulum`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getkurikulum: 0 rows
/*!40000 ALTER TABLE `getkurikulum` DISABLE KEYS */;
/*!40000 ALTER TABLE `getkurikulum` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getmahasiswa
CREATE TABLE IF NOT EXISTS `getmahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_perguruan_tinggi` varchar(36) NOT NULL,
  `id_mahasiswa` varchar(36) NOT NULL,
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `id_agama` varchar(10) NOT NULL DEFAULT '',
  `nama_agama` varchar(25) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `id_status_mahasiswa` varchar(50) NOT NULL,
  `nama_status_mahasiswa` varchar(20) NOT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `id_periode` varchar(50) NOT NULL DEFAULT '',
  `nama_periode_masuk` varchar(25) NOT NULL,
  PRIMARY KEY (`id_mahasiswa`,`id_registrasi_mahasiswa`),
  KEY `getmahasiswa_nim` (`nim`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getmahasiswa: 0 rows
/*!40000 ALTER TABLE `getmahasiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `getmahasiswa` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getmahasiswalulusdo
CREATE TABLE IF NOT EXISTS `getmahasiswalulusdo` (
  `id_reg_mahasiswa` varchar(50) DEFAULT NULL,
  `id_mahasiswa` varchar(50) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `id_jenis_keluar` varchar(50) DEFAULT NULL,
  `nama_jenis_keluar` varchar(50) DEFAULT NULL,
  `tanggal_keluar` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_sk_yudisium` varchar(50) DEFAULT NULL,
  `tanggal_sk_yudisium` varchar(50) DEFAULT NULL,
  `nomor_ijazah` varchar(50) DEFAULT NULL,
  `ipk` varchar(50) DEFAULT NULL,
  `jalur_skripsi` varchar(50) DEFAULT NULL,
  `judul_skripsi` varchar(50) DEFAULT NULL,
  `bulan_awal_bimbingan` varchar(50) DEFAULT NULL,
  `bulan_akhir_bimbingan` varchar(50) DEFAULT NULL,
  `id_dosen` varchar(50) DEFAULT NULL,
  `nidn` varchar(50) DEFAULT NULL,
  `nama_dosen` varchar(50) DEFAULT NULL,
  `pembimbing_ke` varchar(50) DEFAULT NULL,
  `id_periode_keluar` varchar(50) DEFAULT NULL,
  `id_prodi` varchar(50) DEFAULT NULL,
  `nama_program_studi` varchar(50) DEFAULT NULL,
  `angkatan` varchar(50) DEFAULT NULL,
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  `periode_wisuda` varchar(50) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getmahasiswalulusdo: 0 rows
/*!40000 ALTER TABLE `getmahasiswalulusdo` DISABLE KEYS */;
/*!40000 ALTER TABLE `getmahasiswalulusdo` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getmatakuliah
CREATE TABLE IF NOT EXISTS `getmatakuliah` (
  `id_matkul` varchar(36) NOT NULL,
  `kode_mata_kuliah` varchar(15) NOT NULL,
  `nama_mata_kuliah` varchar(200) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `id_jenis_mata_kuliah` varchar(30) DEFAULT NULL,
  `id_kelompok_mata_kuliah` varchar(30) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `metode_kuliah` varchar(30) DEFAULT NULL,
  `ada_sap` varchar(30) DEFAULT NULL,
  `ada_silabus` varchar(30) DEFAULT NULL,
  `ada_bahan_ajar` varchar(30) DEFAULT NULL,
  `ada_acara_praktek` varchar(30) DEFAULT NULL,
  `ada_diktat` varchar(30) DEFAULT NULL,
  `tanggal_mulai_efektif` varchar(30) DEFAULT NULL,
  `tanggal_selesai_efektif` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_matkul`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getmatakuliah: 0 rows
/*!40000 ALTER TABLE `getmatakuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `getmatakuliah` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getmatkulkurikulum
CREATE TABLE IF NOT EXISTS `getmatkulkurikulum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_create` date NOT NULL,
  `id_kurikulum` varchar(36) NOT NULL,
  `nama_kurikulum` varchar(50) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kode_mata_kuliah` varchar(25) NOT NULL,
  `nama_mata_kuliah` varchar(200) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL DEFAULT '',
  `id_semester` varchar(50) NOT NULL DEFAULT '',
  `semester_mulai_berlaku` varchar(16) NOT NULL,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `apakah_wajib` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kurikulum`,`id_matkul`,`id_prodi`,`id_semester`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getmatkulkurikulum: 0 rows
/*!40000 ALTER TABLE `getmatkulkurikulum` DISABLE KEYS */;
/*!40000 ALTER TABLE `getmatkulkurikulum` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getnilaikuliahkelas
CREATE TABLE IF NOT EXISTS `getnilaikuliahkelas` (
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `id_periode` varchar(50) NOT NULL DEFAULT '',
  `id_matkul` varchar(36) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `id_kelas` varchar(36) NOT NULL,
  `nama_kelas_kuliah` varchar(100) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `nilai_angka` varchar(30) DEFAULT NULL,
  `nilai_indeks` varchar(30) DEFAULT NULL,
  `nilai_huruf` varchar(30) DEFAULT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(100) NOT NULL,
  `angkatan` varchar(50) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getnilaikuliahkelas: 0 rows
/*!40000 ALTER TABLE `getnilaikuliahkelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `getnilaikuliahkelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getpengajarkelas
CREATE TABLE IF NOT EXISTS `getpengajarkelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_aktivitas_mengajar` varchar(200) DEFAULT NULL,
  `id_dosen` varchar(200) DEFAULT NULL,
  `nidn` varchar(200) DEFAULT NULL,
  `nama_dosen` varchar(200) DEFAULT NULL,
  `id_registrasi_dosen` varchar(36) NOT NULL COMMENT 'bukan ID Dosen, GetList Penugasan',
  `id_kelas_kuliah` varchar(36) NOT NULL,
  `id_substansi` varchar(30) DEFAULT NULL,
  `sks_substansi_total` varchar(50) NOT NULL DEFAULT '',
  `nama_kelas_kuliah` varchar(200) DEFAULT NULL,
  `rencana_minggu_pertemuan` varchar(50) NOT NULL DEFAULT '',
  `realisasi_minggu_pertemuan` varchar(50) NOT NULL DEFAULT '',
  `nama_jenis_evaluasi` varchar(50) NOT NULL DEFAULT '',
  `id_jenis_evaluasi` varchar(50) NOT NULL DEFAULT '',
  `err` int(11) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getpengajarkelas: 0 rows
/*!40000 ALTER TABLE `getpengajarkelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `getpengajarkelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getpenugasandosen
CREATE TABLE IF NOT EXISTS `getpenugasandosen` (
  `id_registrasi_dosen` varchar(36) NOT NULL,
  `id_dosen` varchar(36) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nidn` varchar(50) NOT NULL DEFAULT '',
  `id_tahun_ajaran` varchar(50) NOT NULL DEFAULT '',
  `nama_tahun_ajaran` varchar(50) NOT NULL,
  `id_perguruan_tinggi` varchar(36) NOT NULL,
  `nama_perguruan_tinggi` varchar(50) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(200) NOT NULL,
  `nomor_surat_tugas` varchar(50) NOT NULL,
  `tanggal_surat_tugas` date NOT NULL,
  `mulai_surat_tugas` date NOT NULL,
  PRIMARY KEY (`id_registrasi_dosen`,`id_dosen`,`id_tahun_ajaran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getpenugasandosen: 0 rows
/*!40000 ALTER TABLE `getpenugasandosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `getpenugasandosen` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getpesertakelas
CREATE TABLE IF NOT EXISTS `getpesertakelas` (
  `id_kelas_kuliah` varchar(36) NOT NULL,
  `nama_kelas_kuliah` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `id_mahasiswa` varchar(36) NOT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(50) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kode_mata_kuliah` varchar(50) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `angkatan` varchar(50) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getpesertakelas: 0 rows
/*!40000 ALTER TABLE `getpesertakelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `getpesertakelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.getprodi
CREATE TABLE IF NOT EXISTS `getprodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` varchar(36) NOT NULL,
  `kode_program_studi` varchar(50) NOT NULL DEFAULT '',
  `nama_program_studi` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_jenjang_pendidikan` varchar(50) NOT NULL DEFAULT '',
  `nama_jenjang_pendidikan` varchar(10) NOT NULL,
  `error_no` varchar(10) DEFAULT NULL,
  `error_desc` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_prodi`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.getprodi: 0 rows
/*!40000 ALTER TABLE `getprodi` DISABLE KEYS */;
/*!40000 ALTER TABLE `getprodi` ENABLE KEYS */;

-- Dumping structure for table feeder_api.ijazah_perubahan
CREATE TABLE IF NOT EXISTS `ijazah_perubahan` (
  `ID` int(11) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `tanggal_wisuda` date DEFAULT NULL,
  `wisuda_ke` varchar(50) DEFAULT NULL,
  `tanggal_lulus` date DEFAULT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `ipk` varchar(50) DEFAULT NULL,
  `id_registrasi` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.ijazah_perubahan: 0 rows
/*!40000 ALTER TABLE `ijazah_perubahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ijazah_perubahan` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertakm
CREATE TABLE IF NOT EXISTS `insertakm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_registrasi_mahasiswa` varchar(36) DEFAULT NULL,
  `id_semester` int(11) NOT NULL,
  `id_status_mahasiswa` varchar(1) NOT NULL,
  `ips` varchar(50) NOT NULL DEFAULT '',
  `ipk` varchar(50) NOT NULL DEFAULT '',
  `sks_semester` varchar(50) NOT NULL DEFAULT '',
  `total_sks` varchar(50) NOT NULL DEFAULT '',
  `biaya_kuliah_smt` varchar(50) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `err_no` int(11) DEFAULT NULL,
  `err_desc` varchar(200) DEFAULT '',
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertid` varchar(50) NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertakm: 0 rows
/*!40000 ALTER TABLE `insertakm` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertakm` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertkelaskuliah
CREATE TABLE IF NOT EXISTS `insertkelaskuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` varchar(36) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `nama_kelas_kuliah` varchar(5) NOT NULL,
  `bahasan` varchar(100) NOT NULL DEFAULT '',
  `tanggal_mulai_efektif` varchar(200) NOT NULL,
  `tanggal_akhir_efektif` varchar(50) DEFAULT NULL,
  `tanggal_tutup_daftar` varchar(50) DEFAULT NULL,
  `apa_untuk_pditt` varchar(50) DEFAULT NULL,
  `kapasitas` varchar(50) DEFAULT NULL,
  `lingkup` int(11) DEFAULT '3' COMMENT '1: Internal, 2: External, 3: Campuran',
  `mode` varchar(2) DEFAULT 'M' COMMENT 'O: Online, F: Offline, M: Campuran',
  `err_no` varchar(100) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  `id_kelas_kuliah` varchar(36) DEFAULT NULL COMMENT 'response',
  `kodemk` varchar(36) NOT NULL,
  `namamk` varchar(120) NOT NULL,
  `nama_prodi` varchar(120) NOT NULL COMMENT 'alat bantu',
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id_prodi`,`id_semester`,`id_matkul`,`tanggal_mulai_efektif`,`id`) USING BTREE,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertkelaskuliah: 0 rows
/*!40000 ALTER TABLE `insertkelaskuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertkelaskuliah` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmahasiswa
CREATE TABLE IF NOT EXISTS `insertmahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `prodi_uuid` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `Jenis_masuk` int(11) DEFAULT NULL,
  `jk` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `Tempat_Lahir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Agama` int(11) DEFAULT NULL,
  `NIK` bigint(20) DEFAULT NULL,
  `negara` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Kelurahan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ID_wilayah` int(11) DEFAULT NULL,
  `ibu` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Biaya_Masuk` int(11) DEFAULT NULL,
  `STEP_1` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  `Id_mahasiswa` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `err2_no` varchar(50) DEFAULT NULL,
  `err2_desc` varchar(100) DEFAULT NULL,
  `Id_reg_mahasiswa` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `insertid` varchar(50) NOT NULL,
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmahasiswa: 0 rows
/*!40000 ALTER TABLE `insertmahasiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmahasiswa` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmahasiswalulusdo
CREATE TABLE IF NOT EXISTS `insertmahasiswalulusdo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reg_mahasiswa` varchar(50) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `id_jenis_keluar` varchar(50) DEFAULT NULL,
  `nama_jenis_keluar` varchar(50) DEFAULT NULL,
  `id_periode_keluar` varchar(50) DEFAULT NULL,
  `tanggal_keluar` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nomor_sk_yudisium` varchar(50) DEFAULT NULL,
  `tanggal_sk_yudisium` varchar(50) DEFAULT NULL,
  `nomor_ijazah` varchar(50) DEFAULT NULL,
  `ipk` varchar(50) DEFAULT NULL,
  `jalur_skripsi` varchar(50) DEFAULT NULL,
  `judul_skripsi` varchar(50) DEFAULT NULL,
  `bulan_awal_bimbingan` varchar(50) DEFAULT NULL,
  `bulan_akhir_bimbingan` varchar(50) DEFAULT NULL,
  `nama_program_studi` varchar(50) DEFAULT NULL,
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(200) DEFAULT NULL,
  `dateinsert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmahasiswalulusdo: 0 rows
/*!40000 ALTER TABLE `insertmahasiswalulusdo` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmahasiswalulusdo` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmahasiswa_copy
CREATE TABLE IF NOT EXISTS `insertmahasiswa_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `prodi_uuid` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `Jenis_masuk` int(11) DEFAULT NULL,
  `jk` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `Tempat_Lahir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Agama` int(11) DEFAULT NULL,
  `NIK` bigint(20) DEFAULT NULL,
  `negara` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `Kelurahan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ID_wilayah` int(11) DEFAULT NULL,
  `ibu` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Biaya_Masuk` int(11) DEFAULT NULL,
  `STEP_1` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `err` varchar(50) DEFAULT NULL,
  `Desc` varchar(100) DEFAULT NULL,
  `Id_mahasiswa` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `err_1` varchar(50) DEFAULT NULL,
  `Desc_1` varchar(100) DEFAULT NULL,
  `Id_reg_mahasiswa` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmahasiswa_copy: 0 rows
/*!40000 ALTER TABLE `insertmahasiswa_copy` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmahasiswa_copy` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmatakuliah
CREATE TABLE IF NOT EXISTS `insertmatakuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mata_kuliah` varchar(15) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) DEFAULT NULL,
  `id_jenis_mata_kuliah` varchar(30) NOT NULL,
  `id_kelompok_mata_kuliah` varchar(30) DEFAULT NULL,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `metode_kuliah` varchar(30) DEFAULT NULL,
  `ada_sap` varchar(30) DEFAULT NULL,
  `ada_silabus` varchar(30) DEFAULT NULL,
  `ada_bahan_ajar` varchar(30) DEFAULT NULL,
  `ada_acara_praktek` varchar(30) DEFAULT NULL,
  `ada_diktat` varchar(30) DEFAULT NULL,
  `tanggal_mulai_efektif` varchar(30) DEFAULT NULL,
  `tanggal_selesai_efektif` varchar(30) DEFAULT NULL,
  `err_no` varchar(30) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  `dateinsert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmatakuliah: 0 rows
/*!40000 ALTER TABLE `insertmatakuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmatakuliah` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmatkulkurikulum
CREATE TABLE IF NOT EXISTS `insertmatkulkurikulum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kurikulum` varchar(36) NOT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kodemk` varchar(36) DEFAULT NULL COMMENT 'tidak wajib',
  `namaprodi` varchar(50) DEFAULT NULL COMMENT 'tidak wajib',
  `namamk` varchar(100) DEFAULT NULL COMMENT 'tidak wajib',
  `semester` varchar(50) NOT NULL DEFAULT '',
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `apakah_wajib` varchar(50) NOT NULL DEFAULT '',
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(200) DEFAULT NULL,
  `dateinsert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kurikulum`,`id_matkul`,`id`) USING BTREE,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmatkulkurikulum: 0 rows
/*!40000 ALTER TABLE `insertmatkulkurikulum` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmatkulkurikulum` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertmatkulkurikulum_copy
CREATE TABLE IF NOT EXISTS `insertmatkulkurikulum_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kurikulum` varchar(36) NOT NULL,
  `nama_kurikulum` varchar(50) DEFAULT NULL,
  `id_matkul` varchar(36) NOT NULL,
  `kode_mata_kuliah` varchar(25) NOT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `id_prodi` varchar(36) NOT NULL,
  `nama_program_studi` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL DEFAULT '',
  `id_semester` varchar(50) NOT NULL DEFAULT '',
  `semester_mulai_berlaku` varchar(16) NOT NULL,
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `sks_tatap_muka` varchar(30) DEFAULT NULL,
  `sks_praktek` varchar(30) DEFAULT NULL,
  `sks_praktek_lapangan` varchar(30) DEFAULT NULL,
  `sks_simulasi` varchar(30) DEFAULT NULL,
  `apakah_wajib` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kurikulum`,`id_matkul`,`id_prodi`,`id_semester`,`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertmatkulkurikulum_copy: 0 rows
/*!40000 ALTER TABLE `insertmatkulkurikulum_copy` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertmatkulkurikulum_copy` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertnilaikuliahkelas
CREATE TABLE IF NOT EXISTS `insertnilaikuliahkelas` (
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `id_periode` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_matkul` varchar(36) DEFAULT NULL,
  `nama_mata_kuliah` varchar(100) NOT NULL,
  `kode_mata_kuliah` varchar(50) NOT NULL,
  `id_kelas` varchar(36) NOT NULL,
  `nama_kelas_kuliah` varchar(100) NOT NULL DEFAULT '',
  `sks_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `nilai_angka` varchar(30) DEFAULT NULL,
  `nilai_indeks` varchar(30) DEFAULT NULL,
  `nilai_huruf` varchar(30) DEFAULT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(100) NOT NULL,
  `angkatan` varchar(50) NOT NULL DEFAULT '',
  `err_no` varchar(50) NOT NULL DEFAULT '',
  `err_desc` varchar(200) NOT NULL DEFAULT '',
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertnilaikuliahkelas: 0 rows
/*!40000 ALTER TABLE `insertnilaikuliahkelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertnilaikuliahkelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertpengajarkelas
CREATE TABLE IF NOT EXISTS `insertpengajarkelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_registrasi_dosen` varchar(36) NOT NULL,
  `id_kelas_kuliah` varchar(36) NOT NULL,
  `id_substansi` varchar(30) DEFAULT NULL,
  `sks_substansi_total` varchar(50) NOT NULL DEFAULT '',
  `rencana_minggu_pertemuan` varchar(50) NOT NULL DEFAULT '',
  `realisasi_minggu_pertemuan` varchar(50) NOT NULL DEFAULT '',
  `id_jenis_evaluasi` varchar(50) NOT NULL DEFAULT '',
  `err_no` varchar(50) DEFAULT '',
  `err_desc` varchar(100) DEFAULT '',
  `id_aktivitas_mengajar` varchar(50) DEFAULT '',
  `nidn` varchar(50) DEFAULT '' COMMENT 'alat bantu cari id registrasi dosen',
  `kode_mk` varchar(50) DEFAULT '' COMMENT 'alat bantu cari id kelas',
  `kode_kelas` varchar(50) DEFAULT '' COMMENT 'alat bantu cari id kelas',
  `id_semester` varchar(50) DEFAULT '' COMMENT 'alat bantu cari id kelas',
  `id_prodi` varchar(50) DEFAULT '' COMMENT 'alat bantu cari id kelas',
  `id_key` varchar(100) DEFAULT NULL COMMENT 'semester,kode_kelas,nama_mk',
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertpengajarkelas: 0 rows
/*!40000 ALTER TABLE `insertpengajarkelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertpengajarkelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.insertpesertakelas
CREATE TABLE IF NOT EXISTS `insertpesertakelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas_kuliah` varchar(36) NOT NULL,
  `id_registrasi_mahasiswa` varchar(36) NOT NULL,
  `nim` varchar(50) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(50) DEFAULT '' COMMENT 'tidak wajib',
  `nama_prodi` varchar(50) DEFAULT '' COMMENT 'tidak wajib',
  `kode_mata_kuliah` varchar(50) NOT NULL DEFAULT '',
  `kode_kelas` varchar(50) NOT NULL DEFAULT '',
  `semester` varchar(8) NOT NULL DEFAULT '',
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT '',
  `res_id_registrasi_mahasiswa` varchar(36) DEFAULT NULL,
  `res_id_kelas_kuliah` varchar(36) DEFAULT NULL,
  `dateinsert` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateupdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.insertpesertakelas: 0 rows
/*!40000 ALTER TABLE `insertpesertakelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `insertpesertakelas` ENABLE KEYS */;

-- Dumping structure for table feeder_api.log_change
CREATE TABLE IF NOT EXISTS `log_change` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `status_akademik` varchar(250) DEFAULT NULL,
  `perubahan_akademik` varchar(250) DEFAULT NULL,
  `status_pddikti` varchar(250) DEFAULT NULL,
  `perubahan_pddikti` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.log_change: 0 rows
/*!40000 ALTER TABLE `log_change` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_change` ENABLE KEYS */;

-- Dumping structure for table feeder_api.log_insert
CREATE TABLE IF NOT EXISTS `log_insert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act` varchar(50) DEFAULT NULL,
  `data` varchar(1000) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `error` varchar(50) DEFAULT NULL,
  `error_desc` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.log_insert: 0 rows
/*!40000 ALTER TABLE `log_insert` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_insert` ENABLE KEYS */;

-- Dumping structure for table feeder_api.progress
CREATE TABLE IF NOT EXISTS `progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act` varchar(50) DEFAULT NULL,
  `keterangan` varchar(1000) DEFAULT NULL,
  `used` varchar(3) DEFAULT NULL,
  `progress` text,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.progress: 0 rows
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;

-- Dumping structure for table feeder_api.sync_status
CREATE TABLE IF NOT EXISTS `sync_status` (
  `id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `proses` varchar(50) DEFAULT NULL,
  `nilai` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.sync_status: 0 rows
/*!40000 ALTER TABLE `sync_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `sync_status` ENABLE KEYS */;

-- Dumping structure for table feeder_api.sys_level
CREATE TABLE IF NOT EXISTS `sys_level` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.sys_level: ~0 rows (approximately)

-- Dumping structure for table feeder_api.sys_log
CREATE TABLE IF NOT EXISTS `sys_log` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `activity` longtext NOT NULL,
  `ip_address` varchar(250) NOT NULL,
  `user_agent` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewable` char(10) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.sys_log: ~0 rows (approximately)

-- Dumping structure for table feeder_api.sys_menu
CREATE TABLE IF NOT EXISTS `sys_menu` (
  `id` int(11) DEFAULT NULL,
  `id_parent1` int(11) DEFAULT NULL,
  `id_parent2` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `exec` varchar(50) DEFAULT NULL,
  `js` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `aktif` varchar(50) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.sys_menu: ~35 rows (approximately)
REPLACE INTO `sys_menu` (`id`, `id_parent1`, `id_parent2`, `nama`, `desc`, `url`, `exec`, `js`, `icon`, `aktif`) VALUES
	(10, NULL, NULL, 'Sample Menu', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '0'),
	(1, NULL, NULL, 'Dashboard', NULL, '?module=default', NULL, NULL, 'fa fa-sitemap', '1'),
	(20, NULL, NULL, 'Konfirmasi', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '0'),
	(90, NULL, NULL, 'Tool', NULL, NULL, NULL, NULL, 'fa fa-gears', '1'),
	(901, 90, NULL, 'Backup DB', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '1'),
	(902, 90, NULL, 'Query', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '1'),
	(80, NULL, NULL, 'Sistem', NULL, NULL, NULL, NULL, 'fa fa-gear', '1'),
	(412, 40, NULL, 'Lulus / DO', NULL, '?module=mhskeluarfeed', NULL, NULL, 'fa fa-sign-out', '1'),
	(802, 80, NULL, 'Manajemen Menu', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '1'),
	(803, 80, NULL, 'Setting', NULL, NULL, NULL, NULL, 'fa fa-sign-out', '1'),
	(804, 80, NULL, 'Log Sistem', NULL, '?module=SystemLog', NULL, NULL, 'fa fa-sign-out', '1'),
	(40, NULL, NULL, 'Data FEEDER', NULL, NULL, NULL, NULL, 'fa fa-sign-in', '1'),
	(405, 40, NULL, 'Mata Kuliah', NULL, '?module=feedmk', NULL, NULL, 'fa fa-sign-in', '1'),
	(402, 40, NULL, 'Daftar Dosen', NULL, '?module=feeddosen', NULL, NULL, 'fa fa-sign-in', '1'),
	(406, 40, NULL, 'Mata Kuliah Kurikulum', NULL, '?module=feedmkk', NULL, NULL, 'fa fa-sign-in', '1'),
	(407, 40, NULL, 'Kelas Kuliah', NULL, '?module=feedkelaskuliah', NULL, NULL, 'fa fa-sign-in', '1'),
	(401, 40, NULL, 'Daftar Mahasiswa', NULL, '?module=feedmhs', NULL, NULL, 'fa fa-people', '1'),
	(408, 40, NULL, 'Pengajar kelas Kuliah', NULL, '?module=feedpengajar', NULL, NULL, 'fa fa-sign-in', '1'),
	(409, 40, NULL, 'Peserta Kelas Kuliah', NULL, '?module=feedpeserta', NULL, NULL, 'fa fa-sign-in', '1'),
	(50, NULL, NULL, 'Sync', NULL, NULL, NULL, NULL, 'fa fa-sign-in', '1'),
	(410, 40, NULL, 'Nilai Kelas Kuliah', NULL, '?module=feednilai', NULL, NULL, 'fa fa-sign-in', '1'),
	(60, NULL, NULL, 'SIVIL', NULL, NULL, NULL, NULL, 'fa fa-sign-in', '1'),
	(411, 40, NULL, 'AKM Mahasiswa', NULL, '?module=feedakm', NULL, NULL, 'fa fa-sign-in', '1'),
	(501, 50, NULL, 'Mahasiswa Baru', NULL, '?module=mhsimport', NULL, NULL, 'fa fa-people', '1'),
	(502, 50, NULL, 'Daftar Dosen', NULL, '?module=FeederDosen', NULL, NULL, 'fa fa-sign-in', '0'),
	(503, 50, NULL, 'Mata Kuliah', NULL, '?module=mkimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(504, 50, NULL, 'Mata Kuliah Kurikulum', NULL, '?module=mkkimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(505, 50, NULL, 'Kelas Kuliah', NULL, '?module=kelasimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(506, 50, NULL, 'Pengajar kelas Kuliah', NULL, '?module=pengajarimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(507, 50, NULL, 'Peserta Kelas Kuliah', NULL, '?module=pesertaimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(508, 50, NULL, 'Nilai Kelas Kuliah', NULL, '?module=nilaiimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(509, 50, NULL, 'AKM Mahasiswa', NULL, '?module=akmimport', NULL, NULL, 'fa fa-sign-in', '1'),
	(510, 50, NULL, 'Lulus / DO', NULL, '?module=mhskeluarimport', NULL, NULL, 'fa fa-sign-out', '1'),
	(400, 40, NULL, 'Daftar Program Studi', NULL, '?module=feedprodi', NULL, NULL, 'fa fa-people', '1'),
	(404, 40, NULL, 'Kurikulum', NULL, '?module=feedkurikulum', NULL, NULL, 'fa fa-sign-out', '1'),
	(403, 40, NULL, 'Daftar Penugasan Dosen', NULL, '?module=feedpenugasandosen', NULL, NULL, 'fa fa-sign-in', '1'),
	(601, 60, NULL, 'Cek Mahasiswa', NULL, '?module=cekMahasiswa', NULL, NULL, 'fa fa-people', '1'),
	(602, 60, NULL, 'Update Data Mahasiswa', NULL, '?module=updateMahasiswa', NULL, NULL, 'fa fa-people', '1');

-- Dumping structure for table feeder_api.sys_modul
CREATE TABLE IF NOT EXISTS `sys_modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `exec` varchar(50) DEFAULT '-',
  `js_type` varchar(50) DEFAULT NULL,
  `css_type` varchar(50) DEFAULT NULL,
  `datatable_title` varchar(50) DEFAULT NULL,
  `datatable_source` varchar(50) DEFAULT NULL,
  `datatable_data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.sys_modul: ~35 rows (approximately)
REPLACE INTO `sys_modul` (`id`, `nama`, `url`, `keterangan`, `module`, `exec`, `js_type`, `css_type`, `datatable_title`, `datatable_source`, `datatable_data`) VALUES
	(1, 'default', 'content/dashboard.php', NULL, 'default', '-', 'Dashboard', 'Dashboard', NULL, NULL, NULL),
	(2, 'BlankContent', 'content/BlankContent.php', NULL, 'BlankContent', '-', 'Blank', 'Blank', NULL, NULL, NULL),
	(3, 'DataTable', 'content/sample/DataTable.php', NULL, 'DataTable', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(29, 'Manajemen User', 'content/system/user.php', NULL, 'SystemUser', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(30, 'Melihat Log', 'content/system/log.php', NULL, 'SystemLog', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(101, 'Mahasiswa', 'content/feeder/mhs.php', 'AKTIF', 'feedmhs', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(111, 'Mahasiswa Keluar', 'content/feeder/mhskeluar.php', 'AKTIF', 'mhskeluarfeed', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(400, 'Daftar Program Studi', 'content/feeder/prodi.php', NULL, 'feedprodi', '-', 'DataTable', 'DataTable', 'Feeder_mahasiswa', 'content/feeder/controller/mahasiswa.php', '{ mData: \'nama_mahasiswa\' } ,\r\n{ mData: \'nim\' } ,\r\n{ mData: \'jenis_kelamin\' },\r\n{ mData: \'nama_agama\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'nama_status_mahasiswa\' },\r\n{ mData: \'nama_periode_masuk\' },\r\n{ mData: \'id_periode\' }'),
	(401, 'Data Penugasan Dosen', 'content/feeder/penugasandosen.php', NULL, 'feedpenugasandosen', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(402, 'Data Mahasiswa', 'content/feeder/mahasiswa.php', NULL, 'FeederMahasiswa', '-', 'DataTable', 'DataTable', 'Feeder_mahasiswa', 'content/feeder/controller/mahasiswa.php', '{ mData: \'nama_mahasiswa\' } ,\r\n{ mData: \'nim\' } ,\r\n{ mData: \'jenis_kelamin\' },\r\n{ mData: \'nama_agama\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'nama_status_mahasiswa\' },\r\n{ mData: \'nama_periode_masuk\' },\r\n{ mData: \'id_periode\' }'),
	(403, 'Aktivitas Kuliah Mahasiswa', 'content/feeder/akm.php', NULL, 'feedakm', '-', 'DataTable', 'DataTable', 'Feeder_AKM', 'content/feeder/controller/AKM.php', '{ mData: \'nim\' } ,\r\n{ mData: \'nama_mahasiswa\' } ,\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'nama_status_mahasiswa\' },\r\n{ mData: \'ips\' },\r\n{ mData: \'ipk\' },\r\n{ mData: \'sks_semester\' },\r\n{ mData: \'sks_total\' }'),
	(404, 'Data Dosen', 'content/feeder/dosen.php', NULL, 'feeddosen', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(405, 'Kelas Kuliah', 'content/feeder/kelaskuliah.php', NULL, 'feedkelaskuliah', '-', 'DataTable', 'DataTable', 'Feeder_kelaskuliah', 'content/feeder/controller/kelaskuliah.php', '{ mData: \'kode_mata_kuliah\' } ,\r\n{ mData: \'nama_program_studi\' } ,\r\n{ mData: \'nama_kelas_kuliah\' },\r\n{ mData: \'sks\' },\r\n{ mData: \'nama_dosen\' },\r\n{ mData: \'jumlah_mahasiswa\' }'),
	(406, 'Mata Kuliah', 'content/feeder/mk.php', NULL, 'feedmk', '-', 'DataTable', 'DataTable', 'Feeder_matakuliah', 'content/feeder/controller/matakuliah.php', '{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'sks_mata_kuliah\' },\r\n{ mData: \'tanggal_mulai_efektif\' },\r\n{ mData: \'tanggal_selesai_efektif\' }'),
	(407, 'Mata Kuliah Kurikulum', 'content/feeder/mkk.php', NULL, 'feedmkk', '-', 'DataTable', 'DataTable', 'Feeder_matkulkurikulum', 'content/feeder/controller/matakuliahkurikulum.php', '{ mData: \'nama_kurikulum\' },\r\n{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'semester\' },\r\n{ mData: \'semester_mulai_berlaku\' },\r\n{ mData: \'sks_mata_kuliah\' },\r\n{ mData: \'apakah_wajib\' }'),
	(408, 'Pengajar Kelas', 'content/feeder/pengajarkelas.php', NULL, 'feedpengajar', '-', 'DataTable', 'DataTable', 'Feeder_pengajarkelas', 'content/feeder/controller/pengajarkelas.php', '{ mData: \'nidn\' },\r\n{ mData: \'nama_dosen\' },\r\n{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'id_semester\' },\r\n{ mData: \'sks\' }'),
	(409, 'Peserta Kelas', 'content/feeder/pesertakelas.php', NULL, 'feedpeserta', '-', 'DataTable', 'DataTable', 'Feeder_pengajarkelas', 'content/feeder/controller/pengajarkelas.php', '{ mData: \'nidn\' },\r\n{ mData: \'nama_dosen\' },\r\n{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'id_semester\' },\r\n{ mData: \'sks\' }'),
	(411, 'Kurikulum', 'content/feeder/kurikulum.php', NULL, 'feedkurikulum', '-', 'DataTable', 'DataTable', 'Feeder_pengajarkelas', 'content/feeder/controller/pengajarkelas.php', '{ mData: \'nidn\' },\r\n{ mData: \'nama_dosen\' },\r\n{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'id_semester\' },\r\n{ mData: \'sks\' }'),
	(501, 'Mata Kuliah', 'content/import/mk.php', NULL, 'mkimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(502, 'Mata Kuliah Kurikulum', 'content/import/mkKurikulum.php', NULL, 'mkkimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(505, 'Kelas Kuliah', 'content/import/kelaskuliah.php', NULL, 'kelasimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(506, 'Pengajar Kelas Kuliah', 'content/import/pengajar.php', NULL, 'pengajarimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(507, 'Peserta Kelas Kuliah', 'content/import/peserta.php', NULL, 'pesertaimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(508, 'Nilai Kelas Kuliah', 'content/import/nilai.php', NULL, 'nilaiimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(509, 'Import AKM', 'content/import/akm.php', NULL, 'akmimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(510, 'Mahasiswa Keluar', 'content/import/mhskeluar.php', NULL, 'mhskeluarimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(511, 'Mahasiswa BARU', 'content/import/mhs.php', NULL, 'mhsimport', '-', 'DataTable', 'DataTable', '', '', NULL),
	(601, 'Cek Mahasiswa', 'content/import/cekMahasiswa.php', NULL, 'cekMahasiswa', '-', 'DataTable', 'DataTable', '', '', NULL),
	(602, 'Update Data Mahasiswa', 'content/import/updateMahasiswa.php', NULL, 'updateMahasiswa', '-', 'DataTable', 'DataTable', '', '', NULL),
	(996, 'Tarik Data dari Neo Feeder', 'content/tarikdata.php', 'AKTIF', 'tarikdata', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(997, 'JS Hitung Data', 'loaddata/hitung.php', 'AKTIF', 'hitung', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(998, 'Inject DATA', 'content/inject.php', 'AKTIF', 'inject', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(999, 'LOG Progress', 'content/logprogress.php', 'AKTIF', 'logprogress', '-', 'DataTable', 'DataTable', NULL, NULL, NULL),
	(1002, 'Peserta Kelas', 'content/feeder/nilai.php', NULL, 'feednilai', '-', 'DataTable', 'DataTable', 'Feeder_pengajarkelas', 'content/feeder/controller/pengajarkelas.php', '{ mData: \'nidn\' },\r\n{ mData: \'nama_dosen\' },\r\n{ mData: \'kode_mata_kuliah\' },\r\n{ mData: \'nama_mata_kuliah\' },\r\n{ mData: \'nama_program_studi\' },\r\n{ mData: \'id_semester\' },\r\n{ mData: \'sks\' }'),
	(1003, 'Check Point Versi Neo-Integrator', 'content/checkpoint.php', 'AKTIF', 'checkpoint', '-', 'DataTable', 'DataTable', NULL, NULL, NULL);

-- Dumping structure for table feeder_api.sys_session
CREATE TABLE IF NOT EXISTS `sys_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `session` varchar(100) DEFAULT NULL,
  `akses` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `agent` text,
  `Nama` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.sys_session: ~0 rows (approximately)

-- Dumping structure for table feeder_api.sys_user
CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `akses` int(11) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table feeder_api.sys_user: ~0 rows (approximately)

-- Dumping structure for table feeder_api.updatemahasiswa
CREATE TABLE IF NOT EXISTS `updatemahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` varchar(50) NOT NULL DEFAULT '0',
  `id_reg_mahasiswa` varchar(50) NOT NULL DEFAULT '0',
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `program_studi` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `data` varchar(40) DEFAULT NULL,
  `method` varchar(40) DEFAULT NULL,
  `insertid` varchar(40) DEFAULT NULL,
  `err_no` varchar(50) DEFAULT NULL,
  `err_desc` varchar(100) DEFAULT NULL,
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table feeder_api.updatemahasiswa: 0 rows
/*!40000 ALTER TABLE `updatemahasiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `updatemahasiswa` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
