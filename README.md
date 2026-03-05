# Initiall Codeigniter

untuk WebApp simple


## Langkah-langkah 

1. **Persiapan**
    - Editornya, misal Visual Studio Code.
    ![alt text](gambar/vs.png)
    
    - XAMPP, kalo belum punya unduh dulu di [sini](https://www.apachefriends.org/).

    - Buka XAMPP control panel dulu, aktifin ``apache`` lalu ke![alt text](gambar/amp1.png) 

    buat aktifin 
    ![alt text](gambar/ampini.png)

    - Unduh [Codeigniter](https://codeigniter.com/download), ekstract isinya ke folder htdocs(ubah namanya juga biar gampang disebut).



2. **Penerapan**

    - Baca [ini](https://codeigniter.com/user_guide/installation/running.html#initial-configuration) buat instalasi, ikutin sampai set development mode.

    - Set up routes untuk file php klean di ```app/config/routes.php```
    ![alt text](gambar/rout.png)

    - Buat [page.php](app/views/page.php) di dalam ```app/controllers```, itu buat ngasih arah ke filenya
    salah satunya ini. 
    ```php
    public function about()
    {
        return view('about', [ 
            'title' => 'Halaman Abot',
            'content' => 'Ini adalah halaman abaut yang menjelaskan tentang isi halaman ini.'
        ]);
    }
    ```

    - Nih [page](app/views/about.php) nya.
    ![alt text](gambar/abot..png)

    - Tapi buat dulu [header](app/Views/template/header.php) dan [footer](app/Views/template/footer.php).

    - CSS nya ngambil dari repo [sebelumnya](https://github.com/laLafid/Lab4Web/blob/main/lab4_layout%2C/style.css).

    - Nanti hasilnya gini ![alt text](gambar/h1.png)



3. **Hasil Akhir**
    
    - [Home](app/Views/liat.php)
    ![alt text](gambar/1.png)

    - [About](app/Views/about.php)
    ![alt text](gambar/1.1..1.png)

    - [Artikel](app/Views/article.php)
    ![alt text](gambar/1.1.png)

    - [Kontak](app/Views/contact.php)
    ![alt text](gambar/1.1.1.1.png)

    
## Akhir Kata

*Selamat mencoba*
