# 🎬 Sceneza

![GitHub Repo stars](https://img.shields.io/github/stars/Aidiel1429/RekomFilm?style=social)
![GitHub forks](https://img.shields.io/github/forks/Aidiel1429/RekomFilm?style=social)
![GitHub license](https://img.shields.io/github/license/Aidiel1429/RekomFilm)

**Sceneza** adalah website rekomendasi film dan serial TV yang menyajikan informasi terkini, populer, dan trending. Data diambil langsung dari **API resmi TMDb (The Movie Database)** dan ditampilkan dengan antarmuka modern menggunakan **Laravel** dan **Livewire**.

---

## 🔥 Fitur Utama

- 🔍 Pencarian film dan TV series secara real-time
- 🎞️ Menampilkan detail lengkap: poster, sinopsis, rating, genre, dan tanggal rilis
- 🧠 Rekomendasi berdasarkan genre atau kategori
- 📺 Dukungan konten Movie & TV Series
- 💡 Desain modern, cepat, dan responsif

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12 + Livewire
- **Frontend**: Blade, Tailwind CSS
- **Sumber data**: [TMDb API](https://www.themoviedb.org/documentation/api)

---

## 🔑 Konfigurasi API TMDb

Untuk menggunakan aplikasi ini, dibutuhkan **3 konfigurasi** utama dari TMDb:

### ✅ Variabel yang Diperlukan di `.env`

```env
TMDB_API_KEY=your_tmdb_api_key
TMDB_BASE_URL=https://api.themoviedb.org/3
TMDB_IMAGE_BASE_URL=https://image.tmdb.org/t/p/original
