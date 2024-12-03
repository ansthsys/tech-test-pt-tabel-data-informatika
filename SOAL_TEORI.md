# Jawaban Soal Teori
1. Laravel Lumen

   - Apa perbedaan utama antara Laravel dan Laravel Lumen? Jelaskan dalam konteks penggunaan aplikasi yang ringan dan performa API

     Laravel adalah sekumpulan library yang disatukan sehingga membentuk sebuah framework sedangkan Lumen adalah core atau inti dari Laravel itu sendiri. Untuk membuat API Lumen sendiri sudah cukup karena tidak akan memerlukan bagian lain seperti Blade

   - Jelaskan konsep middleware di Laravel Lumen dan berikan contoh penggunaannya
  
     Middleware adalah fungsi kode yang akan dijalankan terlebih dahulu sebelum method di controller dijalankan, contoh penggunaanya misalkan untuk otentikasi dan otorisasi.

   - Apa itu dependency injection, dan bagaimana Laravel Lumen memanfaatkannya
  
     Dependency Injection adalah teknik untuk menggunakan objek/class didalam objek lain salah satu caranya adalah dengan memasukannya melalui constructor.

2. Vue.js

   - Jelaskan apa itu reactive data binding di Vue.js dan bagaimana ini membantu dalam pengembangan front-end?
  
     Adalah mekanisme yang menghubungkan data/state dengan tampilan, ketika data atau state berubah maka secara otomatis tampilan yang menampilkan data akan berubah. Dapat membuat developer fokus dalam pembuatan logika di frontend

   - Sebutkan dan jelaskan perbedaan utama antara computed properties dan methods di Vue.js
  
     computed properties akan diperbarui saat dependency berubah sedangkan method adalah fungsi yang harus dipanggil ketika ingin menggunakannya

   - Apa keuntungan menggunakan Vuex dalam aplikasi Vue.js?
  
     Dengan menggunakan vuex, state dalam aplikasi akan mudah dikelola jika aplikasi semakin besar

3. MySQL

   - Jelaskan apa itu indexing di MySQL, dan bagaimana ini mempengaruhi performa query?

     Adalah struktur data yang berisi kumpulan kunci dan referensi ke data di tabel, indexing dapat mempercepat proses pencarian data

   - Apa perbedaan antara INNER JOIN dan LEFT JOIN? Berikan contoh kasus penggunaan keduanya

     Inner Join hanya akan mengambil data di table 1 jika datanya memiliki hubungan di table 2, sedangkan Left Join mengambil seluruh data di table 1 dan mengambil data di table 2 jika data di table 1 berhubungan dengan table 2
 
   - Apa tujuan dari normalisasi database? Sebutkan salah satu kelemahannya

     Adalah mengelompokan atribut sesuai dengan keperluannya sehingga tidak membuat redudansi
