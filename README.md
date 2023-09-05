# lod-test

## Backend Mengunakan CI4
### Getting Started
Ini adalah contoh bagaimana Saya dapat memberikan petunjuk tentang menyiapkan proyek Anda secara lokal.
Untuk mengaktifkan dan menjalankan salinan lokal, ikuti langkah-langkah contoh sederhana berikut.
### Menjalankan service Backend
* bash
  ```sh
  composer install
  ```
* bash
  ```sh
  php spark migrate
  ```
  * bash
  ```sh
  php spark db:seed
  ```
   * bash
  ```sh
  php spark serve
  ```
  _Pastikan service berjalan pada url ```http://localhost:8080```._
  ### Menjalankan service Frontend

  1. * npm
  ```sh
  npm install
  ```
